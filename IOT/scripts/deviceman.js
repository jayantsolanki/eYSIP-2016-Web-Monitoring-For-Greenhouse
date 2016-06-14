var app=angular.module('devicemanapp',['ui.bootstrap','angularUtils.directives.dirPagination']);

app.controller('devicemancontroller',function($scope,$http,$log,$uibModal){


 $http.get("php/getdeviceinfo.php")
    .then(function (response) {
    	$scope.details = response.data;
		
  });
    $http.get("php/getgroups.php")
    .then(function (response) {
    	$scope.groups = response.data;
		
  });
    $http.get("php/getdevicenames.php")
    .then(function (response) {
      $scope.devicenames = response.data;
    
  });
   $scope.clicked=function(a,b){
   	var d="a"+a+b;
   	
   	var myEl = angular.element( document.querySelector('#'+d));
	myEl.removeClass('unflip');
	
	myEl.addClass('flip');
	var e="b"+a+b;
	var myE2 = angular.element( document.querySelector('#'+e));
	myE2.removeClass('flip');
	
	myE2.addClass('unflip');

	} 
	 $scope.clicked2=function(a,b){
	 	
   	var d="b"+a+b;
   	
   	var myEl = angular.element( document.querySelector('#'+d));
	myEl.removeClass('unflip');
	myEl.addClass('flip');
	var e="a"+a+b;
	var myE2 = angular.element( document.querySelector('#'+e));
	myE2.removeClass('flip');
	myE2.addClass('unflip');

	} 

	 $scope.items = ['item1', 'item2', 'item3'];

  $scope.animationsEnabled = true;

  $scope.open = function (x,option) {
$scope.option=option
    var modalInstance = $uibModal.open({
      animation: $scope.animationsEnabled,
      templateUrl: 'myModalContent.html',
      controller: 'ModalInstanceCtrl',
      
      resolve: {
      	option:function(){
      		return option
      	},
        device: function () {
          return x;
        },
        groups:function(){
        	return $scope.groups;
        }
      }
    });

    modalInstance.result.then(function (y) {

if(option==2){
    	$http({
          method  : 'POST',
          url     : 'php/updatedeviceinfo.php',
          data    :$.param({'id':y.id,'name':y.name,'regionId':y.regionId,'description':y.description,'group1':y.group1,'latitude':y.latitude,'longitude':y.longitude,'elevation':y.elevation}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
      angular.forEach($scope.details,function(value,key){
        if(value.id==y.id){
        	value.name=y.name;
        	value.regionId=y.regionId;
			value.description=y.description;
			value.group1=y.group1;
			value.latitude=y.latitude;
			value.longitude=y.longitude;
			value.elevation=y.elevation;


        }
      });
    }
    else if(option==1){
      $http({
          method  : 'POST',
          url     : 'php/updateswitchgroup.php',
          data    :$.param({'switches':y.switches,'deviceId':y.deviceId,'group':y.group}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
      angular.forEach($scope.details,function(value,key){
        if(value.id==y.id && value.switches==y.switches){
         value.group=y.group;

        }
      });
    }
        else if(option==3){
      $http({
          method  : 'POST',
          url     : 'php/updategroupname.php',
          data    :$.param({'name':y.name,'id':y.id}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
      angular.forEach($scope.groups,function(value,key){
        if(value.id==y.id ){
         value.name=y.name;

        }
      });
      $http.get("php/getdeviceinfo.php")
    .then(function (response) {
      $scope.details = response.data;
    
  });
 
    }
       else if(option==4){
      $http({
          method  : 'POST',
          url     : 'php/updatedevicename.php',
          data    :$.param({'name':y.name,'id':y.id}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
      angular.forEach($scope.devicenames,function(value,key){
        if(value.id==y.id){
         value.name=y.name;

        }
      });
        $http.get("php/getdeviceinfo.php")
    .then(function (response) {
      $scope.details = response.data;
    
  });
    }
 else if(option==5){
      $http({
          method  : 'POST',
          url     : 'php/addgroupname.php',
          data    :$.param({'name':y.name}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
        $http.get("php/getdeviceinfo.php")
    .then(function (response) {
      $scope.details = response.data;
    
  });
    $http.get("php/getgroups.php")
    .then(function (response) {
      $scope.groups = response.data;
    
  });
  
    }
 else if(option==6){
      $http({
          method  : 'POST',
          url     : 'php/adddevicetype.php',
          data    :$.param({'name':y.name}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
    $http.get("php/getdevicenames.php")
    .then(function (response) {
      $scope.devicenames = response.data;
    
  });

  
    }

    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    });
  };
 
 });
app.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, option,device,groups) {
$scope.option=option;
  $scope.device = device;
  $scope.groups=groups;
if(option!=5){
$scope.x=angular.copy(device);
}
$scope.y={
name:''
};
  $scope.ok = function () {

if($scope.option!=5 && $scope.option!=6){
    $uibModalInstance.close($scope.x);
}  
else{
  $uibModalInstance.close($scope.y);

}
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});
	
