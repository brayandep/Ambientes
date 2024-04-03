
const panelCancelar= document.getElementById("panelCancelar");
const fondoGris= document.getElementById("fondoGris");

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