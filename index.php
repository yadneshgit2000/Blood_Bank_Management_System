<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/1.jpg">	
        <title>BBMS</title>
        <style>   
            *{ 
                padding:0px;
                margin:0px;
            }  
            body{
                background-size: cover;
                background:  linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(img/2.jpg) no-repeat center center fixed;
                -webkit-background-size:cover;
                -moz-background-size:cover;
                -o-background-size:cover;
            }
            .modal, .modal2{
                position:absolute;
                z-index:2;
				top:0;
				width:100%;
				height:100%;
				background-color:rgba(0,0,0,0.5);
				display:flex;
				align-items:center;
				justify-content:center;
				display:none;
			}
			.modal-content, .modal2-content{
				text-align:center;
				width:500px;
				background-color:white;
				border-radius:10px;
				padding:20px;
				position:relative;
			}
			.close{
				font-weight:bold;
				font-size:40px;
				position:absolute;
				top:0px;
				right:10px;
				transform:rotate(45deg);
				cursor:pointer;
			}
			.close:hover{
				color:blue;
			}
            .headline{
                font-size:20px;
                font-family:arial;
				font-weight:bold;
            }
            
            nav{
                background-color:black;
                border-bottom:yellow 2px solid;
                color:white;
                justify-content: right;
                padding:5px;
                overflow: hidden;
            }
            .logo{
                float:left;
                font-size:18px;
                margin:15px 3%;
                padding:5px;
                color:gold;
                font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            }
            nav img{
                float : left;
                width: 80px;
                height:76px;
                background-color: black;
            }
            ul{
                margin-left:70%;
                margin-top:15px;
                padding:5px;
                height:35px;
            }
            li{
                float:left;
                padding:8px;
                margin-right:10px;
                font-family:Arial, Helvetica, sans-serif;
                font-weight:bold;
                font-size:16px;
                border-radius:2px;
                background-color:purple ;
            }
            li:hover, a:hover{
                background-color:gold;
                color:black;
            }
            a{
                color:white;
                text-decoration:none;
            }

            .container{
            width: 95%;
            font-family:Calibri;
            margin:80px auto;
            display: flex;
            flex-wrap:wrap;
            padding: 5px;
            justify-content: center;
            flex-direction: row;
            }

            .box{
            min-width: 270px;
            max-width: 300px; 
            flex:1;
            height:450px;
            padding: 10px;
            margin:10px 10px;
            background:#fff;
            overflow: hidden;
            border-radius: 20px;
            text-align: center;
            }

            .container .box:nth-child(1){
            background: linear-gradient(45deg,#036eb7,#64eaff);
            }
            .container .box:nth-child(2){
            background: linear-gradient(45deg,#E91E63,#edff55);
            }
            .container .box:nth-child(3){
            background: linear-gradient(45deg,#086d35,#00ff72);
            }
            .container .box:nth-child(4){
            background: linear-gradient(45deg,#f05a4f,#f4c030);
            }

            .container h2{
            position: relative;
            margin: 0;
            padding: 0;
            font-size: 40px;
            color: #fff;
            z-index: 1;
            opacity: 0.4;
            }

            .container h3{
            position: relative;
            margin: 0;
            padding: 0;
            font-size: 20px;
            color: #fff;
            text-transform: uppercase;
            }

            .container p{
            position: relative;
            margin: 0;
            padding: 0;
            font-size: 18px;
            color: #fff;
            }            
            .main{
                width:85%;
                margin:50px auto;
                color:white;
                font-family:arial;
                font-size:32px;
                text-align:center;
            }
            button{
				padding:10px;
				font-weight:bold;
				color:white;
				border-radius:7px;
				font-size:20px;
				margin-top:16px;
                background-color:green;
                width:120px;
            } 
            button:hover{
                cursor:pointer;
                background-color:gold;
                color:black;
            }     
            .active{
                background-color:gold;
                color:black;
            }      
            #signupform .input, #loginform .input{
                height:20px;
                width:90%;
                border-radius:3px;
                border:gray 2px solid;
                margin:3.8px auto;
                padding:5px;
            }
            #signupform .form_btn, #loginform .form_btn{
                padding:10px;
                border-radius:5px;
                margin:10px auto;
                font-weight:bold;
                font-size:16px;
                color:white;
                background-color: green;
            }
            select{
                height:25px;
                width:93%;
                border-radius:3px;
                border:gray 2px solid;
                margin:3.8px auto;
            }
            .danger{
            	border:red 2px solid;
            	color:Red;
            	font-weight:bold;
            	padding:8px;
            	border-radius:5px;
            	margin:auto auto;
            	width:90%;
            }
            .success{
            	border:green 2px solid;
            	color:green;
    		    margin:auto auto;
            	font-weight:bold;
            	padding:8px;
            	border-radius:5px;
            	width:90%;
            }
            select{
                color:White;
                font-family:calibri;
                font-size:17.1px;
                font-weight:bold;
                background-color:gray;
            }
            .copyrights{
                color:white;
                font-weight:bold;
                background: linear-gradient(45deg,#E91E63,#edff55);
                padding:15px;
                font-size:24px;
                font-family:Calibri;
                text-align:center;
            }
        </style>
        
    </head>
    <body>
    		<nav>
                <img src="img/3.jpg">
                <div class="logo">   
                    <h2>LifeSourceGroup</h2>
                </div>
                <ul type="none">
                    <li class="active">Home</li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav> 
            <div class="main">
                <h1>BLOOD BANK MANAGEMENT SYSTEM</h1>
                <p>
                    <button id="signup_btn">Register</button>
                    <button id="login_btn">Login</button>
                </p>
            </div>
            <div class="container">
                    <div class="box">
                      <h2>1</h2>
                      <br>
                      <h3>What is BBMS?</h3>
                      <br>
                      <p>Blood Bank Management System (BBMS) is a web based system that can assists the information of blood bag during
                         its handling in the blood bank. With this system, the user of this system can key in the result of blood test 
                         that has been conducted to each of the blood bag received by the blood bank.</p>
                    </div>
                    <div class="box">
                      <h2>2</h2>
                      <br>
                      <h3>Procedure for donating blood.</h3>
                      <br>
                      <p>Donor fills up the registration form and gives his consent for donation.</p>
                      <br>
                      <p>1. Medical Check up (5 Mins) Donors Medical History & life style is asked, check up of temperature, blood pressure, pulse and haemoglobin.</p>
                      <br>
                      <p>2 . Donation (8 Mins) Phlebotomist draws unit (350ml/450ml) of blood. </p>
                      <br>
                      <p> 3. Refreshment (10 Mins)</p>
                    </div>
                    <div class="box">
                      <h2>3</h2>
                      <br> 
                      <h3>Who Cannot donate blood?</h3>
                      <br>
                      <h3>Persons with the following conditions are not allowed to donate blood anytime:</h3>
                      <br>
                      <p>Cardiac disease</p>
                      <br>
                      <p>Cancer</p>
                      <br>
                      <p>Hepatitis B and C</p>
                      <br>
                      <p>Chronic alcoholism.</p>
                      <br>
                      <p>Sever lung disease.</p>
                      <br>
                      <p>HIV infection and STD</p>
                    </div>
                    <div class="box"> 
                      <h2>4</h2>
                      <br>
                      <h3>information</h3>
                      <br>
                      <p>You have to register or login for donating blood</p>   
                      <br>
                      <p>Normal citizen can only register for donation of blood. 
                        We will provide you information of your nearest hospitals where you can donate your blood</p>
                      <br> 
                      <p>Only administrator of hospitals have authority for accesing this website for request of blood bags.</p>       
                    </div>
                </div>
            <div class="modal">
                    <div class="modal-content">
                        <div class="close" id="closebtn">+</div>
                    <div class="headline">
                            SignUp Today !
                        </div>
                        <br>
                        <hr><br>
                        <div class="fetched">
                        </div>
                        <br>
                        <form method="POST" id="signupform"> 
                            <input class="input" type="text" name="username" placeholder="Enter Name" required><br>
                            <select name="hosp_id" required>
                            <option value= "0"> --- Select Hospital --- </option>
                            <?php 
                                    include("connection.php");
                                    $sql = "Select * from Hospital";
                                    $result = mysqli_query($conn, $sql);
                                    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach($items as $item)
                                    {
                                        $Hosp_ID = $item["Hosp_ID"];
                                        $Hosp_Name = $item["Hosp_Name"];
                                        
                                        echo "<option value='$Hosp_ID'> $Hosp_Name </option>";
                        
                                    }
                            ?>
                            </select>
                            <input class="input" type="number" name="admin_id" placeholder="Admin_id" required><br>
                            <input class="input" type="email" name="email" placeholder="Email" required><br>
                            <input class="input" type="number" name="contact" placeholder="Contact" required><br>
                            <input class="input" type="password" name="password1" placeholder="Enter password" required><br>
                            <input class="input" type="password" name="password2" placeholder="Confirm password" required><br>
                            
                            <input class="form_btn" type="submit" value="Register">
                        </form>
                    </div>
                </div>
                <div class="modal2">
                    <div class="modal2-content">
                        <div class="close" id="closebtn2">+</div>
                        <div class="headline">
                            Login Today !
                        </div> 
                        <br><hr><br>
                        <div class="fetched2">
                        </div>
                        <br>
                        <form method="POST" id="loginform"> 
                            <p><input class="input" type="email" name="email" placeholder="Enter Email" required /></p>
                            <p><input class="input" type="password" name="password" placeholder="Enter Password" required /></p>
                            
                            <input class="form_btn" type="submit" value="Login">
                        </form>
                    </div>
                </div> 
                <div class="copyrights">Copyrights &copy <?php $today = date("Y"); echo $today; ?> LifeSourceGroup , all rights reserved.</div>
        <script src="js/jquery.min.js"></script>
        <script src="index.js"></script>  
        <script>
            document.getElementById("signup_btn").addEventListener("click", function() {
				document.querySelector(".modal").style.display="flex";
			});
			document.getElementById("login_btn").addEventListener("click", function() {
				document.querySelector(".modal2").style.display="flex";
			});			
			document.querySelector(".close").addEventListener("click", function() {
				document.querySelector(".modal").style.display="none";
			});
			document.querySelector("#closebtn2").addEventListener("click", function() {
				document.querySelector(".modal2").style.display="none";
			});
        </script>
    </body>
</html>
