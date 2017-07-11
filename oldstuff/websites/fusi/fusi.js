// istruzioni:
// per spostare l'orario di tutti gli orologi
// modifica la variabile "regolaOrario"
// ora ho spostato gli orari indietro di un'ora
// infatti la variabile "regolaOrario" è uguale a "-1"
// per portare avanti gli orologi di un'ora basta aggiungere 1 a quella variabile
// quindi per aggiungere 1 a "regolaOrario" sostituisci il "-1" con 0:
//   al posto di "var regolaOrario = -1;"
// dovrà esserci "var regolaOrario = 0; "

var regolaOrario = -1;

var c = document.getElementById("canvas");
var ctx = c.getContext("2d");

var d = new Date();
var h = d.getUTCHours();
var m = d.getUTCMinutes();
var s = d.getUTCSeconds();

draw();

setInterval(function(){
    draw();
},1000);

function draw() {
    //pulisci sfondo
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    //disegna cerchi
    ctx.beginPath();
    ctx.fillStyle = '#2a2a2b';
    ctx.arc(34.5,34.5,25.5,0,2*Math.PI);
    ctx.arc(105.5,34.5,25.5,0,2*Math.PI);
    ctx.arc(176.5,34.5,25.5,0,2*Math.PI);
    ctx.arc(247.5,34.5,25.5,0,2*Math.PI);
    ctx.fill();
    //scrivi nomi città
    ctx.fillStyle = '#7f7f7f';
    ctx.font = "8px Verdana";
    ctx.fillText("MILANO",17,71);
    //posizione0 MILANO +2
    drawLancette(0,2);

    ctx.fillText("LONDON",87,71);
    //posizione0 LONDON +1
    drawLancette(1,1);

    ctx.fillText("TOKYO",162,71);
    //posizione0 TOKYO +9
    drawLancette(2,9);

    ctx.fillText("NEW YORK",225,71);
    //posizione0 NEW YORK -4 (+20)
    drawLancette(3,20);

    if(s<59){
        s++;
    }else{
        s=0;
        if(m<59){
            m++;
        }else{
            m=0;
            if(h<23)
                h++;
            else
                h=0;
        }
    }
    //lancette
    //drawLancette();
}
function drawLancette(pos,f) {
    fuso=f+regolaOrario;
    posx=34.5+(pos*71);
    posy=34.5;
    ctx.beginPath();
    ctx.strokeStyle = '#444';
    angolo=toRadians(s*6-90);
    ctx.moveTo(posx+(4*Math.cos(angolo)),posy+(4*Math.sin(angolo)));
    ctx.lineTo(posx+(21+4)*Math.cos(angolo),posy+(21+4)*Math.sin(angolo));
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = '#009ee0';
    angolo=toRadians(m*6-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(18+4)*Math.cos(angolo),posy+(18+4)*Math.sin(angolo));
    ctx.stroke();
    angolo=toRadians((360/12)*(h+fuso)-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(12+4)*Math.cos(angolo),posy+(12+4)*Math.sin(angolo));
    ctx.stroke();
}/*
function drawLancette() {
    //posizione0 MILANO +2
    fuso=2+regolaOrario;
    posx=34.5;
    posy=34.5;
    ctx.beginPath();
    ctx.strokeStyle = '#444';
    angolo=toRadians(s*6-90);
    ctx.moveTo(posx+(4*Math.cos(angolo)),posy+(4*Math.sin(angolo)));
    ctx.lineTo(posx+(21+4)*Math.cos(angolo),posy+(21+4)*Math.sin(angolo));
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = '#009ee0';
    angolo=toRadians(m*6-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(18+4)*Math.cos(angolo),posy+(18+4)*Math.sin(angolo));
    ctx.stroke();
    angolo=toRadians((360/12)*(h+fuso)-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(12+4)*Math.cos(angolo),posy+(12+4)*Math.sin(angolo));
    ctx.stroke();
    //posizione0 LONDON +1
    fuso=1+regolaOrario;
    posx=105.5;
    posy=34.5;
    ctx.beginPath();
    ctx.strokeStyle = '#444';
    angolo=toRadians(s*6-90);
    ctx.moveTo(posx+(4*Math.cos(angolo)),posy+(4*Math.sin(angolo)));
    ctx.lineTo(posx+(21+4)*Math.cos(angolo),posy+(21+4)*Math.sin(angolo));
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = '#009ee0';
    angolo=toRadians(m*6-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(18+4)*Math.cos(angolo),posy+(18+4)*Math.sin(angolo));
    ctx.stroke();
    angolo=toRadians((360/12)*(h+fuso)-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(12+4)*Math.cos(angolo),posy+(12+4)*Math.sin(angolo));
    ctx.stroke();
    //posizione0 TOKYO +9
    fuso=9+regolaOrario;
    posx=176.5;
    posy=34.5;
    ctx.beginPath();
    ctx.strokeStyle = '#444';
    angolo=toRadians(s*6-90);
    ctx.moveTo(posx+(4*Math.cos(angolo)),posy+(4*Math.sin(angolo)));
    ctx.lineTo(posx+(21+4)*Math.cos(angolo),posy+(21+4)*Math.sin(angolo));
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = '#009ee0';
    angolo=toRadians(m*6-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(18+4)*Math.cos(angolo),posy+(18+4)*Math.sin(angolo));
    ctx.stroke();
    angolo=toRadians((360/12)*(h+fuso)-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(12+4)*Math.cos(angolo),posy+(12+4)*Math.sin(angolo));
    ctx.stroke();
    //posizione0 NEW YORK -4 (+20)
    fuso=20+regolaOrario;
    posx=247.5;
    posy=34.5;
    ctx.beginPath();
    ctx.strokeStyle = '#444';
    angolo=toRadians(s*6-90);
    ctx.moveTo(posx+(4*Math.cos(angolo)),posy+(4*Math.sin(angolo)));
    ctx.lineTo(posx+(21+4)*Math.cos(angolo),posy+(21+4)*Math.sin(angolo));
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = '#009ee0';
    angolo=toRadians(m*6-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(18+4)*Math.cos(angolo),posy+(18+4)*Math.sin(angolo));
    ctx.stroke();
    angolo=toRadians((360/12)*(h+fuso)-90);
    ctx.moveTo(posx+4*Math.cos(angolo),posy+4*Math.sin(angolo));
    ctx.lineTo(posx+(12+4)*Math.cos(angolo),posy+(12+4)*Math.sin(angolo));
    ctx.stroke();
}*/
function toRadians (angle) {
  return angle * (Math.PI / 180);
}
