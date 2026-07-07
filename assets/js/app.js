function updateClock(){

let now=new Date();

document.getElementById("jam").innerHTML=
now.toLocaleTimeString('id-ID');

document.getElementById("tanggal").innerHTML=
now.toLocaleDateString('id-ID',{

weekday:'long',

day:'numeric',

month:'long',

year:'numeric'

});

}

setInterval(updateClock,1000);

updateClock();