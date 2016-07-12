var app=angular.module('chartdisplayapp',['ngMaterial','material.svgAssetsCache'//,'ngMessages'
	]);
    var ws = new WebSocket("ws://10.129.139.139:8180");
 
 
 
           ws.onopen = function(e) {
             console.log('Connection to server opened');
           }

var chartdata=null;
var device_id=null;
var device_type=null;
var custom=null;
var tab=1;
var field=null;
var mydate=new Date();
var month = new Array();
month[1] = "Jan";
month[2] = "Feb";
month[3] = "Mar";
month[4] = "Apr";
month[5] = "May";
month[6] = "June";
month[7] = "July";
month[8] = "Aug";
month[9] = "Sept";
month[10] = "Oct";
month[11] = "Nov";
month[12] = "Dec";


//Used to find current week number of current year
Date.prototype.getWeek = function() 
{
	var date = new Date(this.getTime());
	date.setHours(0, 0, 0, 0);
    date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
    var week1 = new Date(date.getFullYear(), 0, 4);
    return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7);
}



       
var n = month[mydate.getMonth()+1];
var y=mydate.getFullYear();
var d=mydate.getDate();
var w=mydate.getWeek();
/*app.filter('getMonthYear', function () {
	  return function getDateRangeOfWeek(month, year){
	  	return month+" "+year;
	  };
});*/
app.filter('getWeekRange', function () {

    return function getDateRangeOfWeek(weekNo){
    	var mon = new Array();
		mon[1] = "Jan";
		mon[2] = "Feb";
		mon[3] = "Mar";
		mon[4] = "Apr";
		mon[5] = "May";
		mon[6] = "June";
		mon[7] = "July";
		mon[8] = "Aug";
		mon[9] = "Sept";
		mon[10] = "Oct";
		mon[11] = "Nov";
		mon[12] = "Dec";
	    var d1 = new Date();
	    numOfdaysPastSinceLastMonday = eval(d1.getDay()- 1);
	    d1.setDate(d1.getDate() - numOfdaysPastSinceLastMonday);
	    var weekNoToday = d1.getWeek();
	    var weeksInTheFuture = eval( weekNo - weekNoToday );
	    d1.setDate(d1.getDate() + eval( 7 * weeksInTheFuture ));
	    var rangeIsFrom =  d1.getDate()+" " + mon[eval(d1.getMonth()+1)];
	    d1.setDate(d1.getDate() + 6);
	    var rangeIsTo =  d1.getDate()+" " + mon[eval(d1.getMonth()+1)] + " " + d1.getFullYear();
	    //alert(rangeIsFrom + " - "+rangeIsTo);
	    return rangeIsFrom + " - "+rangeIsTo;
	};
});
app.controller('chartdisplaycontroller',function($scope,$http,$interval)
{
	$scope.chartdata=chartdata;
	$scope.userGroup = 1;
	$scope.custom=custom;
	$scope.tab=tab;
	$scope.field=field;
	$scope.mymonth1=n;
	$scope.device_id=device_id;
	$scope.device_type=device_type;
	$scope.mymonth=mydate.getMonth()+1;
	$scope.myyear=y;
	$scope.mydate=d;
	$scope.myweek=w;
	$scope.userDevice=1;
	$scope.month=month;
	if(isNaN(angular.element('#yaxis').val()))
	{
		$scope.limit=4095;
	}
	else
	{
		$scope.limit=angular.element('#yaxis').val();
	}

	
	//Used to check if a year is leap year or not
	$scope.checkLeapYear=function(year)
	{
		if(year/4==0)
		{
			if(year/100==0)
			{
				if(year/400==0)
				{
					return 'yes';
				}
				else
				{
					return 'no';
				}
			}
			else
			{
				return 'yes';
			}
		}
		else
		{
			return 'no';
		}
	}
    $http.get("php/getgroups.php")
    .then(function (response) 
    {
    	$scope.groups = response.data;

	});

	$http.get("php/getdeviceid.php",
	{
		params:
    	{
    		'userGroup':$scope.userGroup
    	}
    })
	.then(function (response)
	{

		$scope.devices = response.data;
		$scope.x=0;
		angular.forEach($scope.devices,function(value,key){
			if($scope.x==0){
				$scope.userDevice=value.deviceId;
			}
			$scope.x=$scope.x+1;
		});
		$http.get("php/chartdatainformation.php",
		{
			params:
			{
				'userDevice':$scope.userDevice
			}
		})
		.then(function (response)
		{
			$scope.deviceinfo=response.data;
					$scope.showGraph($scope.userDevice,1,1,1,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);

		})
	});
	//Used to select group type on display charts page
	$scope.onchange=function()
	{
		
		$http.get("php/getdeviceid.php",
		{
			params:
    		{
    			'userGroup':$scope.userGroup
    		}
    	})
		.then(function (response)
		{

			$scope.devices = response.data;

		});

	}

	$scope.onchange1=function()
	{
		$http.get("php/chartdatainformation.php",
		{
			params:
			{
				'userDevice':$scope.userDevice
			}
		})
		.then(function (response)
		{
			$scope.deviceinfo=response.data;
			$scope.tab=1;
		})
	}

	$scope.showGraph=function(device_id,device_type,field_value,current_tab,current_month,current_year,current_week,current_date,limit)
	{	
		$scope.dataLoading = true;
		angular.element('.chartss').addClass('chartDisplayDiv');
		angular.element('.configuration').addClass('chartDisplayDiv');
		//angular.element('.progressCirculardemoBasicUsage').removeClass('chartDisplayDiv');
		//angular.element('.glyphicon-chevron-left').removeClass('removeGlyphicon');
		$scope.tab=current_tab;
		$scope.device_id=device_id;
		$scope.device_type=device_type;
		$scope.mymonth=current_month;
		$scope.myyear=current_year;
		$scope.myweek=current_week;
		$scope.mydate=current_date;
		//$scope.click=click;
		//window.alert($scope.myyear);
		//window.alert("Entered");
		$scope.field=field_value;
		$scope.limit=limit;
		if($scope.field==1)
		{
			angular.element('#pb').css({'background-color':'blue','color':'white'});
			angular.element('#sb').css({'background-color':'white','color':'black'});
			angular.element('#battery').css({'background-color':'white','color':'black'});
			angular.element('#temperature').css({'background-color':'white','color':'black'});
			angular.element('#humidity').css({'background-color':'white','color':'black'});
			angular.element('#moisture').css({'background-color':'white','color':'black'});

		}
		else if($scope.field==2)
		{
			angular.element('#sb').css({'background-color':'blue','color':'white'});
			angular.element('#pb').css({'background-color':'white','color':'black'});
			angular.element('#battery').css({'background-color':'white','color':'black'});
			angular.element('#temperature').css({'background-color':'white','color':'black'});
			angular.element('#humidity').css({'background-color':'white','color':'black'});
			angular.element('#moisture').css({'background-color':'white','color':'black'});
		}
		else if($scope.field==3)
		{
			angular.element('#battery').css({'background-color':'blue','color':'white'});
			angular.element('#pb').css({'background-color':'white','color':'black'});
			angular.element('#sb').css({'background-color':'white','color':'black'});
			angular.element('#temperature').css({'background-color':'white','color':'black'});
			angular.element('#humidity').css({'background-color':'white','color':'black'});
			angular.element('#moisture').css({'background-color':'white','color':'black'});
		}
		else if($scope.field==4)
		{
			angular.element('#temperature').css({'background-color':'blue','color':'white'});
			angular.element('#pb').css({'background-color':'white','color':'black'});
			angular.element('#sb').css({'background-color':'white','color':'black'});
			angular.element('#battery').css({'background-color':'white','color':'black'});
			angular.element('#humidity').css({'background-color':'white','color':'black'});
			angular.element('#moisture').css({'background-color':'white','color':'black'});
		}
		else if($scope.field==5)
		{
			angular.element('#humidity').css({'background-color':'blue','color':'white'});
			angular.element('#pb').css({'background-color':'white','color':'black'});
			angular.element('#sb').css({'background-color':'white','color':'black'});
			angular.element('#battery').css({'background-color':'white','color':'black'});
			angular.element('#temperature').css({'background-color':'white','color':'black'});
			angular.element('#moisture').css({'background-color':'white','color':'black'});
		}
		else if($scope.field==6)
		{
			angular.element('#moisture').css({'background-color':'blue','color':'white'});
			angular.element('#pb').css({'background-color':'white','color':'black'});
			angular.element('#sb').css({'background-color':'white','color':'black'});
			angular.element('#battery').css({'background-color':'white','color':'black'});
			angular.element('#temperature').css({'background-color':'white','color':'black'});
			angular.element('#humidity').css({'background-color':'white','color':'black'});
		}
		
			//window.alert(device_type);
		
			//window.alert(device_type);
			
			if(device_type==1)
			{
				$http.get("php/getvalvechartdata.php",
				{
					params:
					{
						'device_id':device_id,
						'field_value':field_value,
						'current_tab':current_tab,
						'current_month':$scope.mymonth,
						'current_year':$scope.myyear,
						'current_week':$scope.myweek,
						'current_date':$scope.mydate,
						'yaxis':$scope.limit
					}
				})
				.then(function (response)
				{
					$scope.chartdata=response.data;
					if(field_value==1)
					{
						$scope.custom={
							"title": "Primary Battery Values",
                        	"id": "Primary Battery Chart",
                        	"yAxisName": "Battery in adc Value",
                        	"unit":"Volts"
						}
					}
					if(field_value==2)
					{
						$scope.custom={
							"title": "Secondary Battery Values",
                        	"id": "Secodary Battery Chart",
                        	"yAxisName": "Battery in adc Value",
                        	"unit":"Volts"
						}
					}
					$scope.makeChart($scope.chartdata,$scope.custom,$scope.tab);
				}).
				finally(function()
				{
					$scope.dataLoading = false;
    				$scope.showChart($scope.tab);
    				angular.element('.configuration').removeClass('chartDisplayDiv');
				});
				$scope.dataLoading=true;
			}
			//End Of If clause-device_type==1
			else if(device_type==2)
			{
				//window.alert('rtfgbh');
				$http.get("php/getsensorchartdata.php",
				{
					params:
					{
						'device_id':device_id,
						'field_value':field_value,
						'current_tab':current_tab,
						'current_month':$scope.mymonth,
						'current_year':$scope.myyear,
						'current_week':$scope.myweek,
						'current_date':$scope.mydate,
						'yaxis':$scope.limit
					}
				})
				.then(function (response)
				{
					//alert(JSON.stringify(response.data));
					$scope.chartdata=response.data;
					if(field_value==3)
					{
						$scope.custom={
							"title": "Battery Values",
                        	"id": "Battery Chart",
                        	"yAxisName": "Battery in adc Value",
                        	"unit":"Volts"
						}
					}
					if(field_value==4)
					{
						$scope.custom={
							"title": "Temperature Values",
                        	"id": "Temperature Chart",
                        	"yAxisName": "Temperature in adc Value",
                        	"unit":"  "
						}
					}
					if(field_value==5)
					{
						$scope.custom={
							"title": "Humidity Values",
                        	"id": "Humidity Chart",
                        	"yAxisName": "Humidity in adc Value",
                        	"unit":"  "
						}
					}
					if(field_value==6)
					{
						$scope.custom={
							"title": "Moisture Values",
                        	"id": "Moisture Chart",
                        	"yAxisName": "Moisture in adc Value",
                        	"unit":"  "
						}
					}
					$scope.makeChart($scope.chartdata,$scope.custom,$scope.tab);
					


				}).
				finally(function() 
				{
    				$scope.dataLoading = false;
    				$scope.showChart($scope.tab);
    				angular.element('.configuration').removeClass('chartDisplayDiv');
    				//angular.element('.progressCirculardemoBasicUsage').addClass('chartDisplayDiv');
				});
				$scope.dataLoading=true;
				//angular.element('.progressCirculardemoBasicUsage').removeClass('chartDisplayDiv');

			}
		
		
		
		//Call showChart
	}
	//Used to make amcharts line chart
	$scope.makeChart=function(chartdata,custom,tabnumber)
	{
		/*AmCharts.addInitHandler(function(chart)
		{
            if(chart.dataProvider.length!=0)
            {
				var dataPoint = chart.dataProvider[ chart.dataProvider.length - 1 ];
            	var graph = chart.graphs[0];
             	graph.bulletField = "bullet";
             	dataPoint.bullet = "round";
            }
		},[ "serial" ]);*/
		//window.alert($scope.chartdata);
		//window.alert($scope.custom);
		//window.alert(tabnumber);
		var chart = AmCharts.makeChart( "chartdiv"+tabnumber, 
      	{	
        	"type": "serial",
        	
         	"marginRight": 40,
            "marginLeft": 86,
            "fontFamily": "Helvetica",
            "fontSize": 12,
        	//"pathToImages": "amcharts/images/",
        	"categoryField": "time",
        	"valueField":"value",
        	"dataDateFormat": "YYYY-MM-DD JJ:NN",
        	"startDuration": 1,
        	"backgroundColor": "#000000",
            "creditsPosition":"bottom-right",       
        	// "rotate": true,
        	"categoryAxis": 
        	{
          		"title": $scope.custom.id,
         		"parseDates": true,
          		"equalSpacing" : true,
          		"minPeriod":"mm",
          		"periodValue": "Average",
        	},
			"valueAxis":
        	{
        		"title": $scope.custom.yAxisName,
          		"unit": $scope.custom.unit,
          		"id":"v1",
          		"axisAlpha": 0,
          		"position": "left",
          		"ignoreAxisWidth":true,

          	},
        	"chartCursor": 
        	{
          		"pan": true,
          		"valueLineEnabled": true,
          		"valueLineBalloonEnabled": true,
          		"cursorAlpha":1,
          		"cursorColor":"#258cbb",
          		"categoryBalloonDateFormat":"JJ:NN, DD MMM",
          		"limitToGraph":"g1",
          		"valueLineAlpha":0.2
        	},
        	"valueScrollbar":
        	{
          		"oppositeAxis":true,
          		"offset": 10,
          		"scrollbarHeight":10
        	},
      		"chartScrollbar": 
        	{
          		"graph":'g2',
          		"title": $scope.custom.title,
          		"oppositeAxis":false,
                "offset":30,
                "scrollbarHeight": 80,
                "backgroundAlpha": 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "graphLineAlpha": 0.5,
                "selectedGraphFillAlpha": 0,
                "selectedGraphLineAlpha": 1,
                "autoGridCount":true,
                "color":"#AAAAAA"
        	},
      		"graphs": 
        	[{
          		"id": "g2",
          		"title": $scope.custom.title,
          		"lineThickness ": 10,
          		"fillAlphas": 0.6,
        		"lineAlpha": 0.4,
          		
          		"valueAxis":"v1",
          		"valueField":"value",
          		"balloonText": "[[value]] "+$scope.custom.unit+"</span>"

        	}],
        	"export":
        	{
                "enabled": true
            },
        	"dataProvider":$scope.chartdata 
      	});
		$(function() 
		{ //Format date
        function time_format(d) {
           year=d.getFullYear();
           month=format_two_digits(d.getMonth());
           date=format_two_digits(d.getDate());
           hours = format_two_digits(d.getHours());
           minutes = format_two_digits(d.getMinutes());
           return year+"-"+month+"-"+date+" "+hours + ":" + minutes;
       }
       function format_two_digits(n) {
            return n < 10 ? '0' + n : n;
       }
           
       ws.onmessage = function(e) {
        //alert(2);
		var chartpoint = JSON.parse(e.data);
		//console.log(chartpoint);
		var nmr = new Date();
		var formatted_time = time_format(nmr);
         if($scope.tab==1){
         if($scope.field==3)
         {
           if($scope.device_id==chartpoint['deviceId']){
            	chart.dataProvider.push({
          		time: formatted_time,
               	value: chartpoint['batValue']
               });
               chart.validateData();
               //zoomChart();
           }
           //alert(chartpoint['batValue']);
         }
         else if($scope.field==4)
         {
           //alert(chartpoint['tempValue']);
           if($scope.device_id==chartpoint['deviceId']){
               chart.dataProvider.push({
               time: formatted_time,
               value: chartpoint['tempValue']
               });
               chart.validateData();
              // zoomChart();
           }
           
         }
         else if($scope.field==5)
         {
           if($scope.device_id==chartpoint['deviceId']){
               chart.dataProvider.push({
               time: formatted_time,
               value: chartpoint['humidityValue']
               });
               chart.validateData();
               //zoomChart();
           }
         }
         else if($scope.field==6)
         {
           if($scope.device_id==chartpoint['deviceId']){
               chart.dataProvider.push({
               time: formatted_time,
               value: chartpoint['moistValue']
               });
               chart.validateData();
               //zoomChart();
           }
         }
         }
       }
       ws.onclose = function(e) {
         console.log("Connection closed");
       }

       function disconnect() {
         ws.close();
       }
       });
	}

	$scope.showChart=function(tabnumber)
	{
		angular.element('.chartss').removeClass('chartDisplayDiv');
		var tab='#chartdiv'+tabnumber;
		//alert(tab);
		//$(tab).slideDown("slow");
		angular.element('.extrass').removeClass('displayafter');
	}

	$scope.validateExtra=function(device_Id,deviceType,field,tab,mymonth,myyear,myweek,mydate,limit)
	{

		//window.alert(angular.element('#yaxis').val());
		//window.alert($scope.limit);
		//window.alert(angular.isNumber($scope.limit));
		/*window.alert(device_Id);
		window.alert(deviceType);
		window.alert(field);
		window.alert(tab);
		window.alert(mymonth);
		window.alert(myyear);
		window.alert(myweek);
		window.alert(mydate);
		window.alert(myclick);*/
		//window.alert(parseInt(angular.element('#yaxis').val()));
		if(isFinite(parseInt(angular.element('#yaxis').val())))
		{
			angular.element('.limit_p').addClass('limit_error');
			$scope.showGraph(device_Id,deviceType,field,tab,mymonth,myyear,myweek,mydate,limit);
		}
		else
		{
			angular.element('.limit_p').removeClass('limit_error');
		}
	}

	$scope.before=function()
	{
		if($scope.tab==3)
		{
			//window.alert($scope.mymonth);
			
			//var month_count;
			if(angular.element("#impspan").html()=="Jan")
			{
				
				$scope.mymonth=1;
			}
			else if(angular.element("#impspan").html()=="Feb")
			{
				
				$scope.mymonth=2;
			}
			else if(angular.element("#impspan").html()=="Mar")
			{
				
				$scope.mymonth=3;
			}
			else if(angular.element("#impspan").html()=="Apr")
			{
				
				$scope.mymonth=4;
			}
			else if(angular.element("#impspan").html()=="May")
			{
				
				$scope.mymonth=5;
			}
			else if(angular.element("#impspan").html()=="June")
			{
				
				$scope.mymonth=6;
			}
			else if(angular.element("#impspan").html()=="July")
			{
				
				$scope.mymonth=7;
			}
			else if(angular.element("#impspan").html()=="Aug")
			{
				
				$scope.mymonth=8;
			}
			else if(angular.element("#impspan").html()=="Sept")
			{
				
				$scope.mymonth=9;
			}
			else if(angular.element("#impspan").html()=="Oct")
			{
				
				$scope.mymonth=10;
			}
			else if(angular.element("#impspan").html()=="Nov")
			{
				
				$scope.mymonth=11;
			}
			else if(angular.element("#impspan").html()=="Dec")
			{
				
				$scope.mymonth=12;
			}

			if($scope.mymonth==1)
			{
				$scope.mymonth=1;
			}
			else{
				$scope.mymonth=$scope.mymonth-1;
			}

			$scope.mymonth1=$scope.month[$scope.mymonth];
			//window.alert($scope.mymonth);
			//window.alert($scope.mymonth1);
			angular.element('#impspan').text($scope.mymonth1+", "+$scope.myyear);
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);
		}
		else if ($scope.tab==4) 
		{
			$scope.myyear=$scope.myyear-1;
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);
		}
		else if($scope.tab==2)
		{
			if($scope.myweek==1)
			{
				$scope.myweek==1;
			}
			else
			{
				$scope.myweek=$scope.myweek-1;
			}
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);		
		}
		else if($scope.tab==1)
		{
			//window.alert($scope.mymonth);
			if($scope.mydate==1)
			{
				$scope.myweek==1;
			}
			else
			{
				$scope.mydate=$scope.mydate-1;
			}
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);
		}
		
		//window.alert(month_count);
	}
	$scope.after=function()
	{
		//window.alert(angular.element('#impspan').html());
		if($scope.tab==3)
		{
			//var month_count;
			if(angular.element("#impspan").html()=="Jan")
			{
				
				$scope.mymonth=1;
			}
			else if(angular.element("#impspan").html()=="Feb")
			{
				
				$scope.mymonth=2;
			}
			else if(angular.element("#impspan").html()=="Mar")
			{
				
				$scope.mymonth=3;
			}
			else if(angular.element("#impspan").html()=="Apr")
			{
				
				$scope.mymonth=4;
			}
			else if(angular.element("#impspan").html()=="May")
			{
				
				$scope.mymonth=5;
			}
			else if(angular.element("#impspan").html()=="June")
			{
				
				$scope.mymonth=6;
			}
			else if(angular.element("#impspan").html()=="July")
			{
				
				$scope.mymonth=7;
			}
			else if(angular.element("#impspan").html()=="Aug")
			{
				
				$scope.mymonth=8;
			}
			else if(angular.element("#impspan").html()=="Sept")
			{
				
				$scope.mymonth=9;
			}
			else if(angular.element("#impspan").html()=="Oct")
			{
				
				$scope.mymonth=10;
			}
			else if(angular.element("#impspan").html()=="Nov")
			{
				
				$scope.mymonth=11;
			}
			else if(angular.element("#impspan").html()=="Dec")
			{
				
				$scope.mymonth=12;
			}
			//window.alert($scope.mymonth);
			if($scope.mymonth==12)
			{
				$scope.mymonth==12
			}
			else
			{
				$scope.mymonth=$scope.mymonth+1;
			}
			$scope.mymonth1=$scope.month[$scope.mymonth];
			angular.element('#impspan').text($scope.mymonth1+", "+$scope.myyear);
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);
		}
		else if ($scope.tab==4) 
		{
			$scope.myyear=$scope.myyear+1;
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);
		}
		
		else if($scope.tab==2)
		{
			if($scope.myweek==53)
			{
				$scope.myweek==53;
			}
			else
			{
				$scope.myweek=$scope.myweek+1;
			}
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);		
		}
		else if($scope.tab==1)
		{
			if($scope.mymonth==1 || $scope.mymonth==3 || $scope.mymonth==5 || $scope.mymonth==7 || $scope.mymonth==8 || $scope.mymonth==10 || $scope.mymonth==12)
			{
				if($scope.mydate==31)
				{
					$scope.mydate=31;
				}
				else
				{
					$scope.mydate=$scope.mydate+1;
				}
			}
			else if($scope.mymonth==4 || $scope.mymonth==6 || $scope.mymonth==9 || $scope.mymonth==11)
			{
				if($scope.mydate==30)
				{
					$scope.mydate=30;
				}
				else
				{
					$scope.mydate=$scope.mydate+1;
				}
			}
			else if($scope.mymonth==2)
			{
				$scope.check=checkLeapYear($scope.myyear);
				if($scope.check=='yes')
				{
					if($scope.mydate==29)
				{
					$scope.mydate=29;
				}
				else
				{
					$scope.mydate=$scope.mydate+1;
				}

				}
				else if($scope.check=='no')
				{
					if($scope.mydate==28)
				{
					$scope.mydate=28;
				}
				else
				{
					$scope.mydate=$scope.mydate+1;
				}

				}
			}
			$scope.showGraph($scope.device_id,$scope.device_type,$scope.field,$scope.tab,$scope.mymonth,$scope.myyear,$scope.myweek,$scope.mydate,$scope.limit);
		}

	}
});