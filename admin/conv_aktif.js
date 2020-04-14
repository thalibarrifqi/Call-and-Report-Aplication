var auto_refresh = setInterval( function() 
{ 
    $('#conv_aktif').load('conv_aktif.php').fadeIn("slow"); 
}, 500);