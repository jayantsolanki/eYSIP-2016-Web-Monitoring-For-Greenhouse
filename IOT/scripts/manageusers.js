var app=angular.module('manageusersapp',['datatables']);

app.controller('manageusercontroller',function($scope,$http){
	var dtOptions=null;
  var dtInstance = {};
  $scope.dtInstance=dtInstance;
	$scope.dtOptions=dtOptions;
  
 $http.get("php/getuserdetails.php")
    .then(function (response) {
    	$scope.details = response.data;
		//$scope.datat();
  });
    $scope.savechanges=function($details){
    	angular.forEach($details, function(value, key){
         $http({
          method  : 'POST',
          url     : 'php/updateuserrole.php',
          data    :$.param({'user':value.username,'role':value.user_type}), //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
          .success(function(data) {
          $http.get("php/getuserdetails.php")
    .then(function (response) {
      $scope.details = response.data;
    //$scope.datat();
  });  
            
          });
       })
      
     window.location.reload(false);

    }
 $scope.update=function(user,myval){
 	var id=user;
 	var usertype;
 	if(myval=='normal'){
 		usertype=2;
 	}
 	else if(myval=='admin'){
 		usertype=1;
 	}
 	else if(myval=='deactivate'){
 		usertype=3;
 	}
 	else if(myval=='pending'){
 		usertype=0;
 	}
 	angular.forEach($scope.details, function(item){
    if(item.username==user){
    	item.user_type=usertype;

    }                
               })

 }

$scope.options1 = [{
   name: 'Normal user',
   value: 'normal'
}, {
   name: 'Admin',
   value: 'admin'
},{
   name: 'De-activate',
   value: 'deactivate'
}
];
 $scope.options2 = [{
   name: 'Normal user',
   value: 'normal'
}, {
   name: 'Admin',
   value: 'admin'
},{
   name: 'Pending approval',
   value: 'pending'
}
];
});
