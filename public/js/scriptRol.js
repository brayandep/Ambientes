
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

//panel de informacion de lista
 
