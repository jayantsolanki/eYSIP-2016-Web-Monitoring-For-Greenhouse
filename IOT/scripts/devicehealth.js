var app=angular.module('devicehealthapp',['ngMaterial','ui.bootstrap','angular-confirm']);

app.controller('devicehealthcontroller',function($scope,$http,$confirm){
    $http.get("php/devicenotif.php")
    .then(function (response) {
      $scope.health = response.data;
  });

    $scope.groupSelected='';
    $scope.fieldSelected='';
    $scope.actionSelected='';
    $scope.conditionSelected='';
    	$http.get("php/getgroups.php")
		.then(function (response) {
 			$scope.groups = response.data;
		});
		$http.get("php/getaction.php")
		.then(function (response) {
 			$scope.action = response.data;
		});

			$scope.setAction=function(y){
			$scope.groupSelected=y.name;
		
		}
			$scope.setAction1=function(y){
			$scope.fieldSelected=y;
		
		}

		$scope.setAction2=function(y){
			$scope.actionSelected=y.name;
		
		}

		$scope.setAction3=function(y){
			$scope.conditionSelected=y;
		
		}



//Add a particular action
$scope.add=function(){
	var name=angular.element('#name').val();
	if($scope.fieldSelected!='Online/Offline'){
		var thresh=angular.element('#value').val();
	}
	if($scope.fieldSelected=='Online/Offline'){
		if(name!='' && $scope.groupSelected!='' && $scope.fieldSelected!='' && $scope.actionSelected!=''){
			angular.element('.errorspan').addClass('hide');
				      $http({
		          method  : 'POST',
		          url     : 'php/addaction1.php',
		          data    :$.param({'name':name,'group':$scope.groupSelected,'field':$scope.fieldSelected,'action':$scope.actionSelected}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {
		    						$http.get("php/getreact.php")
					    .then(function (response) {

					      $scope.react= response.data;
					  });
					});

		}
		else{
			angular.element('.errorspan').removeClass('hide');
		}

	}
	else{
		if(name!='' && $scope.groupSelected!='' && $scope.fieldSelected!='' && $scope.actionSelected!='' && thresh!='' && $scope.conditionSelected!=''){
			angular.element('.errorspan').addClass('hide');
				      $http({
		          method  : 'POST',
		          url     : 'php/addaction2.php',
		          data    :$.param({'name':name,'group':$scope.groupSelected,'field':$scope.fieldSelected,'action':$scope.actionSelected,'thresh':thresh,'con':$scope.conditionSelected}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {
		    						$http.get("php/getreact.php")
					    .then(function (response) {

					      $scope.react= response.data;
					  });
					});

		}
		else{
			angular.element('.errorspan').removeClass('hide');
		}	
	}
}
	$http.get("php/getreact.php")
    .then(function (response) {
      $scope.react= response.data;
  });

 //Gets called when user clicks on delete glyphicon in device health and system automation page
//Delete a particular action

$scope.delete=function(y){
	$confirm({text: 'Are you sure you want to delete?'})
  .then(function(){  
  				      $http({
		          method  : 'POST',
		          url     : 'php/deleteaction.php',
		          data    :$.param({'id':y.id}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {
		    						$http.get("php/getreact.php")
					    .then(function (response) {
					      $scope.react= response.data;
					  });
					});
});
}

});