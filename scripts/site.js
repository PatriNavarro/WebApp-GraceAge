var clndr = {};
var defaultColor = '#4f4f4f';
var defaultBackgroundColor = '#ebebeb';

function fillHeight() {
    parentHeight = $('#full-clndr').height() - $('#nav-container').height() - $('#controls').height() - $('.days-of-the-week').height();
    height = Math.floor(parentHeight/6);
    $('td.day').css('height', height);
    return height;
}

function updateUIOnSelectedDate(target) {
    $('.selected-day').css('background-color', defaultBackgroundColor);
    $('.selected-day').css('color', defaultColor);
    $('.today').css('background-color', 'white');
    $(target.element).css('background-color', defaultColor);
    $(target.element).css('color', defaultBackgroundColor);
    $(target.element).addClass('selected-day');
    $('#date-time').val(target.date._i);
}
function taskToViewModel(task) {
    var date = new Date(task.task_date);
    return '<tr id="task-'+ task.id+'" style=" margin: 0">'+
        '<td colspan="3"> '+
        date.getHours() + ':' + date.getMinutes() + ' ' + task.description +
        '</td>' +
        '<td align="right">'+
        '<button class="btn delete-button" style="padding: 5px; margin-top: 5px" type="button" id="'+task.id+'">Delete</button>'+
        '</td>+' +
        '</tr>';
}
function dateToReadable(date) {
    var month = (parseInt(date.getMonth())+1);
    if (month < 10)
        month = '0' + month.toString();
    var day = (parseInt(date.getDate())+1);
    if (day < 10)
        day = '0' + day.toString();
    return date.getFullYear()+'-'+month+'-'+day;
}
function dateToServer(date) {
    var month = (parseInt(date.getMonth())+1);
    if (month < 10)
        month = '0' + month.toString();
    var day = (parseInt(date.getDate())+1);
    if (day < 10)
        day = '0' + day.toString();
    return date.getFullYear()+'-'+month+'-'+day;
}