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
<link rel="stylesheet" href="<?=base_url();?>styles/global_results.css">
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

<script type="text/javascript">
    FusionCharts.ready(function(){
        var reliance_gauge = new FusionCharts({
                type: 'angulargauge',
                renderAt: 'reliance-gauge',
                width: '100%',
                height: '300',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Reliance score",
                        "subcaption":"Health quality and independance level",
                        "lowerLimit": "0",
                        "upperLimit": "100",
                        "showGaugeBorder": "0",
                        "showValue": "1",
                        "valueBelowPivot": "1",
                        "theme": "fint",
                        "numbersuffix": "%",
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
                                "maxValue": "40",
                                "code": "#bb0008"
                            },
                            {
                                "minValue": "40",
                                "maxValue": "50",
                                "code": "#f83f00"
                            },
                            {
                                "minValue": "50",
                                "maxValue": "60",
                                "code": "#ffe919"
                            },
                            {
                                "minValue": "60",
                                "maxValue": "75",
                                "code": "#d1fe00"
                            },
                            {
                                "minValue": "75",
                                "maxValue": "90",
                                "code": "#72e300"
                            },
                            {
                                "minValue": "90",
                                "maxValue": "100",
                                "code": "#1ac100"
                            }
                        ]
                    },
                    "dials": {
                        "dial": [
                            {
                                "value": "<?php echo $reliance_score;?>"
                            }
                        ]
                    }
                }
            }
        );
        reliance_gauge.render();
    });
</script>

<div id="jumbotron-content" class="container">
    <div id="jumbotron-area" class="jumbotron">
        <div class="row">
            <div id="reliability" class=" col-lg-6">
                <div id="reliability-gauge"></div>
            </div>
            <div id="reliance" class="col-lg-6">
                <div id="reliance-gauge"></div>
            </div>
        </div>
        <div id="button_row" class="row">
<!--            <div class="col-lg-6">-->
<!--                <a href="--><?//=base_url();?><!--index.php/Survey/results" class="button"> View Report </a>-->
<!--            </div>-->
            <div class="col-lg-6 text-center">
                <a href="<?=base_url();?>index.php/Survey/reliability_explanation" class="button"> Reliability explanation </a>
            </div>
            <div class="col-lg-6 text-center">
                <a href="#" class="button"> Reliance explanation </a>
            </div>
        </div>
    </div>
</div>

