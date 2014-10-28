// MONITORS -----------------------------------------------------------------------------------------
 //function refreshPage() { location.reload(); }
 //setInterval('refreshPage()', 7200000);

// DATA FROM DB FOR MONITORS      ------------------------------------------------------------------- 
        var res_count = 0;
        function getData(input) {
            $.ajax({
                url: "http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/db/getData.php",
                type: "GET",
                async: false,
                dataType: "json",
				data: input,
                success: function(count) {
                    res_count = count;
                }
            });

            return res_count;
        }
		
		function getData_avk6b1() {
			data = getData('server=avk6b1&action=orders&interval='+interval_cluster)
			if (!data) { data = ["0","0"] }
			return data
		}
		function getData_hgd0b1() {
			data = getData('server=hgd0b1&action=orders&interval='+interval_cluster)
			if (!data) { data = ["0","0"] }
			return data
		}
		function getData_hgd0b2() {
			data = getData('server=hgd0b2&action=orders&interval='+interval_cluster)
			if (!data) { data = ["0","0"] }
			return data
		}
		function getData_kstb1() {
			data = getData('server=kstb1&action=orders&interval='+interval_cluster)
			if (!data) { data = ["0","0"] }
			return data
		}
		function getData_test() {
			data = getData('server=test&action=orders&interval='+interval_test)
			if (!data) { data = ["0","0"] }
			return data		
		}
				
				
		data_avk6b1 = getData_avk6b1();
		data_hgd0b1 = getData_hgd0b1();
		data_hgd0b2 = getData_hgd0b2();	
		data_kstb1 = getData_kstb1();	
		data_test = getData_test();
		
		console.log(data_kstb1);
		
		data_cluster_transactions_success = parseInt(getData('server=avk6b1&action=transactions_success'))+parseInt(getData('server=hgd0b1&action=transactions_success'))+parseInt(getData('server=hgd0b2&action=transactions_success'))
		data_cluster_transactions_failed = parseInt(getData('server=avk6b1&action=transactions_failed'))+parseInt(getData('server=hgd0b1&action=transactions_failed'))+parseInt(getData('server=hgd0b2&action=transactions_failed'))
		data_cluster_transactions_full = data_cluster_transactions_success+data_cluster_transactions_failed;
		data_cluster_percent = (data_cluster_transactions_success*100)/data_cluster_transactions_full;
		// Mobile orders success for past 24H
		data_cluster_transactions_mob_success = getData('server=avos&action=transactions_mob_success');
		//console.log(data_cluster_transactions_mob_success);
		// Mobile orders failed for past 24H
		data_cluster_transactions_mob_failed = getData('server=avos&action=transactions_mob_failed');
		
		data_test_transactions_success = parseInt(getData('server=test&action=transactions_success'))
		data_test_transactions_failed = parseInt(getData('server=test&action=transactions_failed'))
		data_test_transactions_full = data_test_transactions_success+data_test_transactions_failed
		data_test_percent = (data_test_transactions_success*100)/data_test_transactions_full
				
		//console.log(data_test)
		data_test_slice = data_test.slice(-31, -1)

		function getData_all() {
			data_all = getData_avk6b1().slice(-31, -1);
			length = data_all.length;
			
			data_avk6b1_slice = getData_avk6b1().slice(-31, -1)
			data_hgd0b1_slice = getData_hgd0b1().slice(-31, -1)
			data_hgd0b2_slice = getData_hgd0b2().slice(-31, -1)
			data_kstb1_slice = getData_kstb1().slice(-31, -1)

			for (var i = 0; i < length; i++ ) {
			 if (typeof (data_hgd0b1_slice[i]) == 'undefined') { data_hgd0b1_slice[i]=["0","0"] }
			 if (typeof (data_all[i][1]) == 'undefined') { data_all[i][1]="1" }
			 data_all[i][1] = parseInt(data_avk6b1_slice[i][1]) + parseInt(data_hgd0b1_slice[i][1])
			}
			
			for (var i = 0; i < length; i++ ) {
			 if (typeof (data_hgd0b2_slice[i]) == 'undefined') { data_hgd0b2_slice[i]=["0","0"]}
			 if (typeof (data_all[i][1]) == 'undefined') { data_all[i][1]="1" }
			 data_all[i][1] = parseInt(data_all[i][1]) + parseInt(data_hgd0b2_slice[i][1])
			}
			
			for (var i = 0; i < length; i++ ) {
			 if (typeof (data_kstb1_slice[i]) == 'undefined') { data_kstb1_slice[i]=["0","0"]}
			 if (typeof (data_all[i][1]) == 'undefined') { data_all[i][1]="1" }
			 data_all[i][1] = parseInt(data_all[i][1]) + parseInt(data_kstb1_slice[i][1])
			}
			
			return data_all;
		}
		
		data_all = getData_all();
		

$(function () {		  

	 /* Date */  
	var months = new Array(12);
	months[0] = "Jan";
	months[1] = "Feb";
	months[2] = "Mar";
	months[3] = "Apr";
	months[4] = "May";
	months[5] = "June";
	months[6] = "July";
	months[7] = "Aug";
	months[8] = "Sept";
	months[9] = "Oct";
	months[10] = "Nov";
	months[11] = "Dec";

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth();
	mm = months[mm];
	var yyyy = today.getFullYear();
	today = dd+' '+mm+' '+yyyy;
	 
       
        function showTooltip(x, y, contents) {
            $('<div id="tooltip"><div class="date">'+today+'<\/div><div class="title text_color_3">'+contents+'<\/div> <div class="description text_color_3">Orders/sec<\/div>').css( {
                position: 'absolute',
                display: 'none',
                top: y - 105,
                left: x - 40,
                border: '0px solid #ccc',
                padding: '2px 6px',
                'background-color': '#fff',
                opacity: 10
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#prod_graph").bind("plothover", function (event, pos, item) {
           $("#x").text(pos.x.toFixed(2));
		   $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.datapoint) {
                    previousPoint = item.datapoint;
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2), y = item.datapoint[1].toFixed(2);
                    showTooltip(item.pageX, item.pageY, y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
		});

		// Servers graphs
		
		    var options_light = {      
				shadowSize:0, 
				bars: {
					show: true,
					lineWidth: 0,
					fill: true,
					highlight: {
						opacity: 0.3
					},
					fillColor: "#fff",
				},
				series: {
					bars: {show:true, barWidth: 0.6 },
				},
				 grid: { show:false, hoverable: true, clickable: false, autoHighlight: true, borderWidth:0 },
				 yaxis: { min: 0, max: 10 }				 
			};
			
		
		var options_dark = {
		   shadowSize:0, 
		   bars: {
			  lineWidth: 0,
			  fill: true,
			  fillColor: "rgba(0,0,0,0.2)",
		    },
			  lines: {show:false, fill:true}, 
			  points: {show:false},    
		   series: {
			 bars: {show:true, barWidth: 0.6},
			},
			 grid: { show:false, hoverable: true, clickable: false, autoHighlight: true, borderWidth:0   },
			 yaxis: { min: 0, max: 15 }
		};

		 var plot_avk6b1 = $.plot($("#avk6b1_graph"), [ { data: data_avk6b1_slice} ], options_light);		 
		 var plot_hgd0b1 = $.plot($("#hgd0b1_graph"), [ { data: data_hgd0b1_slice} ], options_light);		 
		 var plot_hgd0b2 = $.plot($("#hgd0b2_graph"), [ { data: data_hgd0b2_slice} ], options_light);
		 var plot_kstb1 = $.plot($("#kstb1_graph"), [ { data: data_kstb1_slice} ], options_light);
		 var plot_test = $.plot($("#test_graph"), [ { data: data_test_slice} ], options_light);
		 var plot_prod = $.plot($("#prod_graph"), [ { data: data_all} ], options_dark);
		 var plot_cluster = $.plot($("#cluster_platform"), [ { data: data_all} ], options_dark); 
		 var plot_test_platform = $.plot($("#test_platform"), [ { data: data_test_slice} ], options_dark);		

         function showTooltip_small(x, y, contents) {
          $('<div id="tooltip"><div class="title ">'+contents+'</div><div class="description">Orders/sec</div></div>').css( {
            position: 'absolute',
            display: 'none',
            top: y - 58,
            left: x - 40,
            border: '0px solid #ccc',
            padding: '2px 6px',
            opacity: 10
        }).appendTo("body").fadeIn(200);
      }

      var previousPoint = null;
	  
      $("#avk6b1_graph, #hgd0b1_graph, #hgd0b2_graph, #kstb1_graph, #test_graph").bind("plothover", function (event, pos, item) {
           $("#x").text(pos.x.toFixed(2));
		   $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.datapoint) {
                    previousPoint = item.datapoint;
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2), y = item.datapoint[1].toFixed(2);
                    showTooltip(item.pageX, item.pageY, y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
		});
		
	// LB ACTIONS
	var lbUrl = "http://rig-provident.tele2.net/monitor/wp-content/themes/monitor/db/lb.php";
	var result = 0;

	function getLBStatus(server) {
        $.ajax({
            url: lbUrl,
            type: "GET",
            async: false,
			data: "action=status&server="+server,
            success: function(results) {
               result = results;
            }
        });		
        return result;
    }
				
	//Refresh for index page
	
        function update() {
            plot_avk6b1.setData([getData_avk6b1().slice(-31, -1)]);
			plot_hgd0b1.setData([getData_hgd0b1().slice(-31, -1)]);
			plot_hgd0b2.setData([getData_hgd0b2().slice(-31, -1)]);
			plot_test.setData([getData_test().slice(-31, -1)]);
			plot_test_platform.setData([getData_test().slice(-31, -1)]);
			plot_prod.setData([getData_all().slice(-31, -1)]);
			plot_cluster.setData([getData_all().slice(-31, -1)]);
			plot_avk6b1.draw();
			plot_hgd0b1.draw();
			plot_hgd0b2.draw();
			plot_test.draw();
			plot_prod.draw();
			
			$('#avk6-provident-f1').html(getLBStatus('avk6-provident-f1'));
			$('#hgd0-provident-f1').html(getLBStatus('hgd0-provident-f1'));
			$('#hgd0-provident-f2').html(getLBStatus('hgd0-provident-f2'));
			$('#avk6-provident-f2').html(getLBStatus('avk6-provident-f2'));
			
            setTimeout(update, updateInterval);
    }
    update();
	
	// LB RESTORE/REMOVE ACTIONS
	$('a.lbRemove').live('click', (function() {
		var server = $(this).attr('id');
		
		 if (confirm("Are you sure?")) {
			 
				$.ajax({
					url: lbUrl,
					type: "POST",
					async: false,
					data: "action=remove&server="+server,
					success: function(results) {
					   result = results;
					}
				});	
		
			if (result == 'ok') {
				$('#'+server).html(getLBStatus(server));			
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> LB status updated. Server will be restored/removed from LB within 5 min.</div>');
				$('#main_container div.alert').fadeOut(6000);	
			} else {
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Error in update.</div>');
				$('#main_container div.alert').fadeOut(6000);	
			}
			
		} else {
				e.preventDefault();
			}		
		
		return false;
		
	}));
	
	$('a.lbRestore').live('click', (function() {
		var server = $(this).attr('id');
		
		 if (confirm("Are you sure?")) {
				
			$.ajax({
				url: lbUrl,
				type: "POST",
				async: false,
				data: "action=restore&server="+server,
				success: function(results) {
				   result = results;
				}
			});		
			
			if (result == 'ok') {
				$('#'+server).html(getLBStatus(server));			
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Success!</strong> LB status updated. Server will be restored/removed from LB within 5 mins.</div>');
				$('#main_container div.alert').fadeOut(6000);	
			} else {
				$('#main_container div.alert').remove();
				$('#main_container').prepend('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>Error!</strong> Error in update.</div>');
				$('#main_container div.alert').fadeOut(6000);	
			}
			
		} else {
				e.preventDefault();
			}	
		
        return false;
	}));

});


