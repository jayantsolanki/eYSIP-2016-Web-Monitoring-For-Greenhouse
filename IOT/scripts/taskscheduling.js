var app=angular.module('taskschedulingapp',['ngMaterial','ui.bootstrap','angular-confirm']);
app.controller('taskschedulecontroller',function($scope,$http,$confirm){
	            $http.get("php/getgroups.php")
    .then(function (response) {
    	$scope.groups = response.data;
		
  });
                $http.get("php/gettasks.php")
    .then(function (response) {
    	$scope.tasks = response.data;
    	angular.forEach($scope.tasks,function(value,key){
      if(value.start.length==3){
      	value.start='0'+value.start;
      }
      if(value.stop.length==3){
      	value.stop='0'+value.stop;
     
      }
      if(value.start.length==2){
      	value.start='00'+value.start;
      }
      if(value.stop.length==2){
      	value.stop='00'+value.stop;
     
      }
      if(value.start.length==1){
      	value.start='000'+value.start;
      }
      if(value.stop.length==1){
      	value.stop='000'+value.stop;
     
      }
      
      
         	value.start=value.start.slice(0, 2) + ":" + value.start.slice(2);
     	 	value.stop=value.stop.slice(0, 2) + ":" + value.stop.slice(2);
   
      });

  });
    //Add new schedule
 $scope.enterschedule=function(){
 	$scope.startmins=parseInt($scope.startmins);
 	$scope.stopmins=parseInt($scope.stopmins);
 	$scope.starthrs=parseInt($scope.starthrs);
 	$scope.stophrs=parseInt($scope.stophrs);
 	if($scope.scheduletype=='Period'){
 		if($scope.starthrs==undefined || $scope.startmins==undefined || $scope.stophrs==undefined || $scope.stopmins==undefined){
 		angular.element('.errorspan').removeClass('hide');	
 		}
 		else{
 		if($scope.stophrs<$scope.starthrs){
 			angular.element('.errorspan1').removeClass('hide');
 			angular.element('.errorspan').addClass('hide');
 			
 		}	
 		else if($scope.stophrs==$scope.starthrs && $scope.startmins>$scope.stopmins){
 			angular.element('.errorspan').addClass('hide');
 			
 			angular.element('.errorspan1').removeClass('hide');
 		}
 		else{
 			$scope.start=$scope.startmins;
 			$scope.stop=$scope.stopmins;
 					angular.element('.errorspan').addClass('hide');	
		 			angular.element('.errorspan1').addClass('hide');
		 			if($scope.startmins<10){
		 				$scope.start='0'+$scope.startmins.toString();
		 			}
		 			if($scope.stopmins<10){
		 				$scope.stop='0'+$scope.stopmins.toString();
		 			
		 			}	
		 				      $http({
		          method  : 'POST',
		          url     : 'php/updateschedules.php',
		          data    :$.param({'type':'1','group':$scope.schedulegroup,'starthrs':$scope.starthrs.toString(),'startmins':$scope.start.toString(),'stophrs':$scope.stophrs.toString(),'stopmins':$scope.stop.toString()}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {
								$http.get("php/gettasks.php")
		    .then(function (response) {
		    	$scope.tasks = response.data;
		    	angular.forEach($scope.tasks,function(value,key){
		      if(value.start.length==3){
		      	value.start='0'+value.start;
		      }
		      if(value.stop.length==3){
		      	value.stop='0'+value.stop;
		     
		      }
		      if(value.start.length==2){
      	value.start='00'+value.start;
      }
      if(value.stop.length==2){
      	value.stop='00'+value.stop;
     
      }
      if(value.start.length==1){
      	value.start='000'+value.start;
      }
      if(value.stop.length==1){
      	value.stop='000'+value.stop;
     
      }
      
		         	value.start=value.start.slice(0, 2) + ":" + value.start.slice(2);
		     	 	value.stop=value.stop.slice(0, 2) + ":" + value.stop.slice(2);
		   
		      });
		    	$scope.setnumber();
		  	});			   		 
		});  
				
 			}	
 		}
 	}else if($scope.scheduletype=='Duration'){
 		if($scope.starthrs==undefined || $scope.startmins==undefined || $scope.duration==undefined){
 		angular.element('.errorspan').removeClass('hide');	
 			
 		}
 		else{
 			angular.element('.errorspan').addClass('hide');
 			angular.element('.errorspan1').addClass('hide');
 					$scope.start=$scope.startmins;
 					if($scope.startmins<10){
		 				$scope.start='0'+$scope.startmins.toString();
		 			}
		 				
		 				      $http({
		          method  : 'POST',
		          url     : 'php/updateschedules.php',
		          data    :$.param({'type':'2','group':$scope.schedulegroup,'starthrs':$scope.starthrs.toString(),'startmins':$scope.start.toString(),'duration':$scope.duration}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {

								$http.get("php/gettasks.php")
		    .then(function (response) {
		    	$scope.tasks = response.data;
		    	angular.forEach($scope.tasks,function(value,key){
		      if(value.start.length==3){
		      	value.start='0'+value.start;
		      }
		      if(value.stop.length==3){
		      	value.stop='0'+value.stop;
		     
		      }
		      if(value.start.length==2){
      	value.start='00'+value.start;
      }
      if(value.stop.length==2){
      	value.stop='00'+value.stop;
     
      }
      if(value.start.length==1){
      	value.start='000'+value.start;
      }
      if(value.stop.length==1){
      	value.stop='000'+value.stop;
     
      }
      
		         	value.start=value.start.slice(0, 2) + ":" + value.start.slice(2);
		     	 	value.stop=value.stop.slice(0, 2) + ":" + value.stop.slice(2);
		   
		      });
		    	$scope.setnumber();
		  	});			   		 
		});  
			
 		}	
 	}
 	else if($scope.scheduletype=='Frequency'){
 		if($scope.starthrs==undefined || $scope.startmins==undefined || $scope.duration==undefined || $scope.frequency==undefined)
 		{
 		angular.element('.errorspan').removeClass('hide');	
 			
 		}
 		else{
			angular.element('.errorspan').addClass('hide');
			angular.element('.errorspan1').addClass('hide');
 					$scope.start=$scope.startmins;
 					if($scope.startmins<10){
		 				$scope.start='0'+$scope.startmins.toString();
		 			}
		 				
		 				      $http({
		          method  : 'POST',
		          url     : 'php/updateschedules.php',
		          data    :$.param({'type':'3','group':$scope.schedulegroup,'starthrs':$scope.starthrs.toString(),'startmins':$scope.start.toString(),'duration':$scope.duration,'frequency':$scope.frequency}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {

								$http.get("php/gettasks.php")
				    .then(function (response) {
				    	$scope.tasks = response.data;
				    	angular.forEach($scope.tasks,function(value,key){
				      if(value.start.length==3){
				      	value.start='0'+value.start;
				      }
				      if(value.stop.length==3){
				      	value.stop='0'+value.stop;
				     
				      	}
				      	if(value.start.length==2){
      	value.start='00'+value.start;
      }
      if(value.stop.length==2){
      	value.stop='00'+value.stop;
     
      }
      if(value.start.length==1){
      	value.start='000'+value.start;
      }
      if(value.stop.length==1){
      	value.stop='000'+value.stop;
     
      }
      
				         	value.start=value.start.slice(0, 2) + ":" + value.start.slice(2);
		     	 	value.stop=value.stop.slice(0, 2) + ":" + value.stop.slice(2);
		   
		      	});
		    		$scope.setnumber();
			  	});			   		 
				});  
			
 		}
 	}
 }   
$scope.checkgroup=function(id){
$scope.check=false;	
	angular.forEach($scope.tasks,function(value,key){
        if(value.groupId==id){
    		$scope.check=true;
        }
      });
return $scope.check;
}
$scope.onchange=function(){
	var a=angular.element('.type').hasClass('hide');
	
	if(a){
		angular.element('.type').removeClass('hide');
	}
}
  $scope.range = function(min, max, step) {
    step = step || 1;
    var input = [];
    for (var i = min; i <= max; i += step) {
        input.push(i);
    }
    return input;
};
$scope.number=0;
$scope.getnumber=function(){
	$scope.number=$scope.number+1;
	return $scope.number;
}
$scope.setnumber=function(){
$scope.number=0;

}

//disable a schedule
$scope.disable=function(y){
			      $http({
		          method  : 'POST',
		          url     : 'php/disableschedule.php',
		          data    :$.param({'id':y.id}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {
		    					                $http.get("php/gettasks.php")
    .then(function (response) {
    	$scope.tasks = response.data;
    	angular.forEach($scope.tasks,function(value,key){
      if(value.start.length==3){
      	value.start='0'+value.start;
      }
      if(value.stop.length==3){
      	value.stop='0'+value.stop;
     
      }
      if(value.start.length==2){
      	value.start='00'+value.start;
      }
      if(value.stop.length==2){
      	value.stop='00'+value.stop;
     
      }
      if(value.start.length==1){
      	value.start='000'+value.start;
      }
      if(value.stop.length==1){
      	value.stop='000'+value.stop;
     
      }
      
      
         	value.start=value.start.slice(0, 2) + ":" + value.start.slice(2);
     	 	value.stop=value.stop.slice(0, 2) + ":" + value.stop.slice(2);
   
      });
    $scope.setnumber();	
  });
		
				});	

}

//Enable a schedule
$scope.enable=function(y){
			      $http({
		          method  : 'POST',
		          url     : 'php/enableschedule.php',
		          data    :$.param({'id':y.id}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {
		    					                $http.get("php/gettasks.php")
    .then(function (response) {
    	$scope.tasks = response.data;
    	angular.forEach($scope.tasks,function(value,key){
      if(value.start.length==3){
      	value.start='0'+value.start;
      }
      if(value.stop.length==3){
      	value.stop='0'+value.stop;
     
      }
      if(value.start.length==2){
      	value.start='00'+value.start;
      }
      if(value.stop.length==2){
      	value.stop='00'+value.stop;
     
      }
      if(value.start.length==1){
      	value.start='000'+value.start;
      }
      if(value.stop.length==1){
      	value.stop='000'+value.stop;
     
      }
      
      
         	value.start=value.start.slice(0, 2) + ":" + value.start.slice(2);
     	 	value.stop=value.stop.slice(0, 2) + ":" + value.stop.slice(2);
   
      });
    $scope.setnumber();	
  });
		
				});	

}
//Delete a schedule
$scope.delete=function(y){
	$confirm({text: 'Are you sure you want to delete?'})
        .then(function() {
	 				      $http({
		          method  : 'POST',
		          url     : 'php/deleteschedule.php',
		          data    :$.param({'id':y.id}), //forms user object
		          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
		         })
		    					.then(function (response) {
		    					                $http.get("php/gettasks.php")
    .then(function (response) {
    	$scope.tasks = response.data;
    	angular.forEach($scope.tasks,function(value,key){
      if(value.start.length==3){
      	value.start='0'+value.start;
      }
      if(value.stop.length==3){
      	value.stop='0'+value.stop;
     
      }
      if(value.start.length==2){
      	value.start='00'+value.start;
      }
      if(value.stop.length==2){
      	value.stop='00'+value.stop;
     
      }
      if(value.start.length==1){
      	value.start='000'+value.start;
      }
      if(value.stop.length==1){
      	value.stop='000'+value.stop;
     
      }
      
      
         	value.start=value.start.slice(0, 2) + ":" + value.start.slice(2);
     	 	value.stop=value.stop.slice(0, 2) + ":" + value.stop.slice(2);
   
      });
    $scope.setnumber();	
  });
		
				});	
});
}
$scope.onchange2=function(){

	angular.element('.add').removeClass('hide');
	if($scope.scheduletype=='Period'){
		angular.element('.starttime').removeClass('hide');
		angular.element('.stoptime').removeClass('hide');
		angular.element('.duration').addClass('hide');
		angular.element('.frequency').addClass('hide');

	}
	else if($scope.scheduletype=='Duration'){
		angular.element('.starttime').removeClass('hide');
		
		angular.element('.stoptime').addClass('hide');
		angular.element('.duration').removeClass('hide');
		angular.element('.frequency').addClass('hide');

	}
	else if($scope.scheduletype=='Frequency'){
		angular.element('.starttime').removeClass('hide');
		angular.element('.stoptime').addClass('hide');
		angular.element('.duration').removeClass('hide');
		angular.element('.frequency').removeClass('hide');

	}
}

});