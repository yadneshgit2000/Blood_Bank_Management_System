<?php
    $conn = mysqli_connect("localhost", "root", "#mysqldatabase@27", "bbms");
    if(mysqli_connect_error()){
        die("ERROR : Unable to connect:" . mysqli_connect_error());
    } 
?>
