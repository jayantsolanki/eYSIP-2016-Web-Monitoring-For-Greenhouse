var app=angular.module('devicestatusapp',['ngMaterial','ngWebSocket']);
app.factory('MyData', function($websocket,$log) {
      // Open a WebSocket connection 
      var dataStream = $websocket('ws://10.129.139.139:8180');
 
      var collection = [];
 	dataStream.onOpen(function(){
 	});
      dataStream.onMessage(function(message) {

        collection.push(JSON.parse(message.data));
        $log.info(JSON.stringify(JSON.parse(message.data)));
      });
 dataStream.onClose(function(){
 	alert('connection closed');
 })
      var methods = {
        collection: collection,
        get: function() {
          dataStream.send(JSON.stringify({ action: 'get' }));
        }
      };
 
      return methods;
    });
app.controller('devicestatuscontroller',function($scope,$http,MyData){
	$scope.userGroup = '';
	$scope.MyData=MyData;
	$scope.$watch('MyData.collection',function(newvalue,oldvalue){
	});
            $http.get("php/getgroups.php")
    .then(function (response) {
    	$scope.groups = response.data;
		
  });
    $http.get("php/getswitches.php")
    .then(function (response) {
      $scope.switches = response.data;
  });
   
$scope.display=function(){

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