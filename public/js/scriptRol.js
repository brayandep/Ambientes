
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

document.addEventListener('DOMContentLoaded', function() {
    const fechaInput = document.getElementById('fechaFin');
    const hoy = new Date();
    const fechaMinima = hoy.toISOString().split('T')[0]; // Formatea la fecha de hoy a YYYY-MM-DD
    fechaInput.setAttribute('min', fechaMinima);
})

document.getElementById('selectAllPermissions').addEventListener('click', function() {
    // Obtener todos los checkboxes de permisos
    const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
    const currentState = this.textContent.includes('Seleccionar'); // Verifica el texto del botón para saber el estado
    // Cambiar el estado de cada checkbox
    checkboxes.forEach(checkbox => {
        checkbox.checked = currentState;
    });
    // Cambiar el texto del botón basado en el estado
    this.textContent = currentState ? 'Deseleccionar Todos' : 'Seleccionar Todos';
});


function CancelarRegR(){
    PanelCancelarRegistroR.style.display = 'block';
    fondoGris.style.display = 'flex';
}
function VolverRegRol(){
    PanelCancelarRegistroR.style.display = 'none';
    fondoGris.style.display = 'none';
}

//script para lista de rol 
function mostrarInfoRol(id){
    panelId = 'panelVerRol-' + id;
    panelVerRol = document.getElementById(panelId);
    
    panelVerRol.style.display = 'block';
   
    fondoGris.style.display = 'flex';

}
function exitInfo(id){
    panelId = '#panelVerRol-' + id;
    $(panelId).hide();
    $('#fondoGris').hide();

}

