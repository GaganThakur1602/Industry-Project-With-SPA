<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.2/angular-ui-router.min.js">
</script>
<base href=<?php echo base_url()?> >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="js/script.js"></script>
<style>
body{
    margin: 0;
}

/*                                                              Navigation Bar CSS START                                                    */
.home>a,
.about>a,
.su>a,
.si>a{
    color: inherit;
    text-decoration: none;
}
.flex-container{
    display: flex;
    flex-wrap: nowrap;
    color: white;
    background-image:url(<?php echo base_url();?>images/Colored_Shapes.svg);
    background-repeat:no-repeat;
    background-size: cover;
    justify-content: center;
    height:13vh;

}
.flex-logo{

    flex-basis: 40vw; 
    margin-left: 20px;
    align-self:center;

}
.flex-nav{
    flex-basis: 60vw; 
    display: flex;
    flex-wrap: nowrap;
    color: white;
    margin-top: 5vh;
    margin-right: 2vw;
    justify-content: space-between;
    font-size: 18px;
}
div.home>a:link:hover{
    color: rgb(243, 104, 40);
    background-color: transparent;
    text-decoration: none;
}
.on_hover{
    margin-top: 4vh;
    display: none;
    background-color: aqua;
}
.home:hover,.my_area:hover,.kb:hover,.community:hover,.si:hover,.su:hover,.about:hover{
    color:rgb(225, 123, 7);
    
}
/*                                                              Navigation Bar CSS END                                                   */

</style>
</head>
<body ng-app="serviceDesk">
<div class="flex-container">
    <div class="flex-logo" >
        <div class="alma" style="margin-left: 200px;">
            <div style="display: inline;"><img src="<?php echo base_url();?>images/serviceorg-normal.png" style="width:40px ; height:40px; "></div>
            <div style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;  display: inline;font-size: 30px;">AlmaShines</div>
        </div>
            
    </div>
    <div style="flex-grow:4; align-items:center;">
        <div class="flex-nav">
            <div class="home"><a href="service">Home</a></div>
            <div class="my_area">My Area</div>
            <div class="kb">Knowledge Base</div>
            <div class="community">Community</div>
            <div class="si"><a href="index.php">Sign In</a></div>
            <div class="su"><a href="./service/customer_sign_up">Sign Up</a></div>
            <div class="about"><b>A<sup>+</sup></b></div>
        </div>
        <div class="on_hover"><hr></div>
    </div>
</div>
