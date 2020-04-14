var auto_refresh = setInterval( function() 
{ 
    $('#rating').load('rating.php').fadeIn("slow"); 
}, 500);