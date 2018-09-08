var todayUI = '<div style="font-size: 2vh;">TODAY</div>';
var height = 0;
$(document).ready(function () {
    // PARDON ME while I do a little magic to keep these events relevant for the rest of time...

    var currentMonth = moment().format('YYYY-MM');
    var nextMonth    = moment().add('month', 1).format('YYYY-MM');

    var events = [];

    clndr = $('#full-clndr').clndr({
        template: $('#full-clndr-template').html(),
        events: events,
        forceSixRows: true,
        clickEvents: {
            click: function(target){
                updateUIOnSelectedDate(target);
                $.ajax({url: config.base_url+"index.php/api/task/"+target.date._i, success: function(result){
                    var toDoList = '';
                    for(i=0; i<result.length;i++)
                        toDoList += taskToViewModel(result[i]);
                    $("#todo-list").html(toDoList);
                }});
            },
            nextMonth: function(month){
                $('.today').html($('.today').html()+todayUI);
                $('td.day').css('height', height);
            },

            previousMonth: function(month){

                $('.today').html($('.today').html()+todayUI);
                $('td.day').css('height', height);
            },
        },

    });
    height = fillHeight();

    $('#todo-list').on('click', '.delete-button', function() {
        $.ajax({url: config.base_url+"index.php/task/delete/"+this.id,
            success: function(result){
                id = result.replace(/"/g, '');
                $('#task-'+id).remove();
            }});
    });


    $('.today').html($('.today').html()+todayUI);
    var today = new Date();
    $('#selected-date').html(dateToReadable(today));
    $('#date-time').val(dateToServer(today));

    $.ajax({url: config.base_url+"index.php/api/task/"+dateToServer(today), success: function(result){

        var toDoList = '';
        for(i=0; i<result.length;i++)
            toDoList += taskToViewModel(result[i]);
        $("#todo-list").html(toDoList);
    }});

});
