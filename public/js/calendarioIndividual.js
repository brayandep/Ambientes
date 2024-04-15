var modEvento = new bootstrap.Modal(document.getElementById('exampleModal'));
//calendario
document.addEventListener('DOMContentLoaded', function() {
    var today = new Date();
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'timeGridWeek',
        slotMinTime: '06:45',
        slotLabelInterval: '1:30:00',
        slotDuration: '00:45',
        slotMaxTime: '21:46',
        expandRows: true,
        hiddenDays: [ 0 ],
        validRange: {
            start: today, // El día actual será el primer día permitido
        },

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
            modEvento.show();
            console.log(info);
        },

        events:[
            { 
                title: 'Libre', 
                start: '2024-04-15', 
                backgroundColor: '#CD9DC0', 
                startTime: '09:45',
                endTime: '11:15',
                daysOfWeek: [1,3,5]
            },
            { 
                title: 'Libre', 
                start: '2024-04-15 17:15', 
                end: '2024-04-15 18:45',
                backgroundColor: '#CD9DC0',
                startTime: '17:15',
                endTime: '18:45',
                daysOfWeek: [1] 

            },
            { 
                title: 'Libre', 
                start: '2024-04-19 08:15', 
                end: '2024-04-19 09:45',
                backgroundColor: '#CD9DC0',
                startTime: '08:15',
                endTime: '09:45',
                daysOfWeek: [5] 

            },
            { 
                title: 'Ocupado', 
                start: '2024-04-15 11:15', 
                end: '2024-04-15 12:45',
                backgroundColor: '#F35D5D',
                startTime: '11:15',
                endTime: '12:45',
                daysOfWeek: [1] 
            },
            { 
                title: 'Ocupado', 
                start: '2024-04-17 17:15', 
                end: '2024-04-17 18:45',
                backgroundColor: '#F35D5D',
                startTime: '17:15',
                endTime: '18:45',
                daysOfWeek: [3] 
            }
            
        ]
    });
    calendar.setOption('locale', 'es');
    calendar.render();
  });