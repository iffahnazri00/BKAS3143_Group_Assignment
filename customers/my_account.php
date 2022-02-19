<html>
	<body>

<?php
	session_start();
	if(!isset($_SESSION['cust_email'])){
		echo "<script>window.open('../checkout.php','_self')</script>";
	}

	else {
	include("includes/db.php");
	include("../includes/header.php");
	include("functions/functions.php");
	include("includes/main.php");
?>

  <main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">My </span>Account
      </div>	  
		<p class="nero__text"></p>
    </div>
  </main>

<div id="content" ><!-- content Starts -->
	<div class="container" ><!-- container Starts -->
		<div class="col-md-12"><!-- col-md-12 Starts -->

<?php
	$cust_email = $_SESSION['cust_email'];
	$get_customer = "select * from customers where cust_email='$cust_email'";
	$run_customer = mysqli_query($con,$get_customer);
	$row_customer = mysqli_fetch_array($run_customer);

	$cust_confirm_code = $row_customer['cust_confirm_code'];
	$cust_fname = $row_customer['cust_fname'];
	$cust_lname = $row_customer['cust_lname'];

	if(!empty($cust_confirm_code)){
?>

<div class="alert alert-danger"><!-- alert alert-danger Starts -->
	<strong> Warning! </strong> Please confirm your email and if you have not received your confirmation email
		<a href="my_account.php?send_email" class="alert-link">
			Send Email Again
		</a>
</div><!-- alert alert-danger Ends -->

<?php 
	} 
?>

</div><!-- col-md-12 Ends -->

<div class="col-md-3"><!-- col-md-3 Starts -->

<?php 
	include("includes/sidebar.php"); 
?>

</div><!-- col-md-3 Ends -->

<div class="col-md-9" ><!--- col-md-9 Starts -->
	<div class="box" ><!-- box Starts -->

<?php
	if(isset($_GET[$cust_confirm_code])){

	$update_customer = "update customers set cust_confirm_code='' where cust_confirm_code='$cust_confirm_code'";
	$run_confirm = mysqli_query($con,$update_customer);
		echo "<script>alert('Your email has been confirmed!')</script>";
		echo "<script>window.open('my_account.php?my_orders','_self')</script>";
	}

	if(isset($_GET['send_email'])){
		$subject = "Email Confirmation Message";
		$from = "sad.ahmed22224@gmail.com";
		$message = "

		<h2>
			Email Confirmation By Computerfever.com $cust_fname
		</h2>
		
		<a href='localhost/sstho/customers/my_account.php?$cust_confirm_code'>
			Click Here To Confirm Email
		</a>
		";

		$headers = "From: $from \r\n";
		$headers .= "Content-type: text/html\r\n";

		mail($cust_email,$subject,$message,$headers);
			echo "<script>alert('Your confirmation email has been sent to you! Kindly check your inbox.')</script>";
			echo "<script>window.open('my_account.php?my_orders','_self')</script>";
	}

	if(isset($_GET['my_orders'])){
		include("my_orders.php");
	}

	if(isset($_GET['shipment_status'])){
		include("shipment_status.php");
	}

	if(isset($_GET['edit_account'])) {
		include("edit_account.php");
	}

	if(isset($_GET['change_pass'])){
		include("change_pass.php");
	}

	if(isset($_GET['delete_account'])){
		include("delete_account.php");
	}

	if(isset($_GET['my_wishlist'])){
		include("my_wishlist.php");
	}

	if(isset($_GET['delete_wishlist'])){
		include("delete_wishlist.php");
	}
?>

			</div><!-- box Ends -->
		</div><!--- col-md-9 Ends -->
	</div><!-- container Ends -->
</div><!-- content Ends -->

<?php
	include("../includes/footer.php");
?>

<script src="js/jquery.min.js"> </script>
	<script src="js/bootstrap.min.js"></script>

	</body>
</html>

<?php 
	} 
?>
