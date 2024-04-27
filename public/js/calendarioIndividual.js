
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

        //control de vista
        eventClassNames: function(arg) {
            var hayOcupado = false;
            if (arg.event.title === 'Libre') {
                var fecha = arg.event.start;
                var fechaFormateada = fecha.getFullYear() + '-' + ('0' + (fecha.getMonth() + 1)).slice(-2) + '-' + ('0' + fecha.getDate()).slice(-2) + ' ' + ('0' + fecha.getHours()).slice(-2) + ':' + ('0' + fecha.getMinutes()).slice(-2);

                console.log(fecha);

                totalEventos.forEach(function(evento2) {

                    if(evento2.title === 'Ocupado'){
                        //console.log(evento2.start);
                        if (evento2.start === fechaFormateada) {
                            console.log('evento '+ arg.event.title+ ' de dia y hora: ' + fechaFormateada + ' coincide con: ');
                            console.log('evento '+ evento2.title+ ' de dia y hora: ' + evento2.start);

                            hayOcupado = true;
                        }
                    }
                    
                });

            }

            if(hayOcupado === true){
                return ['detectaOcupado']; 
            }else if(arg.event.title === 'Ocupado'){
                return ['ocupado']; 
            }else{
                return ''; 
            }
        },

    });
    calendar.setOption('locale', 'es');
    calendar.render();
  });