
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//revision de hora final
function compararHoras() {
    var horaStart = $('#horaStart').val();
    var horaEnd = $('#horaEnd').val();

    // Crear objetos Date con las horas
    var fHoraStart = new Date('2000-01-01T' + horaStart);
    var fHoraEnd = new Date('2000-01-01T' + horaEnd);

    if (fHoraEnd >= fHoraStart) {
        $('#alertaHora').text('');
    } else {
        $('#alertaHora').text('La hora final debe ser despues de la hora inicial.');
        $('#horaEnd').val('');
    }
}


//calendario
document.addEventListener('DOMContentLoaded', function() {
    //eventos manuales
    misEventos.push(
    { 
        title: 'Dia del niño', 
        start: '2024-04-12', 
        allDay: true,
        backgroundColor: '#d48516',
        rrule: {
            freq: 'yearly',
            interval: 1, // Cada 1 año
            dtstart: '2024-04-12', 
        },
        descripcion:"Se festeja a las wawas."	

    },
    { 
        title: 'Dia del Trabajo', 
        start: '2024-05-01', 
        allDay: true,
        backgroundColor: '#d48516',
        rrule: {
            freq: 'yearly',
            interval: 1, // Cada 1 año
            dtstart: '2024-05-01', 
        },
        descripcion:"No habra disponibilidad de aulas todo el dia."	
    },
    { 
        title: 'Corpus Christi', 
        start: '2024-05-30', 
        allDay: true,
        backgroundColor: '#d48516',
        rrule: {
            freq: 'yearly',
            interval: 1, // Cada 1 año
            dtstart: '2024-05-30', 
        },
        descripcion:"No habra disponibilidad de aulas todo el dia."	

    },
    { 
        title: 'Año Nuevo Aymara', 
        start: '2024-06-21', 
        allDay: true,
        backgroundColor: '#d48516',
        rrule: {
            freq: 'yearly',
            interval: 1, // Cada 1 año
            dtstart: '2024-06-21', 
        },
        descripcion:"No habra disponibilidad de aulas todo el dia."	

    });

    var today = new Date();
    var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1); 
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        views: {
            dayGridMonth: {
                
            }
        },

        initialView: 'dayGridMonth',
        slotMinTime: '06:00',
        slotLabelInterval: '01:00:00',
        slotDuration: '00:30',
        slotMaxTime: '22:00',
        expandRows: true,
        validRange: {
            start: firstDayOfMonth, // Primer día del mes actual
        },
        nowIndicator: true,
        themeSystem: 'bootstrap5',

        headerToolbar:{
            start:'prev,next prevYear,nextYear today',
            center:'title',
            end:'listYear dayGridMonth,timeGridWeek'
        },

        buttonText:{
            today:    'Hoy',
            month:    'Mes',
            week:     'Semana',
            day:      'Dia',
            list:     'Lista'
        },

        customButtons:{
            miboton:{
                text: 'modelo',
                click: function() {
                    modEvento.show();
                }
            }
        },

        
        dateClick: function(info) {
            if (regEvento) {

                limpiarFormulario();
                if (info.view.type === 'dayGridMonth') {
                    $('#btnAgregar').show();
                    $('#btnModificar').hide();
                    $('#btnEliminar').hide();
                    $('#labelTitulo').text('Agregar evento en: '+info.dateStr);
    
                    console.log(info);
                    $('#fechaStart').val(info.dateStr);
                    limitarFecha();
                    $('#exampleModal').modal('toggle');
                }
                //calendar.addEvent({title:"Evento Jhosemar", date:info.dateStr})
            }
        },

        eventClick:function(info){
            if(editEvento){
                limpiarFormulario();
                $('#btnAgregar').hide();
                $('#btnModificar').show();
                $('#btnEliminar').show();
                $('#labelTitulo').text('Editar evento '+"'"+info.event.title+"'");

                console.log(info);
                console.log(info.event.title);
                console.log(info.event.start);
                console.log(info.event.end);
                console.log(info.event.extendedProps.descripcion);

                //hora minuto inicio
                hora1 = info.event.start.getHours();
                hora1 = (hora1<10)?"0"+hora1:hora1;
                minuto1 = info.event.start.getMinutes();
                minuto1 = (minuto1<10)?"0"+minuto1:minuto1;

                mesIni = (info.event.start.getMonth()+1); 
                diaIni = (info.event.start.getDate()); 
                anioIni = (info.event.start.getFullYear()); 
                horaIni = (hora1+":"+minuto1); 
                
                mesIni = (mesIni<10)?"0"+mesIni:mesIni;
                diaIni = (diaIni<10)?"0"+diaIni:diaIni;

                //hora minuto final
                if(info.event.end > info.event.start){
                    hora2 = info.event.end.getHours();
                    hora2 = (hora2<10)?"0"+hora2:hora2;
                    minuto2 = info.event.end.getMinutes();
                    minuto2 = (minuto2<10)?"0"+minuto2:minuto2;

                    mesFin = (info.event.end.getMonth()+1); 
                    diaFin = (info.event.end.getDate()); 
                    anioFin = (info.event.end.getFullYear()); 
                    horaFin = (hora2+":"+minuto2); 

                    mesFin = (mesFin<10)?"0"+mesFin:mesFin;
                    diaFin = (diaFin<10)?"0"+diaFin:diaFin;

                    inputFin = anioFin+"-"+mesFin+"-"+diaFin
                }else{
                    horaFin = horaIni;
                    inputFin = anioIni+"-"+mesIni+"-"+diaIni; 
                }

                limitarFecha(anioIni+"-"+mesIni+"-"+diaIni);
                $('#idEvento').val(info.event.id);//id del evento
                $('#titulo').val(info.event.title);
                $('#fechaStart').val(anioIni+"-"+mesIni+"-"+diaIni);
                $('#horaStart').val(horaIni);
                $('#fechaEnd').val(inputFin);
                $('#horaEnd').val(horaFin);
                $('#descripcion').val(info.event.extendedProps.descripcion);
                $('#color').val(info.event.backgroundColor);

                $('#exampleModal').modal('toggle');
            }
        },

        //lista eventos de la BD
        events:misEventos,
        eventBackgroundColor: '#CD9DC0',
        selectable:true,
        selectHelper: true

    });
    calendar.setOption('locale', 'es');
    calendar.render();

    $('#btnAgregar').click(function(){
        ojbEvento = recolectarDatos('POST');
        enviarDatos('',ojbEvento);
    });
    $('#btnEliminar').click(function(){
        ojbEvento = recolectarDatos('DELETE');
        enviarDatos('/'+$('#idEvento').val(),ojbEvento);
    });
    $('#btnModificar').click(function(){
        ojbEvento = recolectarDatos('PUT');
        enviarDatos('/'+$('#idEvento').val(),ojbEvento);
    });

    function recolectarDatos(method){
        nuevoEvento={
            title:$('#titulo').val(),
            descripcion:$('#descripcion').val(),
            start:$('#fechaStart').val()+" "+$('#horaStart').val(),
            end:$('#fechaEnd').val()+" "+$('#horaEnd').val(),
            color:$('#color').val(),

            '_method':method
        }
        return(nuevoEvento);
    }
    function enviarDatos(accion,ojbEvento){
        $.ajax(
            {
                type:"POST",
                url:"/Calendario/evento"+accion,
                data:ojbEvento,
                success:function(){
                    // console.log(calendar);
                    // calendar.refetchEvents();
                    $('#exampleModal').modal('toggle');
                    window.location.reload();
                },
                error:function(error){
                    msg1 = error.responseJSON.errors.title || '';
                    msg2 = error.responseJSON.errors.descripcion || '';
                    msg3 = error.responseJSON.errors.start || '';
                    msg4 = error.responseJSON.errors.end || '';

                    $('#msgError1').html(msg1);
                    $('#msgError2').html(msg2);
                    $('#msgError3').html(msg3);
                    $('#msgError4').html(msg4);
                }
            }
        );
    }

    function limpiarFormulario(){
        $('#idEvento').val("");//id del evento
        $('#titulo').val("");
        $('#fechaStart').val("");
        $('#horaStart').val("06:00");
        $('#fechaEnd').val("");
        $('#horaEnd').val("");
        $('#descripcion').val("");
        $('#color').val("#CD9DC0");

        $('#msgError1').html("");
        $('#msgError2').html("");
        $('#msgError3').html("");
        $('#msgError4').html("");
        $('#alertaHora').html("");
    }

});