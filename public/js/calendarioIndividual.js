
document.addEventListener('DOMContentLoaded', function() {
    
    totalEventos.forEach(function(evento1) {
        totalEventos.forEach(function(evento2) {
            // Comparar si las fechas y horas de inicio de ambos eventos son iguales
            if(evento1.daysOfWeek){
                console.log(moment(evento2.start).day()); 

                if (evento1.daysOfWeek.includes(moment(evento2.start).day()) && evento1.startTime === moment(evento2.start).format('HH:mm')) {
                    // Ambos eventos ocurren en el mismo día y hora de inicio
                    console.log('Los eventos ocurren en el mismo día y hora de inicio');
                } else {
                    console.log('Los eventos no ocurren en el mismo día y hora de inicio');
                }
            }

        });
    });
    // Convertir el objeto de eventos filtrados en un array
    // var eventosFinales = Object.values(eventosFiltrados);
    // console.log(eventosFinales);

    var today = new Date();
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'timeGridWeek',
        slotMinTime: '06:45',
        slotLabelInterval: '1:30:00',
        slotDuration: '00:45',
        slotMaxTime: '21:46',
        expandRows: true,
        eventBackgroundColor: '#CD9DC0',
        selectable:true,

        hiddenDays: [ 0 ],
        validRange: {
            start: today, // El día actual será el primer día permitido
        },
        nowIndicator: true,

        headerToolbar:{
            start:'prev,next prevYear,nextYear today',
            center:'title',
            end:'listWeek,timeGridWeek'
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
            console.log(info);
        },

        events:totalEventos,
    });
    calendar.setOption('locale', 'es');
    calendar.render();
  });