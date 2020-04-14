tday=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
tmonth=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
      
function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
if(nyear<1000) nyear+=1900;
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;
      
if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}
      
if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;
      
document.getElementById('clock').innerHTML=""+tday[nday]+", "+ndate+" "+tmonth[nmonth]+" "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
}
      
window.onload=function(){
GetClock();
setInterval(GetClock,500);
}