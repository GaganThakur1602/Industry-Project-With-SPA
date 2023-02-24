var app = angular.module('serviceDesk',[]);
app.controller('userLoginController',function($scope,$http){
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
                console.log(response.data);
                if(response.data==1){
                    location.replace("service/customer_ticket_view"); 
                }
                else{
                    $scope.verifyEmail = true;
                }

            });

    }
});

app.controller('adminLoginController',function($scope,$http){
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
                    location.replace("service/admin_ticket_view"); 
                }

            });

    }
});
app.controller('displayTickets',function($scope,$http){
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
app.controller('submitTicket',function($scope,$http){
    $scope.submitTicket = function(){
        console.log($scope.title);
        console.log($scope.description);
        console.log($scope.file);
        var datap  = {
            'title': $scope.title,
            'description': $scope.description,
            'file': "abc.png"
        }
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
                // if(response.data==1){
                //     location.replace("service/customer_ticket_view"); 
                // }
            });

        

    }
});
app.controller('userSignupController',function($scope,$http){
    $scope.submitUserDetails = function(){
        // console.log($scope.name);
        // console.log($scope.email);
        // console.log($scope.password);
        // console.log($scope.re_password);
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
                        location.replace("service/success"); 
                    }
                });
        }
    }
});
app.controller('adminTicketsController',function($scope,$http){
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

