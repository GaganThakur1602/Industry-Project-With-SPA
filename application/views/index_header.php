<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.min.js">
    </script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.2/angular-ui-router.min.js">
</script>

    <!-- Font Icon -->
    <!-- <link rel="stylesheet" href="./signup/fonts/material-icon/css/material-design-iconic-font.min.css"> -->

    <!-- Main css -->
    <link rel="stylesheet" href="./signup/css/style.css">
<base href=<?php echo base_url()?> >
<!-- <script src="js/script.js"></script> -->
<script src="js/route.js"></script>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>AlmaShines</title>
</head>
<body ng-app="serviceDeskRoute" ng-init="session='<?php echo $session;?>';adminsession='<?php echo $adminsession;?>'">
<div class="flex-container">
    <div class="flex-logo" >
        <div class="alma" style="margin-left: 200px;">
            <div style="display: inline;"><img src="<?php echo base_url();?>images/serviceorg-normal.png" style="width:40px ; height:40px; "></div>
            <div style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;  display: inline;">AlmaShines</div>
        </div>
            
    </div>
    <div style="flex-grow:4; align-items:center;">
        <div class="flex-nav">
            <div class="home"><a ui-sref="home">Home</a></div>
            <div class="my_area">My Area</div>
            <div class="kb"><a ui-sref="admin">Admin Login</a></div>
            <div class="community">Community</div>
            <div class="si"><a ui-sref="home">Sign In</a></div>
            <div class="su"><a ui-sref="sign_Up">Sign Up</a></div>
            <div class="about" ng-if="(loggedIn == null)&&(session=='0')"><b>A<sup>+</sup></b></div>
            <div class="logout" ng-if="((session!='0')||(loggedIn != null)||(adminsession!='0'))" ng-controller="logoutController"><a ng-click="logout()"><i style="font-size:20px" class="fa">&#xf08b;</i></a></div>
        </div>
        <div class="on_hover"><hr></div>
    </div>
</div>
<div>
    <ui-view></ui-view>
</div>
