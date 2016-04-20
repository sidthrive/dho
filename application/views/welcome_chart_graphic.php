
<!--
    grafik k1_akses
--> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'chartK1AksesContainer',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	                text: 'K1 Akses',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: [
                            <?php 
                                foreach($K1username as $i => $data){
                                    echo ($i < sizeof($K1username) ?'"'.$data.'",':'"'.$data.'"');
                                }
                            ?>
                        ]
	            },
	            yAxis: {
	                title: {
	                    text: 'Persentase K1 Akses'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            
	            series: [{
                            name: 'persentase',
                            data:[
                            <?php 
                                foreach($K1percentage as $i => $data){
                                    echo ($i < sizeof($K1percentage) ?$data.',':$data);
                                }
                            ?>
                    ]}]
	        }
	                chart = new Highcharts.Chart(options);

	    });
		</script>
		 <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        
        
<!--
    grafik k4
-->        
        <script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'chartK4Container',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	                text: 'K4',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: [
                            <?php 
                                foreach($K4username as $i => $data){
                                    echo ($i < sizeof($K4username) ?'"'.$data.'",':'"'.$data.'"');
                                }
                            ?>
                        ]
	            },
	            yAxis: {
	                title: {
	                    text: 'Persentase K4'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            
	            series: [{
                            name: 'persentase',
                            data:[
                            <?php 
                                foreach($K4percentage as $i => $data){
                                    echo ($i < sizeof($K4percentage) ?$data.',':$data);
                                }
                            ?>
                    ]}]
	        }
	                chart = new Highcharts.Chart(options);

	    });
            </script>
            
<!--
    grafik kunjungan neonatal 1
-->        
        <script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'chartKunjunganNeonatal1Container',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	                text: 'Kunjungan Neonatal 1',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: [
                            <?php 
                                foreach($KNeo1username as $i => $data){
                                    echo ($i < sizeof($KNeo1username) ?'"'.$data.'",':'"'.$data.'"');
                                }
                            ?>
                        ]
	            },
	            yAxis: {
	                title: {
	                    text: 'Persentase Kunjungan'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            
	            series: [{
                            name: 'persentase',
                            data:[
                            <?php 
                                foreach($KNeo1percentage as $i => $data){
                                    echo ($i < sizeof($KNeo1percentage) ?$data.',':$data);
                                }
                            ?>
                    ]}]
	        }
	                chart = new Highcharts.Chart(options);

	    });
            </script>

<!--
    grafik kunjungan neonatal 3
-->        
        <script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'chartKunjunganNeonatal3Container',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	                text: 'Kunjungan Neonatal 3',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: [
                            <?php 
                                foreach($KNeo3username as $i => $data){
                                    echo ($i < sizeof($KNeo3username) ?'"'.$data.'",':'"'.$data.'"');
                                }
                            ?>
                        ]
	            },
	            yAxis: {
	                title: {
	                    text: 'Persentase Kunjungan'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            
	            series: [{
                            name: 'persentase',
                            data:[
                            <?php 
                                foreach($KNeo3percentage as $i => $data){
                                    echo ($i < sizeof($KNeo3percentage) ?$data.',':$data);
                                }
                            ?>
                    ]}]
	        }
	                chart = new Highcharts.Chart(options);

	    });
            </script>            
    
            
<!--
    grafik kunjungan nifas
-->        
        <script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'chartKunjunganNifasContainer',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	                text: 'Kunjungan Nifas',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: [
                            <?php 
                                foreach($KNifasusername as $i => $data){
                                    echo ($i < sizeof($KNifasusername) ?'"'.$data.'",':'"'.$data.'"');
                                }
                            ?>
                        ]
	            },
	            yAxis: {
	                title: {
	                    text: 'Persentase Kunjungan'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            
	            series: [{
                            name: 'persentase',
                            data:[
                            <?php 
                                foreach($KNifaspercentage as $i => $data){
                                    echo ($i < sizeof($KNifaspercentage) ?$data.',':$data);
                                }
                            ?>
                    ]}]
	        }
	                chart = new Highcharts.Chart(options);

	    });
            </script>            
            
            
<!--
    grafik kematian balita
-->        
        <script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'chartKematianBalitaContainer',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	                text: 'Kematian Balita',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: [
                            <?php 
                                foreach($KBalitausername as $i => $data){
                                    echo ($i < sizeof($KBalitausername) ?'"'.$data.'",':'"'.$data.'"');
                                }
                            ?>
                        ]
	            },
	            yAxis: {
	                title: {
	                    text: 'Persentase Kematian'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            
	            series: [{
                            name: 'persentase',
                            data:[
                            <?php 
                                foreach($KBalitapercentage as $i => $data){
                                    echo ($i < sizeof($KBalitapercentage) ?$data.',':$data);
                                }
                            ?>
                    ]}]
	        }
	                chart = new Highcharts.Chart(options);

	    });
            </script>            
            
        