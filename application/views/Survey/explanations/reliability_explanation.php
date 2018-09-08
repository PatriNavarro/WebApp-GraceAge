<?php
/**
 * Created by PhpStorm.
 * User: Patri Navarro
 * Date: 08/12/2017
 * Time: 13:57
 *
 * Global view of the results as a gauge meter with a js plugin.
 */
?>
<link rel="stylesheet" href="<?=base_url();?>styles/main_page.css">
<link rel="stylesheet" href="<?=base_url();?>styles/reliability_explanation.css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>

<script type="text/javascript">
    FusionCharts.ready(function(){
        var reliability_gauge = new FusionCharts({
                type: 'angulargauge',
                renderAt: 'reliability-gauge',
                width: "100%",
                height: "300",
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Reliability score",
                        "subcaption":"Number of questions not answered",
                        "lowerLimit": "0",
                        "upperLimit": "80",
                        "showGaugeBorder": "0",
                        "showValue": "1",
                        "valueBelowPivot": "1",
                        "theme": "fint",
                        //Caption cosmetics
                        "captionFont": "Lato",
                        "captionFontSize": "40",
                        "captionFontColor": "#000000",
                        //Indicator font configuration
                        "baseFont": "Lato",
                        "baseFontSize": "40",
                        "baseFontColor": "#000000",
                        //Outside canvas base font configuration
                        "outCnvBaseFont": "Lato",
                        "outCnvBaseFontSize": "16",
                        "outCnvBaseFontColor": "#6B6D72"
                    },
                    "colorRange": {
                        "color": [
                            {
                                "minValue": "0",
                                "maxValue": "10",
                                "code": "#1ac100"
                            },
                            {
                                "minValue": "10",
                                "maxValue": "20",
                                "code": "#ffe919"
                            },
                            {
                                "minValue": "20",
                                "maxValue": "80",
                                "code": "#bb0008"
                            }
                        ]
                    },
                    "dials": {
                        "dial": [
                            {
                                "value": "<?php echo $reliability_score;?>"
                            }
                        ]
                    }
                }
            }
        );
        reliability_gauge.render();
    });
</script>

<div id="jumbotron-content" class="container">
    <div id="jumbotron-area" class="jumbotron">
        <div class="row">
            <div id="reliability" class=" col-lg-6">
                <div id="reliability-gauge"></div>
            </div>
            <div id="reliance" class="col-lg-6">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Score</th>
                        <th>Meaning</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="green" class="success">
                        <td>0 - 10</td>
                        <td>Many questions were answered, score is reliable.</td>
                    </tr>
                    <tr id="yellow" class="warning">
                        <td>10 - 20</td>
                        <td>Many questions were not answered, score may be unreliable, this may be an indication of low self-reliance.</td>
                    </tr>
                    <tr id="red" class="danger">
                        <td>20 - 40</td>
                        <td>Too many questions were not answered, score is not reliable, this may be an indication of low self-reliance.</td>
                    </tr>
                </div>
            </div>
        </div>
        <div id="button_row" class="row">
            <div class="col-lg-6 text-center">
                <a href="<?=base_url();?><!--index.php/Caregiver/surveyresults" class="button"> Back to results view </a>
            </div>
        </div>
    </div>
</div>