var auto_refresh = setInterval( function() 
{ 
    $('#button_conv_prob').load('button_conv_prob.php').fadeIn("slow"); 
}, 500);