var app = angular.module('serviceDesk', ["ui.router"]).config(function($stateProvider,$urlMatcherFactoryProvider,$urlRouterProvider,$locationProvider) {
    $urlRouterProvider.otherwise("/service");
    $locationProvider.html5Mode(true);
    // $routeProvider.caseInsensitiveMatch = true;
    $urlMatcherFactoryProvider.caseInsensitive(true);
    $stateProvider
        .state("tickets", {
            url:"/service/customer_ticket_view"
        })
        
        
})
app.controller('userLoginController',function($scope,$http,$state){
    $scope.validateUser = function(userEmail,userPassword){
        // console.log(userEmail,userPassword);
        var datap  = {
            'c_email': userEmail,
            'c_password': userPassword
        }

        $http(
            {
                method: 'POST',
                url : 'service/test',
                headers:{'contentType': 'application/json'},
                data: datap
            }
        )
            .then(function(response) {
                console.log(response.data);
                if(response.data==1){
                    $state.go('tickets', {}, {reload: true});
                }
            });

    }
});
app.controller('displayTickets',function($scope,$http,$state){
    $scope.showTickets = function(){
        console.log('Tickets Here');
        // $http(
        //     {
        //         method: 'POST',
        //         url : 'service/test',
        //         headers:{'contentType': 'application/json'},
        //         data: datap
        //     }
        // )
        //     .then(function(response) {
        //         console.log(response.data);
        //         if(response.data==1){
        //             $state.go('tickets', {}, {reload: true});
        //         }
        //     });

    }
})


