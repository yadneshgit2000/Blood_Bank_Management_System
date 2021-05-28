<?php
    session_start();
    if(!isset($_SESSION["Admin_ID"])){
		header("location:index.php");
	}
    include("connection.php");

    $Blood_Grp_Error = "<p>Please Select Blood Group!</p>";
    $Qty_Error = "<p>Please Select Quantity!</p>";
    $Contact_Error = "<p>Please Enter Valid Contact of 10 digits</p>";

    $Donor_Name = filter_var($_POST["Donor_Name"], FILTER_SANITIZE_STRING);
    $Donor_Contact = filter_var($_POST["Donor_Contact"], FILTER_SANITIZE_NUMBER_INT);
    $Donor_Blood_Grp = filter_var($_POST["Donor_Blood_Grp"], FILTER_SANITIZE_STRING);
    $Qty = filter_var($_POST["Qty"], FILTER_SANITIZE_NUMBER_INT);

    $errors = "";
    if($Donor_Blood_Grp == "None" || $Qty == "0"){
        if($Donor_Blood_Grp == "None"){
            $errors .= $Blood_Grp_Error;
        }
        if($Qty == "0"){
            $errors .= $Qty_Error;
        }
    }
    else{
        if(strlen((string)$Donor_Contact) != 10){
           $errors .=  $Contact_Error;
        }
        else{
            $Donor_Name = mysqli_real_escape_string($conn, $Donor_Name);
            $Donor_Contact = mysqli_real_escape_string($conn, $Donor_Contact);

            $sql_insert = "INSERT INTO donor(Donor_Name, Donor_Contact, Donor_Blood_Grp, Qty, Admin_ID, Blood_Bank_ID, date) VALUES('$Donor_Name', '$Donor_Contact', '$Donor_Blood_Grp', '$Qty', " . $_SESSION["Admin_ID"] . "," . $_SESSION["Blood_Bank_ID"] . ", CURDATE())";
            $result_insert = mysqli_query($conn, $sql_insert);
            if(!$result_insert){
                echo "ERROR :";
                exit;
            }
            else{
                # Insert Donor
                echo "<div class='success'>Donor is Registered Successfully !</div>";					
                
                # Redirect to main_page location
                ?>
                <script>setTimeout(() => {
                            window.location="main_page.php";
                        }, 800);
                </script>
                <?php
                exit;
            }
        }        
    }
    echo "<div class='danger'>$errors</div>";
?>