$(document).ready(function() {

    $(".col-chart .one-box").click(function () {
        $(".col-chart .one-box").removeClass("active");
        $(this).addClass("active");
    });

    $('#config-demo').daterangepicker({
        "timePicker": true,
        "ranges": {
            "Hôm nay": [
                "2020-08-22T02:51:52.462Z",
                "2020-08-22T02:51:52.462Z"
            ],
            "Hôm qua": [
                "2020-08-21T02:51:52.462Z",
                "2020-08-21T02:51:52.462Z"
            ],
            "7 ngày trước": [
                "2020-08-16T02:51:52.462Z",
                "2020-08-22T02:51:52.462Z"
            ],
            "30 ngày trước": [
                "2020-07-24T02:51:52.463Z",
                "2020-08-22T02:51:52.463Z"
            ],
            "Tháng này": [
                "2020-07-31T17:00:00.000Z",
                "2020-08-31T16:59:59.999Z"
            ],
            "Tháng trước": [
                "2020-06-30T17:00:00.000Z",
                "2020-07-31T16:59:59.999Z"
            ]
        },
        "startDate": "08/16/2020",
        "endDate": "08/22/2020"
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });


    //line chart====
    var config = {
        type: 'line',
        data: {
            labels: ['1/2019', '2/2019', '3/2019', '4/2019', '5/2019', '6/2019', '7/2019','8/2019', '9/2019', '10/2019', '11/2019', '12/2019'],
            datasets: [{
                label: 'Tổng BĐS',
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                fill: false,
            }, {
                label: 'BĐS tạm ngưng',
                fill: false,
                backgroundColor: window.chartColors.yellow,
                borderColor: window.chartColors.yellow,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
            },{
                label: 'BĐS không liên lạc được',
                fill: false,
                backgroundColor: window.chartColors.green,
                borderColor: window.chartColors.green,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
            },{
                label: 'BĐS đã giao dịch',
                fill: false,
                backgroundColor: window.chartColors.orange,
                borderColor: window.chartColors.orange,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
            },{
                label: 'BĐS chờ xóa',
                fill: false,
                backgroundColor: window.chartColors.purple,
                borderColor: window.chartColors.purple,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
            }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                x: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                },
                y: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }
            }
        }
    };

    var ctx1 = document.getElementById('canvas-line').getContext('2d');
    window.myLine = new Chart(ctx1, config);

    //slider block info===
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1024:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });

    $('.date-dp-component input').datepicker();

});