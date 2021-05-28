<?php
	session_start();
	include("connection.php");
	$Email_Error = "<p>User not Exists !</p>";
	$Password_Error = "<p>Password is incorrect !<p>";
	
	
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$password1 = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
	
	$password1 = hash('sha256', $password1);
	$email = mysqli_real_escape_string($conn, $email);
	$password = mysqli_real_escape_string($conn, $password1);
	
	$sql1 = "Select * from Admin where Admin_email = '$email' and Admin_pass ='$password'";
	$sql2 = "Select * from Admin where Admin_email = '$email'";

	$check_admin = mysqli_query($conn, $sql2);
	if(!$check_admin){
		echo "ERROR: !!!!!";
		exit;
	}
	else{
		if(mysqli_num_rows($check_admin) > 0){
			$check_pass = mysqli_query($conn, $sql1);
			if(mysqli_num_rows($check_pass) == 1){
				echo "<div class='success'>Login Successfull !</div>";
				$dict1 = mysqli_fetch_assoc($check_pass);
			
				$_SESSION["Admin_ID"] = $dict1["Admin_ID"];
				$_SESSION["Hosp_ID"] = $dict1["Hosp_ID"];
				
				$sql3 = "Select * from blood_bank Where Hosp_ID = " . $_SESSION["Hosp_ID"] . "";
				$result_blood_bank_id = mysqli_query($conn, $sql3);
				if($result_blood_bank_id){
					$row = mysqli_fetch_assoc($result_blood_bank_id);
					$_SESSION["Blood_Bank_ID"] = $row["Blood_Bank_ID"];
				}
				# Redirect the user Here into main page;
				?>
				<script type="text/javascript">window.location="main_page.php";</script>
				<?php
				exit;
			}
			else{
				echo "<div class='danger'>$Password_Error</div>";
				exit;
			}
		}
		else{
			$rows = mysqli_num_rows($check_admin);
			echo "<div class='danger'>$Email_Error</div>";
			exit;
		}
		
	}
	header("Location: main_page.php");
?>
