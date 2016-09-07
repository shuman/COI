/* Angular Modules */
var coiApp = angular.module('cutoutApp', []);

coiApp.factory('navigation', function() {
    return {
        vars : {
            orderView : false,
        },
    };
});

// app.controller('QuestionsStatusController1', ['$rootScope', '$scope', 'myservice', function ($rootScope, $scope, myservice) {
//        $scope.myservice = myservice;   
// }]);
// app.controller('QuestionsStatusController2', ['$rootScope', '$scope', 'myservice', function ($rootScope, $scope, myservice) {
//       $scope.myservice = myservice;
// }]);
// coiApp.service('myservice', function() {
//   orderView : true;
// });

coiApp.controller('mainNav', ['$scope', 'navigation', function($scope, navigation) {
	$scope.newOrder = function(orderType){
		if(orderType == 'order'){
			navigation.vars.orderView = true;
		}
		else{
			navigation.vars.orderView = false;
		}
	};
}]);

coiApp.controller('shadowAdding', ['$scope', function($scope) {
	$scope.resetShadow = function(){
		if($scope.shadowOn){
            $scope.shadowValue = 0.25;
			jQuery('input[name="shadow_option"]:first').prop('checked', true);
			$scope.imgUrl = '/assets/images/pricing/shadow/1.jpg';
		}
		else{
            $scope.shadowValue = 0;
			jQuery('input[name="shadow_option"]:last').prop('checked', true);
		}
	}

	$scope.showImage = function(obj){
		var target = angular.element(obj.currentTarget);
		var img    = target.attr('data-img');
		var value  = target.attr('value');

		$scope.shadowName = value;
		
		if(img != ''){
			$scope.imgUrl = '/assets/images/pricing/shadow/' + img;
		}
		else{
			$scope.shadowOn = false;
			$scope.imgUrl = '/assets/images/pricing/shadow/1.jpg';
		}
	}
}]);


coiApp.controller('mainCtrl', ['$scope', 'navigation', function($scope, navigation) {

    $scope.orderView = navigation.vars.orderView;

  	$scope.servicePrice = {
  			"fileFormat": {
		  		"psd": 0.10,
		  		"tiff": 0.10
  			},
  			"complexity": {
				"basic": 0.5,
				"regular": 1.0,
				"medium": 2.0,
				"advance": 3.5,
				"complex": 7.0
  			},
  			"shadow": {
				"drop": 0.25,
				"natural": 0.25,
				"reflection": 0.25,
				"mirror": 0.25
  			},
  			"mannequin": {
  				"ghost": 1.5
  			},
  			"mannequin": {
  				"fix_imperfection": 0.5,
  				"straighten_symmetric": 0.25
  			},
  			"resizing": {
  				"variation": 0.25
  			}
  	};

    /*
     * ****************************************************************
     * Order Functions
     * ****************************************************************
     */
    $scope.oServices = [];
  	$scope.oCosts = [];
    $scope.qty = 0;
    $scope.paymentOption = {
        text : 'Pay Now'
    };


    $scope.imgCmplx = {
        defaultType:'medium',
        defaultValue: $scope.servicePrice.complexity.medium,
    };

    $scope.imgComplexity = function($event){
        var value = $event.target.value;
    }

    $scope.fixImpOpt = function(){
        if(!$scope.fixImpOn){
            $scope.fix_basic = false;
            $scope.fix_variation = false;
        }
    }

    

    /*
     * ****************************************************************
     * Quotation Functions
     * ****************************************************************
     */
  	$scope.qServices = [];
  	$scope.qRetouching = false;
  	$scope.qMasking = false;
  	$scope.qReturnFileType = [];
  	$scope.qServiceSelection = function ($event) {
  		var value = $event.target.value;
  		var idx = $scope.qServices.indexOf(value);
  		
  		if($event.target.checked){
  			if(idx < 0){
  				$scope.qServices.push(value);
  			}
  		}
	  	else{
	  		if(idx > -1){
	  			$scope.qServices.splice(idx, 1);
	  		}
	  	}
  	};

  	$scope.qReturnFileTypeSelection = function ($event) {
  		var value = $event.target.value;
  		var idx = $scope.qReturnFileType.indexOf(value);
  		
  		if($event.target.checked){
  			if(idx < 0){
  				$scope.qReturnFileType.push(value);
  			}
  		}
	  	else{
	  		if(idx > -1){
	  			$scope.qReturnFileType.splice(idx, 1);
	  		}
	  	}
  	};

}]);






