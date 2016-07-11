var app=angular.module('dashboardapp',[]);
app.controller('dashboardcontroller',function($scope,$http)
{
	$http.get("php/dashboardtasks.php")
	.then(function (response) 
	{
 		$scope.tasks = response.data;
	});
		
	$http.get("php/dashboardusers.php")
	.then(function (response) 
	{
 		$scope.users = response.data;
	});
		


	$http.get("php/gethealth1.php")
	.then(function (response) 
	{
 		$scope.primary = response.data;
 		angular.forEach($scope.primary,function(value,key)
 		{
 			$scope.primaryh=value.prim1;
 			$scope.primaryc=value.prim2;
 		
    });
	}).finally(function(){
         $scope.makeChartHealth1();

  }
  );
		
	$http.get("php/gethealth2.php")
	.then(function (response) 
	{
 		$scope.secondary = response.data;
 		angular.forEach($scope.secondary,function(value,key)
 		{
 			$scope.sech=value.sec1;
 			$scope.secc=value.sec2;
 		  

    });
	}).finally(function(){
         $scope.makeChartHealth2();

  });
		
	$http.get("php/gethealth3.php")
	.then(function (response) 
	{
 		$scope.moisture = response.data;
 		angular.forEach($scope.moisture,function(value,key)
 		{
 			$scope.moistureh=value.sec1;
 			$scope.moisturec=value.sec2;
 		   
    });
	}).finally(function(){
         $scope.makeChartHealth3();

  });
		
	$http.get("php/gethealth4.php")
	.then(function (response) 
	{
 		$scope.connectivity = response.data;
 		angular.forEach($scope.connectivity,function(value,key)
 		{
 			$scope.connh=value.sec1;
 			$scope.connc=value.sec2;
 		   

    });
	}).finally(function(){
         $scope.makeChartHealth4();

  });
		
		
	$http.get("php/dashboardvalves.php")
	.then(function (response) 
	{
 		$scope.switches = response.data;
 		angular.forEach($scope.switches,function(value,key)
 		{
 			$scope.open=value.on;
 			$scope.close=value.off;
 	
    });
	}).finally(function(){
     $scope.makeChartoc();

   });
	
	
		$http.get("php/getgroups.php")
		.then(function (response) {
 			$scope.groups = response.data;
		angular.forEach($scope.groups,function(value,key){
			if(value.id=='1'){
				$scope.groupSelected=value.name;
			}
			if(value.id=='2'){
				$scope.groupSelected1=value.name;
				
			}

		});
		 $http({
          method  : 'POST',
          url     : 'php/getvalves.php',
          data    :$.param({'group':$scope.groupSelected}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
	    .then(function (response) {
		$scope.valves=response.data;
		}); 
		$http({
          method  : 'POST',
          url     : 'php/getsensors.php',
          data    :$.param({'group':$scope.groupSelected1}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
	    .then(function (response) {
		$scope.sensors=response.data;
		});   
		});
			 
		
    //Used to select group for valves
		$scope.setAction=function(y){
			$scope.groupSelected=y.name;
			 $http({
          method  : 'POST',
          url     : 'php/getvalves.php',
          data    :$.param({'group':$scope.groupSelected}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
	    .then(function (response) {
		$scope.valves=response.data;
		});  
		
		}
        //Used to select group for sensors    
				$scope.setAction1=function(y){
			$scope.groupSelected1=y.name;
			 $http({
          method  : 'POST',
          url     : 'php/getsensors.php',
          data    :$.param({'group':$scope.groupSelected1}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
	    .then(function (response) {
		$scope.sensors=response.data;
		});  
		
		}

		$http.get("php/dashboardonline.php")
		.then(function (response) {
 			$scope.online= response.data;
 			angular.forEach($scope.online,function(value,key){
 				$scope.ol=value.online;
 				$scope.off=value.offline;
 			      

      });
 	
		}).finally(function(){
         $scope.makeChartonoff();

  });
			

  // Used to make pie chart   
	$scope.makeChartHealth1=function()
	{
  	var chart1 = AmCharts.makeChart("charthealth1", 
  		{
    		"type": "pie",
    		"startDuration": 0,
    		"addClassNames": true,
    		"colorField": "color",
    		"labelRadius": -25,
    		 "labelText": "[[value]]",
    		"labelColorField": "#fffff",
        "creditsPosition":"bottom-right",
 			"defs": 
    		{
      			"filter": [{
      				"id": "shadow",
      				"width": "200%",
      				"height": "200%",
      				"feOffset": 
      				{
        				"result": "offOut",
        				"in": "SourceAlpha",
        				"dx": 0,
        				"dy": 0
      				},
      				"feGaussianBlur": 
      				{
        				"result": "blurOut",
        				"in": "offOut",
        				"stdDeviation": 5
      				},
      				"feBlend": 
      				{
        				"in": "SourceGraphic",
        				"in2": "blurOut",
        				"mode": "normal"
      				}
    			}]
  			},
  			"dataProvider": [{
  				"device": "Healthy",
          		"count": $scope.primaryh,
          		"color": "#43a047"
          	}, 
          	{
          		"device": "Critical",
          		"count": $scope.primaryc,
          		"color": "#E53935"
        	}],
        	"valueField": "count",
        	"titleField": "device",
  			"export": 
  			{
    			"enabled": true
  			}
		});
		
		chart1.autoMargins = false;
		chart1.marginTop = 5;
		chart1.marginBottom = 20;
		chart1.marginLeft = 0;
		chart1.marginRight = 0;
		chart1.pullOutRadius = 0;
		chart1.addListener("init", handleInit);
		chart1.addListener("rollOverSlice", function(e) 
		{
  			handleRollOver(e);
		});

		function handleInit()
		{
  	}

		function handleRollOver(e)
		{
  			var wedge = e.dataItem.wedge.node;
  			wedge.parentNode.appendChild(wedge);  
		}
	}


  // Used to make pie chart
	$scope.makeChartHealth2=function()
	{
		var chart2 = AmCharts.makeChart("charthealth2", 
  		{
    		"type": "pie",
    		"startDuration": 0,
    		"addClassNames": true,
    		"colorField": "color",
    		"labelRadius": -25,
    		"labelText": "[[value]]",
    		"labelColorField": "#fff",
    		"creditsPosition":"bottom-right",
    		/*"legend":
    		{
    			//"position":"right",
    			//marginLeft:0,
    			//autoMargins:false
    			"divId"="chartlegend2"
    		},*/
 			"defs": 
    		{
      			"filter": [{
      				"id": "shadow",
      				"width": "200%",
      				"height": "200%",
      				"feOffset": 
      				{
        				"result": "offOut",
        				"in": "SourceAlpha",
        				"dx": 0,
        				"dy": 0
      				},
      				"feGaussianBlur": 
      				{
        				"result": "blurOut",
        				"in": "offOut",
        				"stdDeviation": 5
      				},
      				"feBlend": 
      				{
        				"in": "SourceGraphic",
        				"in2": "blurOut",
        				"mode": "normal"
      				}
    			}]
  			},
  			"dataProvider": [{
  				"device": "Healthy",
          		"count": $scope.sech,
          		"color": "#43a047"
          	}, 
          	{
          		"device": "Critical",
          		"count": $scope.secc,
          		"color": "#E53935"
        	}],
        	"valueField": "count",
        	"titleField": "device",
  			"export": 
  			{
    			"enabled": true
  			}
		});
		
		chart2.autoMargins = false;
		chart2.marginTop = 5;
		chart2.marginBottom = 20;
		chart2.marginLeft = 0;
		chart2.marginRight = 0;
		chart2.pullOutRadius = 0;
		chart2.addListener("init", handleInit);
		//chart.add(legend,"chartlegend2");
		chart2.addListener("rollOverSlice", function(e) 
		{
  			handleRollOver(e);
		});

		function handleInit()
		{
  	}

		function handleRollOver(e)
		{
  			var wedge = e.dataItem.wedge.node;
  			wedge.parentNode.appendChild(wedge);  
		}
	}

  // Used to make pie chart
	$scope.makeChartHealth3=function()
	{
		var chart3 = AmCharts.makeChart("charthealth3", 
  		{
    		"type": "pie",
    		"startDuration": 0,
    		"addClassNames": true,
    		"colorField": "color",
    		"labelRadius": -25,
    		"labelText": "[[value]]",
    		"labelColorField": "#fff",
        "creditsPosition":"bottom-right",
 			"defs": 
    		{
      			"filter": [{
      				"id": "shadow",
      				"width": "200%",
      				"height": "200%",
      				"feOffset": 
      				{
        				"result": "offOut",
        				"in": "SourceAlpha",
        				"dx": 0,
        				"dy": 0
      				},
      				"feGaussianBlur": 
      				{
        				"result": "blurOut",
        				"in": "offOut",
        				"stdDeviation": 5
      				},
      				"feBlend": 
      				{
        				"in": "SourceGraphic",
        				"in2": "blurOut",
        				"mode": "normal"
      				}
    			}]
  			},
  			"dataProvider": [{
  				"device": "Healthy",
          		"count": $scope.moistureh,
          		"color": "#43a047"
          	}, 
          	{
          		"device": "Critical",
          		"count": $scope.moisturec,
          		"color": "#E53935"
        	}],
        	"valueField": "count",
        	"titleField": "device",
  			"export": 
  			{
    			"enabled": true
  			}
		});
		
		chart3.autoMargins = false;
		chart3.marginTop = 5;
		chart3.marginBottom = 20;
		chart3.marginLeft = 0;
		chart3.marginRight = 0;
		chart3.pullOutRadius = 0;
		chart3.addListener("init", handleInit);
		chart3.addListener("rollOverSlice", function(e) 
		{
  			handleRollOver(e);
		});

		function handleInit()
		{
  	}

		function handleRollOver(e)
		{
  			var wedge = e.dataItem.wedge.node;
  			wedge.parentNode.appendChild(wedge);  
		}
	}
  // Used to make pie chart
	$scope.makeChartHealth4=function()
	{
		var chart4 = AmCharts.makeChart("charthealth4", 
  		{
    		"type": "pie",
    		"startDuration": 0,
    		"addClassNames": true,
    		"colorField": "color",
    		"labelRadius": -25,
    		"labelText": "[[value]]",
    		"labelColorField": "#fff",
        "creditsPosition":"bottom-right",
 			"defs": 
    		{
      			"filter": [{
      				"id": "shadow",
      				"width": "200%",
      				"height": "200%",
      				"feOffset": 
      				{
        				"result": "offOut",
        				"in": "SourceAlpha",
        				"dx": 0,
        				"dy": 0
      				},
      				"feGaussianBlur": 
      				{
        				"result": "blurOut",
        				"in": "offOut",
        				"stdDeviation": 5
      				},
      				"feBlend": 
      				{
        				"in": "SourceGraphic",
        				"in2": "blurOut",
        				"mode": "normal"
      				}
    			}]
  			},
  			"dataProvider": [{
  				"device": "Normal",
          		"count": $scope.connh,
          		"color": "#43a047"
          	}, 
          	{
          		"device": "Disconnected",
          		"count": $scope.connc,
          		"color": "#E53935"
        	}],
        	"valueField": "count",
        	"titleField": "device",
  			"export": 
  			{
    			"enabled": true
  			}
		});
		
		chart4.autoMargins = false;
		chart4.marginTop = 5;
		chart4.marginBottom = 20;
		chart4.marginLeft = 0;
		chart4.marginRight = 0;
		chart4.pullOutRadius = 0;
		chart4.addListener("init", handleInit);
		chart4.addListener("rollOverSlice", function(e) 
		{
  			handleRollOver(e);
		});

		function handleInit()
		{
  	}

		function handleRollOver(e)
		{
  			var wedge = e.dataItem.wedge.node;
  			wedge.parentNode.appendChild(wedge);  
		}
	}
  // Used to make pie chart
	$scope.makeChartoc=function()
	{
		var chart5 = AmCharts.makeChart("chartoc", 
  		{
    		"type": "pie",
    		"startDuration": 0,
    		"addClassNames": true,
    		"colorField": "color",
    		"labelRadius": -15,
    		"labelText": "[[value]]",
    		"labelColorField": "#fff",
        "creditsPosition":"bottom-right",
 			"defs": 
    		{
      			"filter": [{
      				"id": "shadow",
      				"width": "200%",
      				"height": "200%",
      				"feOffset": 
      				{
        				"result": "offOut",
        				"in": "SourceAlpha",
        				"dx": 0,
        				"dy": 0
      				},
      				"feGaussianBlur": 
      				{
        				"result": "blurOut",
        				"in": "offOut",
        				"stdDeviation": 5
      				},
      				"feBlend": 
      				{
        				"in": "SourceGraphic",
        				"in2": "blurOut",
        				"mode": "normal"
      				}
    			}]
  			},
  			"dataProvider": [{
  				"device": "Open",
          		"count": $scope.open,
          		"color": "#43a047"
          	}, 
          	{
          		"device": "Close",
          		"count": $scope.close,
          		"color": "#E53935"
        	}],
        	"valueField": "count",
        	"titleField": "device",
  			"export": 
  			{
    			"enabled": true
  			}
		});
		
		chart5.autoMargins = false;
		chart5.marginTop = 5;
		chart5.marginBottom = 20;
		chart5.marginLeft = 0;
		chart5.marginRight = 0;
		chart5.pullOutRadius = 0;
		chart5.addListener("init", handleInit);
		chart5.addListener("rollOverSlice", function(e) 
		{
  			handleRollOver(e);
		});

		function handleInit()
		{
		}

		function handleRollOver(e)
		{
  			var wedge = e.dataItem.wedge.node;
  			wedge.parentNode.appendChild(wedge);  
		}
	}

  // Used to make pie chart
	$scope.makeChartonoff=function()
	{
		var chart6 = AmCharts.makeChart("chartonoff", 
  		{
    		"type": "pie",
    		"startDuration": 0,
    		"addClassNames": true,
    		"colorField": "color",
    		"labelRadius": -15,
    		"labelText": "[[value]]",
    		"labelColorField": "#fff",
        "creditsPosition":"bottom-right",
 			"defs": 
    		{
      			"filter": [{
      				"id": "shadow",
      				"width": "200%",
      				"height": "200%",
      				"feOffset": 
      				{
        				"result": "offOut",
        				"in": "SourceAlpha",
        				"dx": 0,
        				"dy": 0
      				},
      				"feGaussianBlur": 
      				{
        				"result": "blurOut",
        				"in": "offOut",
        				"stdDeviation": 5
      				},
      				"feBlend": 
      				{
        				"in": "SourceGraphic",
        				"in2": "blurOut",
        				"mode": "normal"
      				}
    			}]
  			},
  			"dataProvider": [{
  				"device": "Online",
          		"count": $scope.ol,
          		"color": "#43a047"
          	}, 
          	{
          		"device": "Offline",
          		"count": $scope.off,
          		"color": "#E53935"
        	}],
        	"valueField": "count",
        	"titleField": "device",
  			"export": 
  			{
    			"enabled": true
  			}
		});
		
		chart6.autoMargins = false;
		chart6.marginTop = 5;
		chart6.marginBottom = 20;
		chart6.marginLeft = 0;
		chart6.marginRight = 0;
		chart6.pullOutRadius = 0;
	
		function handleInit()
		{
  	}

		function handleRollOver(e)
		{
  			var wedge = e.dataItem.wedge.node;
  			wedge.parentNode.appendChild(wedge);  
		}
	}
});


