
const panelCancelar= document.getElementById("panelCancelar");
const fondoGris= document.getElementById("fondoGris");


const grupo1= document.getElementById("grupo1");
const grupo2= document.getElementById("grupo2");
const grupo3= document.getElementById("grupo3");
const grupo4= document.getElementById("grupo4");
const grupo5= document.getElementById("grupo5");


function CancelarReg(){
    panelCancelar.style.display = 'block';
    fondoGris.style.display = 'flex';
}

function siCancela(){
    panelCancelar.style.display  = 'none';
    fondoGris.style.display = 'none';
}
function noCancela(){
    panelCancelar.style.display  = 'none';
    fondoGris.style.display = 'none';
}

function regGrupos(){
    grupo1.submit();
    grupo2.submit();
    grupo3.submit();
    grupo4.submit();
    grupo5.submit();
}
