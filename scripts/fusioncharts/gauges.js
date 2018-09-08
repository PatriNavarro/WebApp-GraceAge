function selfRelianceGauge(score) {
    type="text/javascript">
        FusionCharts.ready(function () {
            var csatGauge = new FusionCharts({
                "type": "angulargauge",
                "renderAt": "chart-container",
                "width": "400",
                "height": "250",
                "dataFormat": "json",
                "dataSource":{
                    "chart": {
                        "caption": "Self-Reliance Score",
                        "subcaption": "Survey done on:",
                        "lowerLimit": "0",
                        "upperLimit": "100"
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
                                "value": score
                            }
                        ]
                    }
                }
            });

            csatGauge.render();
        });
}

