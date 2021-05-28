<?php
    session_start();
    if(!isset($_SESSION["Admin_ID"])){
		header("location:index.php");
	}
    include("connection.php");

    $Contact_Error = "<p>Please Enter Valid Contact!</p>";
    $Email_Error = "<p>Please Enter Valid Email!</p>";

    $Missing_Name = "<p>Please Enter Name!</p>";
    $Missing_Contact = "<p>Please Enter Contact!</p>";
    $Missing_email = "<p>Please Enter Email</p>";

    $errors = "";
    # Check Admin_Name

    if(empty($_POST["Admin_Name"])){
        $errors .= $Missing_Name; 
    }
    else{
        $Admin_Name = filter_var($_POST["Admin_Name"], FILTER_SANITIZE_STRING);
    }
    
    # Check Admin_Contact

    if(empty($_POST["Admin_Contact"])){
        $errors .= $Missing_Contact; 
    }
    else{
        $Admin_Contact = filter_var($_POST["Admin_Contact"], FILTER_SANITIZE_NUMBER_INT);
        if(strlen((string)$Admin_Contact) != 10){
            $errors .= $Contact_Error;
        }
    }

    # Check Admin_email

    if(empty($_POST["Admin_email"])){
        $errors .= $Missing_email; 
    }
    else{
        $Admin_email = filter_var($_POST["Admin_email"], FILTER_SANITIZE_EMAIL);
        if(!filter_var($_POST["Admin_email"], FILTER_VALIDATE_EMAIL)){
            $errors .= $Email_Error;
        }
    }
    if($errors){
        echo "<div class='danger'> $errors </div>";
    }
    else{
        $Admin_Name = mysqli_real_escape_string($conn, $Admin_Name);
        $Admin_Contact = mysqli_real_escape_string($conn, $Admin_Contact);
        $Admin_email = mysqli_real_escape_string($conn, $Admin_email);
        
        $sql_update = "UPDATE admin SET Admin_Name = '$Admin_Name' , Admin_Contact = '$Admin_Contact' , Admin_email = '$Admin_email' WHERE Admin_ID = " . $_SESSION["Admin_ID"] . "";
        $result_update = mysqli_query($conn, $sql_update);
        if(!$result_update){
            echo "ERROR";
            exit;
        }
        else{
            if(mysqli_affected_rows($conn) == 1){
                echo "<div class='success'> Profile Has Been Updated! </div>";
                ?>
                <script>setTimeout(() => {
                        window.location="view.php";
                        }, 800);
                </script>
                <?php
                exit;
            }
        }
    }
?>