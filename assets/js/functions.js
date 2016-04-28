$.fn.showChartDataEntryTanggal = function(data){
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
        user = user.replace(" ","_");
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

$.fn.showChartDataEntryMinggu = function(data){
    var chart_data = data;
    Highcharts.setOptions({
        lang: {
            decimalPoint: ',',
            thousandsSep: '.'
        }
    });
    
    $.each(chart_data,function(user,weeks){
        var x = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        var y_now = [];
        var y_last = [];
        $.each(weeks,function(week,form){
            if(week=='thisweek'){
                $.each(form,function(index,value){
                    y_now.push(value);
                });
            }else{
                $.each(form,function(index,value){
                    y_last.push(value);
                });
            }
            
        });
        user = user.replace(" ","_");
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
                    name: 'Minggu Ini',
                    type: 'column',
                    data: y_now,
                    color: '#0000ff',
                    tooltip: {
                        valueSuffix: ''
                    }
                },{
                    name: 'Minggu Lalu',
                    type: 'column',
                    data: y_last,
                    color: '#ff0000',
                    tooltip: {
                        valueSuffix: ''
                    }
                }]
        });
    });
    
};

$.fn.showChartDataEntryBulan = function(data){
    var chart_data = data;
    Highcharts.setOptions({
        lang: {
            decimalPoint: ',',
            thousandsSep: '.'
        }
    });
    
    $.each(chart_data,function(user,months){
        var x = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        var y_now = [];
        var y_last = [];
        var thisyear = 0;
        var lastyear = 0;
        $.each(months,function(month,form){
            if(month=='thisyear'){
                $.each(form,function(index,value){
                    thisyear = index.split("-");
                    y_now.push(value);
                });
            }else{
                $.each(form,function(index,value){
                    lastyear = index.split("-");
                    y_last.push(value);
                });
            }
            
        });
        user = user.replace(" ","_");
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
                    name: 'Tahun '+thisyear[0],
                    type: 'column',
                    data: y_now,
                    color: '#0000ff',
                    tooltip: {
                        valueSuffix: ''
                    }
                },{
                    name: 'Tahun '+lastyear[0],
                    type: 'column',
                    data: y_last,
                    color: '#ff0000',
                    tooltip: {
                        valueSuffix: ''
                    }
                }]
        });
    });
    
};

$.fn.showChartDataEntryForm = function(data){
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
        user = user.replace(" ","_");
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