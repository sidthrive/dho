<link href="<?php echo base_url() ?>assets/fonts.css" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
                <script type="text/javascript">
                function graph( username, subtitleText) {
                    var options = {
	            chart: {
	                renderTo: username,
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: username,
	                x: -20 //center
	            },
	            subtitle: {
	                text: subtitleText,
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
	            yAxis: {
	                title: {
	                    text: 'Jumlah'
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
	            
	            series: []
	        }
	        $.getJSON(("Pnc_submission/"+username), function(json) {
	        	options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        //	options.series[1] = json[2];
	        	//options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);

	        });
	    }
                
		$(document).ready(graph("user1","PNC Form Submission"));
		</script>

		
		<script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'User4',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: 'User 4',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'PNC Form Submission',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
	            yAxis: {
	                title: {
	                    text: 'Jumlah'
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
	            
	            series: []
	        }
	        $.getJSON("Pnc_submission/user4", function(json) {
	        	options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        //	options.series[1] = json[2];
	        	//options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);

	        });
	    });
		</script>

		<script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'User5',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: 'User 5',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'PNC Form Submission',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
	            yAxis: {
	                title: {
	                    text: 'Jumlah'
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
	            
	            series: []
	        }
	        $.getJSON("Pnc_submission/user5", function(json) {
	        	options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        //	options.series[1] = json[2];
	        	//options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);

	        });
	    });
		</script>

		</script>
		 <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
<!--[if IE 6]>

		<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
	    <script src="<?php echo base_url() ?>assets/js/exporting.js"></script>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>	
