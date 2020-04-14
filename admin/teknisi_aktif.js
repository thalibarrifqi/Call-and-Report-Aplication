var auto_refresh = setInterval( function() 
{ 
    $('#teknisi_aktif').load('teknisi_aktif.php').fadeIn("slow"); 
}, 500);