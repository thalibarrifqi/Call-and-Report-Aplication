var auto_refresh = setInterval( function() 
{ 
    $('#todays_fix').load('todays_fix.php').fadeIn("slow"); 
}, 500);