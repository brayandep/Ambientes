
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

 
function mostrarInfoRol(id){
    panelId = 'panelVerRol-' + id;
    panelVerRol = document.getElementById(panelId);
    
    panelVerRol.style.display = 'block';
   
    fondoGris.style.display = 'flex';

    fetch(`/Rol/Permisos/${id}`)
            
            .then(response => response.json())
            .then(data => {
                const permissionsList = document.getElementById('permissionsList');
                permissionsList.innerHTML = '';  // Limpiar lista anterior
                data.permissions.forEach(permission => {
                    const li = document.createElement('li');
                    li.textContent = `${permission.id} - ${permission.name}`;
                    permissionsList.appendChild(li);
                });
                document.getElementById('permissionsPanel').style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
}

