var auto_refresh = setInterval( function() 
{ 
    $('#juml_prob').load('juml_prob.php').fadeIn("slow"); 
}, 500);