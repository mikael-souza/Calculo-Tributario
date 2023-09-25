$(document).ready(function(){

    $('form').keyup(function(){

        $('form').submit(function(){
            var dados = $(this).serialize();

            $.ajax({
                url: 'valor2.php',
                method: 'post',
                dataType: 'html',
                data: dados,
                success: function(data){
                    $('#valor').empty().html(data);
                }
            });

            return false;
        });

        $('calcular').trigger('submit');

    });
});