$(document).ready(function(){

    $('form').keyup(function(){

        $('form').submit(function(){
            var dados = $(this).serialize();

            $.ajax({
                url: 'db.php',
                method: 'post',
                dataType: 'html',
                data: dados,
                success: function(data){
                    $('#oportunidades').empty().html(data);
                }
                
                /*success: function(data){
                    $('#Tributo').empty().html(data);
                }*/
            });

            return false;
        });

        $('calcular').trigger('submit');

    });
});