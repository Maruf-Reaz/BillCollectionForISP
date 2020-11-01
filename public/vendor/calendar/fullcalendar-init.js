$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: '/holidays/calendar-events/get-events',
        selectable: true,
        selectHelper: true,
        height: 500,
    });
});