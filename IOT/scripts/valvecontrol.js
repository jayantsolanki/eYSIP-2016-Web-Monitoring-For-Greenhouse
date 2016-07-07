 var app=angular.module('myapp', ['ui.bootstrap','ngMaterial']);

app.controller('DropdownCtrl',function($scope,$http) {
/*  $scope.actions = [
    {id: 1, name: 'Wireless-valves'},
    {id: 2, name: 'Sensors'},
    {id: 3, name: 'Wired-valves'},
    {id: 4, name: 'Relay'},
    {id: 8, name: 'Row-01to03'},
    {id: 9, name: 'Row-04to07'},
    {id: 10, name: 'Row-08to10'},
    {id: 11, name: 'hostel'},
    
  ];
*/
$scope.p=false;
  $scope.groupSelected='Wireless-valves';
  $scope.selectedAction = $scope.actions;
  
   $http.get("php/valvecontrolscript.php",
    {
      params:
      {
        'grpid':1
      }
    })
    .then(function (response)
    {
      $scope.details = response.data;
    });
   
   $http.get("php/getgroups.php")
    .then(function (response1) {
      $scope.actions = response1.data;
      // window.alert($scope.actions);
    
  });


  $scope.duration=10;
  $scope.setAction = function(action) {
    
    $scope.selectedAction = action;
    $scope.change();
  
  };
  $scope.range = function(min, max, step) {
    step = step || 1;
    var input = [];
    for (var i = min; i <= max; i += step) {
        input.push(i);
    }
    return input;
};
  $scope.change = function()
  {
    $scope.p=true;
    $http.get("php/valvecontrolscript.php",
    {
      params:
      {
        'grpid':$scope.selectedAction.id
      }
    })
    .then(function (response)
    {
      $scope.details = response.data;
     $scope.groupSelected=$scope.selectedAction.name;
    });
            
  
  };

 $scope.change2 = function(x)
  {
   $scope.duration=x;         
  
  };



    $scope.data = {
    cb1: true,
    cb4: true,
    cb5: false,
    cb6 :false
  };
  $scope.message = 'false';
 $scope.z=1;
 $scope.set0=function(){
 angular.element('.disable').addClass('none');
 angular.element('.head').removeClass('relative');
 }
 $scope.set1=function(){
 angular.element('.disable').removeClass('none');
 angular.element('.head').addClass('relative');
 }
  $scope.send = function(y) 
  {
    if(y.action=='1'){
      y.action='0';
      
      //Send SwitchId=0 through websocket
    }
    else if(y.action='0')
    {y.action='1';
      
      //Send SwitchId=1 through websocket
    } 
      $http({
          method  : 'POST',
          url     : 'php/updatevalveaction.php',
          data    :$.param({'action':y.action,'deviceId':y.deviceId,'switchId':y.switchId,'duration':$scope.duration}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
    .then(function (response) {
    //$scope.datat();
  });  
    send(y);
      }
    
});



