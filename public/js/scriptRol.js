
const rangoFechas = document.getElementById("rangoFechas");
// Escuchar cambios en el selector
function mostrarFechas(vigencia){
    
    // Si se selecciona la opción "Temporal" (value=2), mostrar los campos de fecha
    if (vigencia === '2') {
        rangoFechas.style.display = 'flex';
    } else {
        // Ocultar los campos de fecha para otras opciones
        rangoFechas.style.display = 'none';
    }
}
