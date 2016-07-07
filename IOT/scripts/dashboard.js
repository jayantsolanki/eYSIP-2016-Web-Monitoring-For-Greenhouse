var app=angular.module('dashboardapp',['googlechart','ngMaterial']);
app.controller('dashboardcontroller',function($scope,$http){
	    $http.get("php/dashboardtasks.php")
		.then(function (response) {
 			$scope.tasks = response.data;
		});
		$http.get("php/dashboardusers.php")
		.then(function (response) {
 			$scope.users = response.data;
		});
		$http.get("php/gethealth1.php")
		.then(function (response) {
 			$scope.primary = response.data;
 			angular.forEach($scope.primary,function(value,key){
 				$scope.primaryh=value.prim1;
 				$scope.primaryc=value.prim2;
 			});
				$scope.myChartObject2.data = {"cols": [
			        {id: "t", label: "Topping", type: "string"},
			        {id: "s", label: "Slices", type: "string"}
			    ], "rows": [
			        {c: [
			            {v: "Healthy"},
			            {v: $scope.primaryh},
			        ]},
			        {c: [
			            {v: "Critical"},
			            {v: $scope.primaryc}
			        ]}
			    ]};
		
		});
		$http.get("php/gethealth2.php")
		.then(function (response) {
 			$scope.secondary = response.data;
 			angular.forEach($scope.secondary,function(value,key){
 				$scope.sech=value.sec1;
 				$scope.secc=value.sec2;
 			});
				$scope.myChartObject3.data = {"cols": [
			        {id: "t", label: "Topping", type: "string"},
			        {id: "s", label: "Slices", type: "string"}
			    ], "rows": [
			        {c: [
			            {v: "Healthy"},
			            {v: $scope.sech},
			        ]},
			        {c: [
			            {v: "Critical"},
			            {v: $scope.secc}
			        ]}
			    ]};
		
		});
		$http.get("php/gethealth3.php")
		.then(function (response) {
 			$scope.moisture = response.data;
 			angular.forEach($scope.moisture,function(value,key){
 				$scope.moistureh=value.sec1;
 				$scope.moisturec=value.sec2;
 			});
				$scope.myChartObject4.data = {"cols": [
			        {id: "t", label: "Topping", type: "string"},
			        {id: "s", label: "Slices", type: "string"}
			    ], "rows": [
			        {c: [
			            {v: "Healthy"},
			            {v: $scope.moistureh},
			        ]},
			        {c: [
			            {v: "Critical"},
			            {v: $scope.moisturec}
			        ]}
			    ]};
		
		});
		$http.get("php/gethealth4.php")
		.then(function (response) {
 			$scope.connectivity = response.data;
 			angular.forEach($scope.connectivity,function(value,key){
 				$scope.connh=value.sec1;
 				$scope.connc=value.sec2;
 			});
				$scope.myChartObject5.data = {"cols": [
			        {id: "t", label: "Topping", type: "string"},
			        {id: "s", label: "Slices", type: "string"}
			    ], "rows": [
			        {c: [
			            {v: "Normal"},
			            {v: $scope.connh},
			        ]},
			        {c: [
			            {v: "Disconnected"},
			            {v: $scope.connc}
			        ]}
			    ]};
		
		});
		
		
		$http.get("php/dashboardvalves.php")
		.then(function (response) {
 			$scope.switches = response.data;
 			angular.forEach($scope.switches,function(value,key){
 				$scope.open=value.on;
 				$scope.closed=value.off;
 			});
			$scope.myChartObject1.data = {"cols": [
			        {id: "t", label: "Topping", type: "string"},
			        {id: "s", label: "Slices", type: "string"}
			    ], "rows": [
			        {c: [
			            {v: "Open"},
			            {v: $scope.open},
			        ]},
			        {c: [
			            {v: "Closed"},
			            {v: $scope.closed}
			        ]}
			    ]};
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
 		$scope.myChartObject.data = {"cols": [
        {id: "t", label: "Topping", type: "string"},
        {id: "s", label: "Slices", type: "string"}
    ], "rows": [
        {c: [
            {v: "Online"},
            {v: $scope.ol},
        ]},
        {c: [
            {v: "Offline"},
            {v: $scope.off}
        ]}
    ]};
		});
		$scope.myChartObject = {};
    	
    $scope.myChartObject.type = "PieChart";
    

    

    $scope.myChartObject.options = {
        'title': '',
        'colors':['#43a047','#E53935'],
        'chartArea':{width:500,height:250},	
        'pieSliceText':'value'	
    };
		$scope.myChartObject1 = {};
    	
    $scope.myChartObject1.type = "PieChart";
    

    

    $scope.myChartObject1.options = {
        'title': '',
        'colors':['#43a047','#E53935'],
        'chartArea':{width:500,height:250},	
        'pieSliceText':'value'	
    };
    		$scope.myChartObject2 = {};
    	
    $scope.myChartObject2.type = "PieChart";
    

    

    $scope.myChartObject2.options = {
        'title': '',
        'colors':['#43a047','#E53935'],
        'chartArea':{width:500,height:250},	
        'pieSliceText':'value'	
    };
    	$scope.myChartObject3 = {};
    	
    $scope.myChartObject3.type = "PieChart";
    

    

    $scope.myChartObject3.options = {
        'title': '',
        'colors':['#43a047','#E53935'],
        'chartArea':{width:500,height:250},	
        'pieSliceText':'value'	
    };
 	    	$scope.myChartObject4 = {};
    	
    $scope.myChartObject4.type = "PieChart";
    

    

    $scope.myChartObject4.options = {
        'title': '',
        'colors':['#43a047','#E53935'],
        'chartArea':{width:500,height:250},	
        'pieSliceText':'value'	
    };
   	    	$scope.myChartObject5 = {};
    	
    $scope.myChartObject5.type = "PieChart";
    

    

    $scope.myChartObject5.options = {
        'title': '',
        'colors':['#43a047','#E53935'],
        'chartArea':{width:500,height:250},	
        'pieSliceText':'value'	
    };
   
});

