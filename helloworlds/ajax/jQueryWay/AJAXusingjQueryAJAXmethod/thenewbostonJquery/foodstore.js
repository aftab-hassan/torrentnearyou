/**
 * Created by aftab on 5/3/2016.
 */
$(document).ready(function() {
    $('#userInput').bind('keyup', function(){
        $.ajax({
            url: 'foodstore.php?food='+$(this).val(),
            success: function(data){
                $('#underInput').html(data);
            }
        });
    });
});
