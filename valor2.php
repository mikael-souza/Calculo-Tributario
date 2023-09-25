<?php 

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

//Validando as variáveis buscadas no formulário
$reg_tributario = $_POST['regime_tributario'];
$setor = $_POST['setor'];
$segmento = $_POST['segmento'];
$ano = $_POST['ano'];
$faturamento = $_POST['faturamento'];

//Variável Ano
$anoAtual = date('Y');

//var_dump($_POST);
//conexão com banco
$host = 'localhost';
$dbname = 'cffra028_tributario';
$username = 'cffra028_rct';
$password = 'Sup0rt3.@123';

switch ($setor) {
    case 'Industria e Comercio':
        $sql_setor = "Indústria";
        break;
        
    case 'Industria e Serviço':
        $sql_setor = "Indústria";
        break;
        
    case 'Comércio e Serviço':
        $sql_setor = "Comércio";
        break;
        
    case 'Indústria e Atacado':
        $sql_setor = "Indústria";
        break; 
 
    case '_Todos Segmentos':
        $sql_setor ="Comércio";
        break;
 
    default:
        $sql_setor = $setor;
}


//echo $sql_segmento;

//tudo que der certo depois do 
//$anoteste = $anoAtual - $ano;
//echo $anoteste;


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username,
    $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
    
    //echo "foi";
    
    $data = $conn->query('SELECT DISTINCT Porcentagem FROM Faturamento WHERE Segmento = ' . $conn->quote($sql_setor).' AND RegimeTributario = '.$conn->quote($reg_tributario).' AND TempoAtividade = '.$conn->quote($ano));
    
    
    //var_dump($data);
   
     if ($data->rowCount() > 0) {
    $dadosUnicos = array(); // Array para armazenar dados únicos

    foreach ($data as $row) {
        
       $porcentagem = $row['Porcentagem'];
       
       $valor = explode( '%', $porcentagem);
       
       $perct = $valor[0]/1000;
       
       $calc = $faturamento*$perct*5 ;
       

        // Verifica se o valor já foi adicionado ao array de dados únicos
        if (!in_array($valor, $dadosUnicos)) {
            $dadosUnicos[] = $calc; // Adiciona o valor único ao array

            echo "<h4>R$: <span id='valor'>".number_format($calc, 2, ',', '.')."</span></h4>";

        }
    }
} else {
    echo "<p><span id='nulo'>Não há valores a serem restituídos neste perfil</p>";
}
   
   
   
   
    /*$data = $conn->query("SELECT DISTINCT Porcentagem FROM Faturamento WHERE Segmento = 'Indústria' AND RegimeTributario = 'Lucro Presumido' AND TempoAtividade = ".$conn->quote($ano));*/

   
     
}catch (PDOException $pe) {
    die("Não foi possível se conectar ao banco de dados");
}

?>