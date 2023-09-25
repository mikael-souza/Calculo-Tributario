$(document).ready(function(){

    $('form').keyup(function(){

        $('form').submit(function(){
            var dados = $(this).serialize();

            $.ajax({
                url: 'tributo.php',
                method: 'post',
                dataType: 'html',
                data: dados,
                success: function(data){
                    $('#tributo').empty().html(data);
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