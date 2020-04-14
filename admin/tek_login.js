var auto_refresh = setInterval( function() 
{ 
    $('#tek_login').load('tek_login.php').fadeIn("slow"); 
}, 500);