const PanelCancelarRegistroU= document.getElementById("PanelCancelarRegistroU");
const fondoGris= document.getElementById("fondoGris");
const PanelRegistroGuardado= document.getElementById("PanelRegistroGuardado");


function CancelarRegU(){
    PanelCancelarRegistroU.style.display = 'block';
    fondoGris.style.display = 'flex';
}
function VolverRegUnidades(){
    PanelCancelarRegistroU.style.display = 'none';
    fondoGris.style.display = 'none';
}

function ConfirmarRegistro(){
    fondoGris.style.display = 'flex';
    PanelRegistroGuardado.style.display = 'block';
}