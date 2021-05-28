<?php
	include("connection.php");
	
	$Hosp_Error = "<p>Please Select Hospital</p>";
	$Admin_Error = "<p>Unauthorised Admin ID !</p>";
	$Password_Error = "<p>Password Don't Match !</p>";
	$User_Exists = "<p>User Already Exists !</p>";
	$Invalid_Contact = "<p>Please Enter Valid contact (10 digits)</p>";

	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$hosp_id = filter_var($_POST["hosp_id"], FILTER_SANITIZE_NUMBER_INT);
	$admin_id = filter_var($_POST["admin_id"], FILTER_SANITIZE_NUMBER_INT);
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$contact = filter_var($_POST["contact"], FILTER_SANITIZE_NUMBER_INT);
	$password1 = filter_var($_POST["password1"], FILTER_SANITIZE_STRING);
	$password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
	
	$errors = "";

	$email = mysqli_real_escape_string($conn, $email);
	$username = mysqli_real_escape_string($conn, $username);
	
	$sql1 = "SELECT * from Admin where Admin_email = '$email' or Admin_contact = '$contact' or Admin_ID = '$admin_id'";
	$sql2 = "SELECT * from List where Hosp_ID = '$hosp_id' and Auth_Admin_ID = '$admin_id'";
	
	$check_user_exists = mysqli_query($conn, $sql1);
	if(!$check_user_exists){
		echo "ERROR :!!!!";
		exit;
	}
	if(mysqli_num_rows($check_user_exists) == 0){
	
		if($hosp_id != 0){
			$check_auth = mysqli_query($conn, $sql2);
			if(!$check_auth){
				echo "ERROR 2 :!!!!";
				exit;
			}
			else if(mysqli_num_rows($check_auth) == 1){
				if($password1 != $password2 || strlen((string)$contact) != 10){
					if(strlen((string)$contact) != 10){
						$errors .= $Invalid_Contact;
					}
					if($password1 != $password2){
						$errors .= $Password_Error;
					}
				}
				else {
					## Insert Query;				
					
					$password1 = hash('sha256', $password1);
					$password = mysqli_real_escape_string($conn, $password1);
					
					$sql_insert = "INSERT INTO admin values('$admin_id', '$username', '$password', '$contact', '$email', '$hosp_id')";
					$result_insert = mysqli_query($conn, $sql_insert);
					if(!$result_insert){
						echo "ERROR : ";
						exit;
					} 
					else{
						
						echo "<div class='success'>You are Registered Successfully !</div>";
						# redirect
						?>
						<script>setTimeout(() => {
									window.location="index.php";
								}, 1000);
						</script>
						<?php
						exit;
					}
				}
			
			}
			else{
				$errors .= $Admin_Error;
			}
		}
		else{
			$errors .= $Hosp_Error;
		}
	}
	else{
		$errors .= $User_Exists;
	}
	echo "<div class='danger'>$errors</div>";
	
?>
