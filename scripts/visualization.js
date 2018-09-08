
var noDataUI = '<h1>No result on selected dates</h1>';
$(document).ready(function () {

    var today = new Date();
    $('#dtp-end-date').val(dateToServer(today));
    var lastThreeMonth = new Date();
    lastThreeMonth.setMonth(today.getMonth() - 3);
    $('#dtp-start-date').val(dateToServer(lastThreeMonth));

    $('#btn-visualize').click(function() {
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(visualizeFrequencyChart);
    });
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(visualizeFrequencyChart);

});

function visualizeFrequencyChart() {
    var question_id = $('#question_id').val();
    var startDate = $('#dtp-start-date').val();
    var endDate = $('#dtp-end-date').val();
    var response = '';
    $.ajax({
        url: config.base_url+"index.php/api/Survey_Report/"+question_id+"/"+startDate+"/"+endDate,
        dataType: "json",
        async: false,
        success:function(data){
            response = data;
        }
    });
    var data = {
        "cols": [
            {"id":"","label":"Choice","pattern":"","type":"string"},
            {"id":"","label":"Frequency","pattern":"","type":"number"}
        ],
        "rows": []
    };
    var rows = [];
    for (var i=0; i< response.length; i++) {
        var temp = {"c":[{"v": response[i].en_selected_choice,"f":null},{"v": response[i].frequency,"f":null}]};
        data.rows.push(temp);
    }
    var data = new google.visualization.DataTable(data);

    var options = {
        legend: { position: 'none' },
        bars: 'horizontal',
        colors: ['#1F4F58'],
        axes: {
            x: {0: { side: 'top', label: 'Percentage'} }
        },
        bar: { groupWidth: "80%" }
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    google.visualization.events.addListener(chart, 'select', selectHandler);

    function selectHandler() {
        var selection = chart.getSelection();
        var category = data.getValue(chart.getSelection()[0].row, 0);
        $.ajax({
            url: config.base_url+"index.php/api/Survey_Report/"+question_id+"/"+startDate+"/"+endDate+"/"+category,
            dataType: "json",
            async: false,
            success:function(data){
                var description = $('#question-text').html() + '<br/><br>Choice <b>' + category + '</b> was selected on: ';
                $('#selected-description').html(description);
                var temp = '';
                for (var i = 0; i<data.length; i++)
                    temp += '<li>'+ data[i].created_date +'</li>';
                $('#lst-answer-date').html(temp);
            }
        });

        $('#answer-date-modal').modal('show');
        chart.setSelection([]);
    }

    chart.draw(data, options);
}