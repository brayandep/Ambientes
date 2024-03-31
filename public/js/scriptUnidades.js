const PanelCancelarRegistroU= document.getElementById("PanelCancelarRegistroU");
const fondoGris= document.getElementById("fondoGris");
const PanelRegistroGuardado= document.getElementById("PanelRegistroGuardado");
/*var PEliminarUnidad= document.getElementById("PanelEliminarUnidad");*/

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

/*panel eliminar sin dependencia*/
var panelId;
var panelEliminar;

function EliminarUnidad(id){
    panelId = 'PanelEliminarUnidad-' + id;
    panelEliminar = document.getElementById(panelId);
    if (panelEliminar ) {
        panelEliminar.style.display = 'block';
    }
    fondoGris.style.display = 'flex';
}
function VolverVisualizar(){

    panelEliminar.style.display  = 'none';
    fondoGris.style.display = 'none';
}
/*panel eliminar con dependencia 
function EliminarUnidad(id){
    panelId = 'PanelEliminarUnidadconDepen-' + id;
    panelEliminar = document.getElementById(panelId);
    if (panelEliminar ) {
        panelEliminar.style.display = 'block';
    }
    fondoGris.style.display = 'flex';
}*/
