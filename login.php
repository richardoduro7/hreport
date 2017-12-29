<?php require_once("includes/session.php"); ?>
<?php require_once("includes/config.php");?> 



<?php
/*
if(logged_in()){

}
*/


if (isset($_POST['submit'])) {
	
$username = trim($_POST['usr']);
$pass = trim($_POST['passwrd']);
$hashed_password = sha1($pass);

$query = "SELECT * from signup where emp_num='{$username}' and password='{$hashed_password}' LIMIT 1";

		 
$result_set = mysqli_query($con,$query);

$found_user = mysqli_fetch_assoc($result_set);

 $testUser = $found_user["emp_num"];
     $testSHA =$found_user["password"];
	 
	 
	 if ( $username==$testUser && $hashed_password==$testSHA){
		 
		 
		 $queryins="INSERT INTO login (
              emp_num,password 
            ) VALUES (
              '{$username}','{$hashed_password}'
            )";
		 $result_ins=mysqli_query($con,$queryins);
		 
		
        $_SESSION['username'] = $testUser;
		
		
		
		$user=$_SESSION['username'];
    // 	
		
		$searchpro="SELECT * FROM PROFILE where username='{$user}'";
		$qu=mysqli_query($con,$searchpro);
		$an=mysqli_fetch_assoc($qu);
		if($an!=null)
		{
			$hi=$an['First_Name'];
			redirect_to2("index.php");
		}
		else{ redirect_to2("signupnxt.php");
		}
		
     }
	 else{	 
		 echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
     }
    
	}

?>

<!--signup----------------------------------->


<?php


if(isset($_POST['submits'] ) && $_POST["emp_type"]!="" && $_POST["pass"]!="" && $_POST["pass"]==$_POST["pass1"])
{
		
$emp_num=$_POST['emp_num'];
$emp_type=$_POST['emp_type'];
//$phon=$_POST["phone"];
$pss=$_POST['pass'];
$hashed_password = sha1($pss);



 

  $queryins="INSERT INTO signup (
              emp_num, company, password 
            ) VALUES (
              '{$emp_num}', '{$emp_type}','{$hashed_password}'
            )";
  //$qyins="INSERT INTO login (
 //             emp_num, password 
    //        ) VALUES (
      //        '{$emp_num}','{$hashed_password}'
        //    )";
			
			

$result_ins=mysqli_query($con,$queryins);

//$ins=mysqli_query($con,$qyins);

if($result_ins)
{	
	 echo "<script type='text/javascript'>alert('Data Inserted Correctly')</script>";
	  redirect_to2("login.php");

	 }
else{
	echo "<script type='text/javascript'>alert('Try Again Later')</script>";
}

}
?>














<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AGA Hazard Reporting! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
	<!-- My custom JS files -->
	 <script src="../production/includes/signup.js"> </script>
	  
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="login.php" method="post">
			
              <h1>Login</h1>
			  
              <div>
                <input type="text" class="form-control" placeholder="Employee Number or Username" required="" name="usr" id="usr" />
              </div>
              <div>
                <input type="password" placeholder="Password" class="form-control" required="" name="passwrd" id="passwrd"/>
              </div>
              <div>
                <button  class="btn btn-success btn-lg btn-block" name="submit">Sign In</button>
                <a href="forgot.php">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Anglogold Ashanti!</h1>
                  <p>©2017 All Rights Reserved.Anglogold Ashanti! . Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
		
<!--Sign UP HTML-->

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" action="login.php" name="signup">
              <h1>Create Account</h1>
			  <div>
                <input type="text" class="form-control" maxlength="10" placeholder="Employee Number or Username" required="" name="emp_num"/>
              </div>
		<!--	  <div>
                <input type="text" class="form-control" placeholder="Contractor or AGA" required="" name="emp_type" />
              </div>			
			  
			  -->
			   
                      
                        <div >
            <select  name="emp_type" class="form-control">	 
			<?php 
			//update
				$m="SELECT * FROM contractor";
				$resul=mysqli_query($con,$m);
				
				while ($ro = mysqli_fetch_assoc($resul)){
							echo "<option value='".$ro['contractorname']."'>" . $ro['contractorname'] . "</option>";
				}
			?>
			</select>
			</div>
			</br>
			
			
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="pass" id="passwell"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Confirm Password" required="" name="pass1" id="passwell1"/>
              </div> 
			  <div>
			   <button class="btn btn-success btn-lg btn-block" name="submits" >Sign Up</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link" >Already a member ?
                  <a href="#signin"  class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> AngloGold Ashanti!</h1>
                  <p>©2017 All Rights Reserved. AngloGold Ashanti! . Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
		
		
		

		
	    
    </div>
  </body>
</html>



