var auto_refresh = setInterval( function() 
{ 
    $('#datajumlah').load('datajumlah.php').fadeIn("slow"); 
}, 500);