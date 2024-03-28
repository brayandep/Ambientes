const sub1 = document.getElementById("sub1");
const sub2 = document.getElementById("sub2");

function gesAmbiente(){
    if (sub1.style.display === 'none' || sub1.style.display === '') {
        sub1.style.display = 'flex';
        //btnPanelUsr.classList.add('seleccionado');
    } else {
        sub1.style.display = 'none';
        //btnPanelUsr.classList.remove('seleccionado');
    }
}
function gesUnidad(){
    if (sub2.style.display === 'none' || sub2.style.display === '') {
        sub2.style.display = 'flex';
        //btnPanelUsr.classList.add('seleccionado');
    } else {
        sub2.style.display = 'none';
        //btnPanelUsr.classList.remove('seleccionado');
    }
}