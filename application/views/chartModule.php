<?php
    $chartRender = 'chartRender';
    $titleText = 'Titlt Text';
    $yAxisTitle = 'Value of Y';
    $xAxisCategories = ['a','b','c','d','e'];
    $chartRender = 'chartRender';
?>
<?php
    echo '

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
            var options = {
        chart: {
            renderTo: '.$chartRender.',
            type: \'column\',
            marginRight: 130,
            marginBottom: 60
        },
        title: {
            text: '.$titleText.',
            x: -20 //center
        },
        subtitle: {
            text: \'\',
            x: -20
        },
        xAxis: {
            categories: [';
                    foreach($K1username as $i => $data){
                        echo ($i < sizeof($K1username) ?'"'.$data.'",':'"'.$data.'"');
                    }
        echo '    ]
        },
        yAxis: {
            title: {
                text: '.$yAxisTitle.'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: \'#808080\'
            }]
        },
        tooltip: {
            formatter: function() {
                return \'<b>\'+ this.series.name +\'</b><br/>\'+
                this.x +\': \'+ this.y;
            }
        },
        legend: {
            layout: \'vertical\',
            align: \'right\',
            verticalAlign: \'top\',
            x: -10,
            y: 100,
            borderWidth: 0
        },

        series: [{
            name: '.$seriesName.',
            data:[';
            
                foreach($K1percentage as $i => $data){
                    echo ($i < sizeof($K1percentage) ?$data.',':$data);
                }
            
    echo ']}]
    }
    chart = new Highcharts.Chart(options);

    });
    </script>
         <script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
</head>'
    
?>