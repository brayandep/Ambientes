
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//calendario
document.addEventListener('DOMContentLoaded', function() {
    //eventos manuales
    misEventos.push({ 
        title: 'Daily TIS', 
        start: '2024-04-15 14:15', 
        end: '2024-04-15 15:45',
        descripcion:"Tenemos daily con la ingeniera." 
    },
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

    },
    { 
        title: 'Evento Universitario', 
        start: '2024-04-25 06:10', 
        end: '2024-04-25 14:30',
        descripcion:"Descripcion del evento universitario." 
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
        slotMinTime: '06:45',
        slotLabelInterval: '1:30:00',
        slotDuration: '00:45',
        slotMaxTime: '21:46',
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
            if (info.view.type === 'dayGridMonth') {
                console.log(info);
                $('#fechaStart').val(info.dateStr);
                $('#exampleModal').modal('toggle');
            }
            //calendar.addEvent({title:"Evento Jhosemar", date:info.dateStr})
        },

        eventClick:function(info){
            console.log(info);
            console.log(info.event.title);
            console.log(info.event.start);
            console.log(info.event.end);
            console.log(info.event.extendedProps.descripcion);

            mesIni = (info.event.start.getMonth()+1); 
            diaIni = (info.event.start.getDate()); 
            anioIni = (info.event.start.getFullYear()); 
            horaIni = (info.event.start.getHours()+":"+info.event.start.getMinutes()); 
            
            mesFin = (info.event.end.getMonth()+1); 
            diaFin = (info.event.end.getDate()); 
            anioFin = (info.event.end.getFullYear()); 
            horaFin = (info.event.end.getHours()+":"+info.event.end.getMinutes()); 

            mesIni = (mesIni<10)?"0"+mesIni:mesIni;
            diaIni = (diaIni<10)?"0"+diaIni:diaIni;

            mesFin = (mesFin<10)?"0"+mesFin:mesFin;
            diaFin = (diaFin<10)?"0"+diaFin:diaFin;

            console.log(horaIni);

            $('#titulo').val(info.event.title);
            $('#fechaStart').val(anioIni+"-"+mesIni+"-"+diaIni);
            $('#horaStart').val(horaIni);
            $('#fechaEnd').val(anioFin+"-"+mesFin+"-"+diaFin);
            $('#horaEnd').val(horaFin);
            $('#descripcion').val(info.event.extendedProps.descripcion);
            $('#color').val(info.event.backgroundColor);

            $('#exampleModal').modal('toggle');
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
                url:"/Calendario/evento",
                data:ojbEvento,
                success:function(){
                    // console.log(calendar);
                    // calendar.refetchEvents();
                    $('#exampleModal').modal('toggle');
                    window.location.reload();
                },
                error:function(error){
                    var errores = error.responseJSON.errors; 
                    $('#msgError').html(errores[0]);
                }
            }
        );
    }

});