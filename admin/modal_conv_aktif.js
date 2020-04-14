var auto_refresh = setInterval( function() 
{ 
    $('#modal_conv_aktif').load('modal_conv_aktif.php').fadeIn("slow"); 
}, 500);