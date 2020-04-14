var auto_refresh = setInterval( function() 
{ 
    $('#prob_sel').load('prob_sel.php').fadeIn("slow"); 
}, 500);