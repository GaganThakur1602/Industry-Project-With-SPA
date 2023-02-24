
<div class="grid-container">
    <!-- <div class="item1">
        <span class="alma">
            <img src="serviceorg-normal.png" style="width:40px ; height:40px; ">
            <span style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; margin-bottom:3px;">AlmaShines</span>
        </span>
            
    </div>
    <div class="item2">
        <span class="navbar">
            <div>
            Home &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            My Area &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Knowledge Base &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Community &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Sign In &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Sign Up &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>A<sup>+</sup></b>
            </div>
        </span>
    </div> -->
    <div class="item3">
        <div style="font-size:16px; font-family:Arial,sans-serif;margin-left:200px;margin-top:10px">Home  /  Sign In</div>
    </div>  

    <div class="item4">
        <form>
            <input type="search" placeholder="Search articles" class="articles" style="height:4vh">
            <button type="submit" name="search" class="search_btn">Search</button>
          </form>
    </div>
  
    <div class="item5" ng-controller="userLoginController">
        <div>
            <h2>Already a member?</h2>
            <p>Sign In</p>
            <!-- // <php echo form_open('service/customer_validation') > -->
            <form name="userLogin">
            <div>
                <span class="error" ng-show="userLogin.c_email.$error.required">
                    Required!</span>
                <span class="error" ng-show="userLogin.c_email.$error.email">
                    Not valid email!</span>
            </div>
                <input type="email" placeholder="Email Address" name="c_email" id="email" ng-model="userEmail" required>
            <div>
                <span class="error" ng-show="userLogin.c_password.$error.required">
                    Required!</span>

            </div>
                <input id = "password" type="password" placeholder="Password"  name="c_password" ng-model="userPassword" required>
                <br>

                <div>
                    <input type="checkbox" name="remember" >Remember me</input>
                    <input type="submit" value="Sign In" class="primary" ng-click="validateUser(userEmail,userPassword)" >
                </div>
        
            </form>
            <div ng-if="verifyEmail"><h3>Please Verify Your Email</h3></div>
        </div>
    
    
    </div>
    <div class="item6">
        <div class="container1">

                <div>
                    <img src="<?php echo base_url();?>images/user.png" style="height:80px; width:80px; ">
                </div>
                <div style="flex-shrink: 2;align-self: center;"id="sign_up">
                    New User? <a href='service/customer_sign_up' color="red">Sign Up</a><br>
                    Create an account to submit tickets, read articles and engage in our community.
                </div>

        </div>
        <div class="container2">
            
                <div>
                    <img src="<?php echo base_url();?>images/forgot_password.png" style="height:80px; width:80px; ">
                </div>
                <div style="flex-shrink: 2; align-self: center;"id="reset">

                    Forgot Password? <a href='a.html' color="red">Reset</a><br>
                    We will send a password reset link to your email address.
                </div>
            
            
        </div>
        <div class="container3">
            

                <div>
                    <img src="<?php echo base_url();?>images/agent.png" style="height:80px; width:80px; ">
                </div>
                <div style="flex-shrink: 2;align-self: center;" id="agent">

                    Are you an Admin? <a href='service/admin_login_view' color="red">Login Here</a><br>
                    You will be taken to the Admin Dashboard.
                </div>
            
            
        </div>
    </div>

</div>