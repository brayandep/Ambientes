
const rangoFechas = document.getElementById("rangoFechas");

function mostrarFechas(vigencia){
    
    // Si se selecciona la opción "Temporal" (value=2), mostrar los campos de fecha
    if (vigencia === 'temporal') {
        rangoFechas.style.display = 'flex';
        $('#fechaInicio').hide();
    } else {
        // Ocultar los campos de fecha para otras opciones
        rangoFechas.style.display = 'none';
    }
}
function CancelarRegR(){
    PanelCancelarRegistroR.style.display = 'block';
    fondoGris.style.display = 'flex';
}
function VolverRegRol(){
    PanelCancelarRegistroR.style.display = 'none';
    fondoGris.style.display = 'none';
}
