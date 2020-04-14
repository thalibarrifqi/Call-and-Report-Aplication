var auto_refresh = setInterval( function() 
{ 
    $('#conv_prob').load('conv_prob.php').fadeIn("slow"); 
}, 500);