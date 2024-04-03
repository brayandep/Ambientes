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

/*panel eliminar(Deshabilitar) sin dependencia*/
var panelId;
var panelEliminar;

function EliminarUnidad(id, checkboxElement){
    if (!checkboxElement.checked) {
        panelId = 'PanelEliminarUnidad-' + id;
        panelEliminar = document.getElementById(panelId);
        if (panelEliminar ) {
            panelEliminar.style.display = 'block';
        }
        fondoGris.style.display = 'flex';
    }
}
function VolverVisualizar(){
    panelEliminar.style.display  = 'none';
    fondoGris.style.display = 'none';
}
function VolverVisualizarCheck(id){
    panelEliminar.style.display  = 'none';
    fondoGris.style.display = 'none';
    var checkbox = document.getElementById('btn-switch-' + id);
    checkbox.checked = true;
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
/**Carga las dependencias */
function cargarDependencias(nivel){
    // Limpia las opciones existentes
    const dependenciaSelect = document.getElementById('Dependencia');
    dependenciaSelect.innerHTML = '';
    fetch(`/unidad/dependencia/${nivel}`)
    .then(response => response.json())
    .then(unidades => {
        unidades.forEach(unidad => {
            const option = new Option(unidad.nombreUnidad, unidad.id);
            dependenciaSelect.add(option);
        });
    })
    .catch(error => console.error('Error:', error));
}


