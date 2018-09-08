var resultRowUI = '<tr">\n' +
    '                <td valign="top" style="padding-bottom: 1em;">%question_order%. </td>\n' +
    '                <td valign="top" style="width: 85%;padding-bottom: 1em;" >%question%</td>\n' +
    '                <td style="padding-bottom: 1em;"><button type="button"  id="%question_id%" class="btn btn-visualize">Visualize</button></td>\n' +
    '            </tr>' ;
var noDataUI = '<h1>No result on selected date</h1>';

$(document).ready(function () {
    $('#dtp-selected-date').change(function() {
        var selectedDate = $('#dtp-selected-date').val();
        $('#selected-date').html(selectedDate);
        getResult(selectedDate);
    });

    $('#result-contents').on('click', '.btn-visualize', function() {
        $(location).attr('href', config.base_url+"index.php/Survey/visualize/"+this.id);
    });
    var today = new Date();
    $('#dtp-selected-date').val(dateToServer(today));
    getResult(dateToServer(today));
    $('#selected-date').html(dateToReadable(today));

});

function getResult() {
    $.ajax({
        url: config.base_url+"index.php/api/Survey",
        success: function(result){
            var n = result.length;
            var ui = '';
            for (var i =0; i< n; i++) {
                var temp = resultRowUI.replace('%question_order%', result[i].question_id);
                temp = temp.replace('%question%', result[i].question);
                temp = temp.replace('%question_id%', result[i].id);
                ui += temp;
            }
            if (n== 0)
                ui = noDataUI;
            $('#result-contents').html(ui);
        },
    });

}
