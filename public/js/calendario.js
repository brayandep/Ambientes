var modEvento = new bootstrap.Modal(document.getElementById('exampleModal'));
//calendario
document.addEventListener('DOMContentLoaded', function() {
    var today = new Date();
    var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1); 
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        slotMinTime: '06:45',
        slotLabelInterval: '1:30:00',
        slotDuration: '00:45',
        slotMaxTime: '21:46',
        expandRows: true,
        validRange: {
            start: firstDayOfMonth, // Primer día del mes actual
        },

        headerToolbar:{
            start:'prev,next prevYear,nextYear today',
            center:'title',
            end:'dayGridMonth,timeGridWeek'
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
            modEvento.show();
            console.log(info);
        },

        events:[
            { 
                title: 'Daily TIS', 
                start: '2024-04-15 14:15', 
                end: '2024-04-15 15:45' 
            },
            { 
                title: 'Dia del niño', 
                start: '2024-04-12', 
                allDay: true,
                backgroundColor: 'orange',
                rrule: {
                    freq: 'yearly',
                    interval: 1, // Cada 1 año
                    dtstart: '2024-04-12', 
                }	

            },
            { 
                title: 'Dia del Trabajo', 
                start: '2024-05-01', 
                allDay: true,
                backgroundColor: 'orange',
                rrule: {
                    freq: 'yearly',
                    interval: 1, // Cada 1 año
                    dtstart: '2024-05-01', 
                }	
            },
            { 
                title: 'Evento Universitario', 
                start: '2024-04-25 06:45', 
                end: '2024-04-25 14:00' 
            }
            
        ]
    });
    calendar.setOption('locale', 'es');
    calendar.render();
  });