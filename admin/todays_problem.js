var auto_refresh = setInterval( function() 
{ 
    $('#todays_problem').load('todays_problem.php').fadeIn("slow"); 
}, 500);