$.fn.showChartDataEntry = function(data){
    var chart_data = data;
    Highcharts.setOptions({
        lang: {
            decimalPoint: ',',
            thousandsSep: '.'
        }
    });
    
    $.each(chart_data,function(user,form){
        var x = [];
        var y = [];
        $.each(form,function(index,value){
            x.push(index);
            y.push(value);
        });
        $('#'+user).highcharts({			
            chart: {
                zoomType: 'xy',
                height: 400
            },
            title: {
                text: ''
            },
            xAxis: [{
                    categories: x
                }],
            yAxis: [{min:0,startOnTick: false},{min:0,startOnTick: false,opposite: true},{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: 'Jumlah Entry',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }],
            tooltip: {
                shared: true
            },
            legend: {
                enabled : false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },
            series: [{
                    name: 'Jumlah Entry',
                    type: 'column',
                    data: y,
                    color: '#73c1f7',
                    tooltip: {
                        valueSuffix: ''
                    }
                }]
        });
    });
    
};