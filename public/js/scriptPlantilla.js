const sub1 = document.getElementById("sub1");
const sub2 = document.getElementById("sub2");
const subMateria = document.getElementById("subMateria");
const btnMenu = document.getElementById("btnMenu");
const menu = document.getElementById("menu");


function gesAmbiente(){
    if (sub1.style.display === 'none' || sub1.style.display === '') {
        subMateria.style.display = 'none';
        sub2.style.display = 'none'; 
        sub1.style.display = 'flex';
        //btnPanelUsr.classList.add('seleccionado');
    } else {
        sub1.style.display = 'none';
        //btnPanelUsr.classList.remove('seleccionado');
    }
}
function gesUnidad(){
    if (sub2.style.display === 'none' || sub2.style.display === '') {
        sub1.style.display = 'none';
        subMateria.style.display = 'none';
        sub2.style.display = 'flex';
        //btnPanelUsr.classList.add('seleccionado');
    } else {
        sub2.style.display = 'none';
        //btnPanelUsr.classList.remove('seleccionado');
    }
}

function gesMateria(){
    if (subMateria.style.display === 'none' || subMateria.style.display === '') {
        sub1.style.display = 'none';
        sub2.style.display = 'none';
        subMateria.style.display = 'flex';
        //btnPanelUsr.classList.add('seleccionado');
    } else {
        subMateria.style.display = 'none';
        //btnPanelUsr.classList.remove('seleccionado');
    }
}


function desMenu(){
    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'flex';
        //btnPanelUsr.classList.add('seleccionado');
    } else {
        menu.style.display = 'none';
        //btnPanelUsr.classList.remove('seleccionado');
    }
}

document.addEventListener('click', function (event) {
    var targetElement = event.target;

    // Verifica si el clic no fue dentro del div y el div está visible
    if (menu.style.display === 'flex' && !menu.contains(targetElement) && !btnMenu.contains(targetElement)) {
        menu.style.display = 'none';
    }
});