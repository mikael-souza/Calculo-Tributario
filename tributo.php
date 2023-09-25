<?php

/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

//require_once('php/conexao.php');
//$conn = Conexao::getinstance();
//echo $conn->numrows("SELECT * FROM OportunidadesTributarias");

//Validando as variáveis buscadas no formulário
$reg_tributario = $_POST['regime_tributario'].'%';
$setor = $_POST['setor'];
$segmento = $_POST['segmento'];
$ano = $_POST['ano'];
$faturamento = $_POST['faturamento'];



//var_dump($_POST);

//conexão com banco
$host = 'localhost';
$dbname = 'cffra028_tributario';
$username = 'cffra028_rct';
$password = 'Sup0rt3.@123';

    
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username,
    $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
   
  switch ($setor) {
    case 'Indústria e Comércio':
        $sql_segmento = "'$industria'"."OR"."'$comercio'";
        break;
        
    case 'Indústria e Serviço':
        $sql_segmento = "'$industria'"."OR"."'$comercio'";
        break;
        
    case 'Indústria e Atacado':
        $sql_segmento = "'$industria'"."OR"."'$comercio'";
        break;
        
    case 'Comércio e Serviço':
        $sql_segmento = "'$industria'"."OR"."'$comercio'";
        break;
 
    case '_Todos os seguimentos':
        $sql_segmento ="*";
        break;
 
    default:
        $sql_segmento = $setor;
}

    //tudo que der certo depois do 
    
    $data = $conn->query('SELECT DISTINCT Tributo, Oportunidades, Documentos FROM OportunidadesTributarias WHERE Setor = ' . $conn->quote($setor).' AND Segmento = '.$conn->quote($segmento).' AND RegimeTributario LIKE '.$conn->quote($reg_tributario) );
    
    
    //var_dump($data);
    echo "<section>
        
    </section>";
    
  //TODO HTML FORA DO RESULTADO OU SEJA TITULO DIVS ETC
      //TODO HTML FORA DO RESULTADO OU SEJA TITULO DIVS ETC
   if ($data->rowCount() > 0) {
    $dadosUnicos = array(); // Array para armazenar dados únicos

    foreach ($data as $row) {
        
        $valor = $row['Tributo'];

        // Verifica se o valor já foi adicionado ao array de dados únicos
        if (!in_array($valor, $dadosUnicos)) {
            $dadosUnicos[] = $valor; // Adiciona o valor único ao array

            echo "<div class=''><h4><span id='tributos'>".$valor."</span></h4></div>";
        }
    }
} else {
    echo "<p><span id='nulo'>Não há Tributos e valores a serem restituídos neste perfil</p>";
}


    
   
        $sql = "SELECT DISTINCT CreditoTributario, FranqueadoCf, Porcentagem FROM Faturamento WHERE Segmento = ".$conn->quote($sql_segmento)." AND RegimeTributario = ".$conn->quote($reg_Tributario)." AND TempoAtividade LIKE ".$conn->quote($ano);
        
        //echo $sql;
 
    
    //echo "Conectado a $dbname em $host com sucesso.";
} catch (PDOException $pe) {
    die("Não foi possível se conectar ao banco de dados $dbname :" . $pe
>getMessage());
}

/*
// select all users
$stmt = $pdo->query("SELECT * FROM users");





while ($row = $conn->fetch()) {
    echo $row['name']."<br />\n";
}*/


?>