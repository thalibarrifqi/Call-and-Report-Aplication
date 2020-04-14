var auto_refresh = setInterval( function() 
{ 
    $('#tek_aktif').load('tek_aktif.php').fadeIn("slow"); 
}, 500);