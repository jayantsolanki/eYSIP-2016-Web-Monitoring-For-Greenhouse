var app=angular.module('devicestatusapp',['ngMaterial']);

app.controller('devicestatuscontroller',function($scope,$http){
	$scope.userGroup = 1;
	$scope.p="Wireless-valves";
            $http.get("php/getgroups.php")
    .then(function (response) {
    	$scope.groups = response.data;
		
  });
    $http.get("php/getswitches.php")
    .then(function (response) {
      $scope.switches = response.data;
  });
   $http.get("php/getdevicestatus.php",{
            params:
            {
              'id':$scope.userGroup
            }
          })
    .then(function (response) {
      $scope.devices = response.data;
  
  }); 
//Used to select group type on device status page
$scope.onchange=function(){

	angular.forEach($scope.groups,function(value,key){
        if(value.id==$scope.userGroup){
    		$scope.p=value.name;
	    	
        }
      });
	        $http.get("php/getdevicestatus.php",{
	        	params:
	        	{
	        		'id':$scope.userGroup
	        	}
	        })
    .then(function (response) {
    	$scope.devices = response.data;
	
  });
}
   $scope.clicked=function(a){
   	
   	var d="a"+a;
   	
   	var myEl = angular.element( document.querySelector('#'+d));
	myEl.removeClass('unflip');
	
	myEl.addClass('flip');
	var e="b"+a;
	var myE2 = angular.element( document.querySelector('#'+e));
	myE2.removeClass('flip');
	
	myE2.addClass('unflip');

	} 
	$scope.clicked2=function(a){
	 	
   	var d="b"+a;
   	
   	var myEl = angular.element( document.querySelector('#'+d));
	myEl.removeClass('unflip');
	myEl.addClass('flip');
	var e="a"+a;
	var myE2 = angular.element( document.querySelector('#'+e));
	myE2.removeClass('flip');
	myE2.addClass('unflip');

	}
});