var app = angular.module("serviceDeskRoute", ["ui.router"]);

app.config(function($stateProvider,$urlMatcherFactoryProvider,$urlRouterProvider,$locationProvider) {
    $urlRouterProvider.otherwise("/home");
    $locationProvider.html5Mode(true);
    // $routeProvider.caseInsensitiveMatch = true;
    $urlMatcherFactoryProvider.caseInsensitive(true);
    $stateProvider
        .state("sign_Up", {
            url:"/sign_Up",
            templateUrl: './signup/',
            controller: 'userSignupController',
            // controllerAs: 'home'
        })
        .state("home", {
            url:"/home",
            templateUrl: './templates/home.html',
            controller: 'userLoginController',
            // controllerAs: 'home'
        })
        .state("ticketView", {
            url:"/ticket",
            templateUrl: './templates/customer_ticket_view.html',
            controller: 'displayTickets',
            // controllerAs: 'home'
        })
        .state("logout", {
            url:"/home",
            templateUrl: './templates/home.html',
            controller: 'logoutController',
            // controllerAs: 'home'
        })
        .state("admin", {
            url:"/admin",
            templateUrl: './templates/admin_login_view.html',
            controller: 'adminLoginController',
            // controllerAs: 'home'
        })
        .state("adminTicket", {
            url:"/admintickets",
            templateUrl: './templates/admin_ticket_view.html',
            controller: 'adminTicketsController',
            // controllerAs: 'home'
        })
        .state("success", {
            url:"/success",
            templateUrl: './templates/success.html',
            // controller: 'adminTicketsController',
            // controllerAs: 'home'
        })
        // .otherwise({redirectTo: '/home'})
        
});
app.controller('userLoginController',function($scope,$http,$state,$rootScope){
    
    if($rootScope.session!='0'){
        $state.go('ticketView');
    }


    $scope.verifyEmail=false;
    $scope.validateUser = function(userEmail,userPassword){
        // console.log(userEmail,userPassword);
        var datap  = {
            'c_email': userEmail,
            'c_password': userPassword
        }
        var postData = 'myData='+JSON.stringify(datap);

        $http(
            {
                method: 'POST',
                url : 'service/customer_validation_ang',
                headers:{'Content-Type': 'application/x-www-form-urlencoded'},
                data: postData
            }
        )
            .then(function(response) {
                // console.log(response.data.customer_id);
                if(response.data.customer_id!=null){
                    // console.log('if');
                    $rootScope.session = response.data.customer_id ;
                    $state.go('ticketView');
                }
                else{
                    // console.log('else');
                    $rootScope.loggedIn = null ;
                    $scope.verifyEmail = true;
                }

            });

    }
});

app.controller('adminLoginController',function($scope,$http,$state,$rootScope){
    if($rootScope.adminsession!='0'){
        $state.go('adminTicket');
    }
    $scope.validateAdmin = function(adminEmail,adminPassword){
        console.log(adminEmail,adminPassword);
        var datap  = {
            'a_email': adminEmail,
            'a_password': adminPassword
        }
        var postData = 'myData='+JSON.stringify(datap);

        $http(
            {
                method: 'POST',
                url : 'service/admin_validation_ang',
                headers:{'Content-Type': 'application/x-www-form-urlencoded'},
                data: postData
            }
        )
            .then(function(response) {
                console.log(response.data);
                if(response.data==1){
                    $rootScope.adminsession="Admin 1";
                    $state.go('adminTicket');
                }

            });

    }
});
app.controller('displayTickets',function($scope,$http,$rootScope,$state){
    if($rootScope.session == '0'){
        $state.go('home');
    }
    $scope.showTable = false;
    $scope.test = "Controller";
    $scope.showTickets = function(){
        $scope.showTable = true;
        $http(
            {
                method: 'POST',
                url : 'service/customer_ticket_load_ang'
            }
            )
            .then(function(response) {
                var response_data = response.data;
                console.log(response_data);
                $scope.showTable = true;
                $scope.rdata = response_data;
            });

    }
    $scope.hideTickets = function(){
        $scope.showTable = false;
    }
});
app.controller('submitTicket',function($scope,$http,$window){
    $scope.title=null;
    $scope.description = 'Add a description to your ticket';
    $scope.submitTicket = function(){
        console.log($scope.title);
        console.log($scope.description);
        console.log($scope.file);
        var datap  = {
            'title': $scope.title,
            'description': $scope.description,
            'file': "abc.png"
        }
        if(($scope.title!=null))
        {

            $http(
                {
                    method: 'POST',
                    url : 'service/customer_ticket_submit_ang',
                    headers:{'contentType': 'application/json'},
                    data: datap
                }
                )
                .then(function(response) {
                    console.log(response.data);
                    $scope.title=null;
                    $scope.description='Add a description to your ticket';
                    $window.alert("Ticket added successfully");

                });
        }

        

    }
});
app.controller('userSignupController',function($scope,$http,$state){
    $scope.submitUserDetails = function(){
        if($scope.password==$scope.re_password){
            var datap  = {
                'name':$scope.name,
                'email':$scope.email,
                'password':$scope.password
            }
            var postData = 'myData='+JSON.stringify(datap);
            $http(
                {
                    method: 'POST',
                    url : 'service/customer_details_submit_ang',
                    headers:{'Content-Type': 'application/x-www-form-urlencoded'},
                    data: postData
                }
                )
                .then(function(response) {
                    console.log(response.data);
                    if(response.data==1){
                        $state.go('success'); 
                    }
                });
        }
    }
});
app.controller('adminTicketsController',function($scope,$http,$state,$rootScope){
    if($rootScope.adminsession == '0'){
        $state.go('admin');
    }
    $scope.showTicketsAdmin = function(){
        $http(
            {
                method: 'POST',
                url : 'service/admin_ticket_view_ang'
            }
            )
            .then(function(response) {
                var response_data = response.data;
                console.log(response_data);
                $scope.rdata = response_data;
            });

    }
});
app.controller('logoutController',function($scope,$http,$rootScope,$state){
    $scope.logout= function(){
        $http(
            {
                method: 'POST',
                url : 'service/logout'
            }
            )
            .then(function(response) {
                if(response.data.customer_id==null){
                    // $rootScope.loggedIn=null;
                    $rootScope.session = '0';
                    $rootScope.adminsession = '0';
                    $state.go("home");
                }
            });

    }
});
