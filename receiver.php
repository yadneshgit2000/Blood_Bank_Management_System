<?php
    session_start();
    if(!isset($_SESSION["Admin_ID"])){
		header("location:index.php");
	}
    include("connection.php");

    $Blood_Grp_Error = "<p>Please Select Blood Group!</p>";
    $Qty_Error = "<p>Please Select Quantity!</p>";
    $Stock_Error = "<p>WARNING !! <br>The Lowest Limit is Reached, Stock is unavailable <br>Receiver is Not Registered!</p>";
    $Contact_Error = "<p>Please Enter Valid Contact of 10 digits</p>";

    $Recv_Name = filter_var($_POST["Recv_Name"], FILTER_SANITIZE_STRING);
    $Recv_Contact = filter_var($_POST["Recv_Contact"], FILTER_SANITIZE_NUMBER_INT);
    $Recv_Blood_Grp = filter_var($_POST["Recv_Blood_Grp"], FILTER_SANITIZE_STRING);
    $Qty = filter_var($_POST["Qty"], FILTER_SANITIZE_NUMBER_INT);

    $errors = "";
    $Recv_Blood_Grp = mysqli_real_escape_string($conn, $Recv_Blood_Grp);
    $Qty = mysqli_real_escape_string($conn, $Qty);

    $sql1 = "SELECT * FROM info WHERE Blood_Grp = '$Recv_Blood_Grp' AND Blood_Bank_ID = " . $_SESSION["Blood_Bank_ID"] . " AND Stock > $Qty + 50";

    if($Recv_Blood_Grp == "None" || $Qty == "0" || strlen((string)$Recv_Contact) != 10){
        if($Recv_Blood_Grp == "None"){
            $errors .= $Blood_Grp_Error;
        }
        if($Qty == "0"){
            $errors .= $Qty_Error;
        }
        if(strlen((string)$Recv_Contact) != 10){
            $errors .=  $Contact_Error;
        }
    }
    else{
            $result1 = mysqli_query($conn, $sql1);
            if(!$result1){
                echo "ERROR:";
                exit;
            }
            else{
                if(mysqli_num_rows($result1) == 0){
                    $errors .= $Stock_Error ;
                }
                else{
                    $Recv_Name = mysqli_real_escape_string($conn, $Recv_Name);
                    $Recv_Contact = mysqli_real_escape_string($conn, $Recv_Contact);
        
                    $sql_insert = "INSERT INTO receiver(Recv_Name, Recv_Contact, Recv_Blood_Grp, Qty, Admin_ID, Blood_Bank_ID, date) VALUES('$Recv_Name', '$Recv_Contact', '$Recv_Blood_Grp', '$Qty', " . $_SESSION["Admin_ID"] . "," . $_SESSION["Blood_Bank_ID"] . ", CURDATE())";
                    $result_insert = mysqli_query($conn, $sql_insert);
                    if(!$result_insert){
                        echo "ERROR :";
                        exit;
                    }
                    else{    
                        # Insert Receiver
                        echo "<div class='success'>Receiver is Registered Successfully !</div>";					
                        
                        # Redirect to main_page location
                        ?>
                        <script>setTimeout(() => {
                            window.location="main_page.php";
                        }, 800);</script>
                        <?php
                        exit;
                    }
                }
            }    
    }
    echo "<div class='danger'>$errors</div>";
?>