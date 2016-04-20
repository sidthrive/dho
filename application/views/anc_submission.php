<link href="<?php echo base_url() ?>assets/fonts.css" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
                var userId = ["User1","User2","User3","User4","User5","User6","User8","User9","User10"];
                var titleText = ["User 1","User 2","User 3","User 4","User 5","User 6","User 8","User 9","User 10"];
                var docName = ["user1","user2","user3","user4","user5","user6","user8","user9","user10"];
		var i=0;
                
                $(document).ready(function() {
                    var options = {
	            chart: {
	                renderTo: userId[0],
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: titleText[0],
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/"+docName[0], function(json) {
	        	options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        //	options.series[1] = json[2];
	        	//options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);

	        });
	    });
                i=i+1;
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: userId[1],
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: titleText[1],
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/"+docName[1], function(json) {
	        	options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        //	options.series[1] = json[2];
	        	//options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);

	        });
	    });
		
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: userId[2],
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: titleText[2],
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/"+docName[2], function(json) {
	        	options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        //	options.series[1] = json[2];
	        	//options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);

	        });
	    });
		
                $(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: userId[3],
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: titleText[3],
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/"+docName[3], function(json) {
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
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/user5", function(json) {
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
	                renderTo: 'User6',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: 'User 6',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/user6", function(json) {
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
	                renderTo: 'User8',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: 'User 8',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/user8", function(json) {
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
	                renderTo: 'User9',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: 'User 9',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/user9", function(json) {
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
	                renderTo: 'User10',
	                type: 'column',
	                marginRight: 130,
	                marginBottom: 60
	            },
	            title: {
	            	text: 'User 10',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Form Submission ANC',
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
	        $.getJSON("Anc_submission/user10", function(json) {
	        	options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        //	options.series[1] = json[2];
	        	//options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);

	        });
	    });
		</script>
		 <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
<!--[if IE 6]>

		<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
	    <script src="<?php echo base_url() ?>assets/js/exporting.js"></script>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>	
