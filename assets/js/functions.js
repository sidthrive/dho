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
        user = user.replace(/ /g,"_");
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

$.fn.showChartDataEntryTanggalDrill = function(data,url){
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
        var drill = [];
        var a = 0;
        $.each(form,function(index,value){
            x.push(index);
            y.push({"name":index,"y":value,"drilldown":index});
        });
        //console.log(drill);
        user = user.replace(/ /g,"_");
        $('#'+user).highcharts({			
            chart: {
                type: 'column',
                zoomType: 'xy',
                height: 400,
                events: {
                    drilldown: function (e) {
                        if (!e.seriesOptions) {
                            
                            var chart = this,
                                drilldowns = [],
                                series = [];
                            $.get(url+user+"/"+e.point.name,function(data){
                                drilldowns = jQuery.parseJSON(data);
                                series = drilldowns[e.point.name];
                                chart.hideLoading();
                                chart.addSeriesAsDrilldown(e.point, series);
                            }).fail(function(jqxhr, textStatus, error ) {
                               var err = textStatus + ", " + error;
                                console.log( "Request Failed: " + err );
                                console.log( "User failed: " + user + ", "+e.point.name );
                            });
                            // Show the loading label
                            chart.showLoading('Mengambil data ...');
                        }

                    }
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
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
                }],
            drilldown: {
                series: []
            }
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
        user = user.replace(/ /g,"_");
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
        user = user.replace(/ /g,"_");
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
        user = user.replace(/ /g,"_");
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

$.fn.showChart = function(data){
    $.each(data,function(index1,data1){
        var id = data1['page'];
        var x = [];
        var y = [];
        $.each(data1['form'],function(index2,data2){
            x.push(index2);
            y.push(data2);
        });
        Highcharts.setOptions({
            lang: {
                decimalPoint: ',',
                thousandsSep: '.'
            }
        });

        $('#'+id).highcharts({			
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
            yAxis: [{min:0,minrange:100},{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: data1['y_label'],
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }],
            tooltip: {
                shared: true,
                pointFormat: data1['y_label']+": {point.y:.2f} %"
            },
            legend: {
                enabled : false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.2f}'
                    }
                }
            },
            series: [{
                    name: data1['series_name'],
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

$.fn.showChartStack = function(data){
    $.each(data,function(index1,data1){
        var id = data1['page'];
        var x = [];
        var y1 = [];
        var y2 = [];
        $.each(data1['form'],function(index2,data2){
            x.push(index2);
            y1.push(data2['l']);
            y2.push(data2['p']);
        });
        Highcharts.setOptions({
            lang: {
                decimalPoint: ',',
                thousandsSep: '.'
            }
        });

        $('#'+id).highcharts({			
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
            legend: {
                enabled : false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y + '<br/>' +
                        'Total: ' + this.point.stackTotal;
                }
            },  
            series: [{
                    name: data1['series_name'][0],
                    type: 'column',
                    data: y1,
                    color: 'blue'
                },{
                    name: data1['series_name'][1],
                    type: 'column',
                    data: y2,
                    color: 'red'
                }]
        });
    });
};

$.fn.showChartStackDouble = function(data){
    $.each(data,function(index1,data1){
        var id = data1['page'];
        var x = [];
        var y1bl = [];
        var y2bl = [];
        var y1bi = [];
        var y2bi = [];
        $.each(data1['form'],function(index2,data2){
            x.push(index2);
            y1bl.push(data2['lbl']);
            y2bl.push(data2['pbl']);
            y1bi.push(data2['lbi']);
            y2bi.push(data2['pbi']);
        });
        Highcharts.setOptions({
            lang: {
                decimalPoint: ',',
                thousandsSep: '.'
            }
        });

        $('#'+id).highcharts({			
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
            legend: {
                enabled : false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.options.stack + '</b><br/>' +
                            '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y + '<br/>' +
                        'Total: ' + this.point.stackTotal;
                }
            },
            series: [{
                    name: data1['series_name'][0],
                    type: 'column',
                    data: y1bl,
                    color: 'green',
                    stack: data1['series_stack_name'][0]
                },{
                    name: data1['series_name'][1],
                    type: 'column',
                    data: y2bl,
                    color: 'yellow',
                    stack: data1['series_stack_name'][0]
                },{
                    name: data1['series_name'][0],
                    type: 'column',
                    data: y1bi,
                    color: 'blue',
                    stack: data1['series_stack_name'][1]
                },{
                    name: data1['series_name'][1],
                    type: 'column',
                    data: y2bi,
                    color: 'red',
                    stack: data1['series_stack_name'][1]
                }]
        });
    });
};