
const rangoFechas = document.getElementById("rangoFechas");
// Escuchar cambios en el selector
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
