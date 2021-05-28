<?php
    session_start();
    if(!isset($_SESSION["Admin_ID"])){
		header("location:index.php");
		exit;
	}
    include("connection.php");
	$sql_test = "SELECT * FROM admin WHERE Admin_ID = " .  $_SESSION["Admin_ID"] . "";
	$result_test = mysqli_query($conn, $sql_test);
	if(!$result_test){
		echo "ERROR : ";
	}
	else{
		if(mysqli_num_rows($result_test) == 1){
			$row = mysqli_fetch_assoc($result_test);
			$_SESSION["Admin_Name"] = $row["Admin_Name"];
			$_SESSION["Admin_Contact"] = $row["Admin_Contact"];
			$_SESSION["Admin_email"] = $row["Admin_email"];
		}
	}
?>
<html>
    <head>
        <title>View Profile : Blood Bank Status</title>
    
    
    <style>
           *{
                padding:0px;
                margin:0px;
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
        	.stylish{
				margin:10px auto;
				width:60%;
				border-collapse:collapse;
				font-family:calibri;
			}
			.stylish thead tr{
				color:white;
				background-color:#009879;
				font-family:calibri;
				text-align:left;
			}
			.stylish thead th, .stylish td{
				padding:10px 20px;
				font-weight:bold;
			}
			.stylish tbody tr{
				border-bottom:#dddddd 1px solid;
			}
			.stylish tbody tr:last-of-type{
				border-bottom: #009879 2px solid;
			}
			.stylish tbody .add{
				background-color:lightgreen;
			}
			.stylish tbody .sub{
				
			}
			.info{
				text-align:center;
				margin:10px auto;
				padding:10px;
				font-family:calibri;
				font-weight:bold;
				font-size:26px;
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
			.danger{
				border:red 2px solid;
            	color:red;
    		    margin:auto auto;
            	font-weight:bold;
            	padding:8px;
            	border-radius:5px;
            	width:90%;
			}



			input{
				padding:5px;
				font-weight:bold;
				font-family:calibri;
				font-size:16px;
			}
			.controls input{
				width:140px;
				padding:5px;
				margin:10px 25px;
				font-weight:bold;
				font-family:calibri;
				font-size:16px;
			}
			button:hover{
				cursor:pointer;
			}
			.controls{
				display:flex;
				justify-content:center;
			}
			.msg{
				text-align:center;
				margin:15px auto;
				min-width:200px;
				max-width:600px;
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
    </nav>             

    <div class="info">
        <?php
            $get_hosp = "SELECT * FROM Hospital Where Hosp_ID = " . $_SESSION["Hosp_ID"] ."";
            $res = mysqli_query($conn, $get_hosp);
            if($res){
                $row = mysqli_fetch_assoc($res);
                echo "<h3>" . $row["Hosp_Name"] . "</h3>";
                echo "<p><h6>" . $row["Hosp_Addr"] . "</h6></p>";
            }
        ?>
    </div>
    <hr>
    <div class="info">Blood Stock Status</div>

		<table class="stylish">
			<thead>
				<tr>
					<th>Blood Group</th>
					<th>Blood Stock (in ml)</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql1 = "SELECT * FROM info WHERE Blood_Bank_ID = " . $_SESSION['Blood_Bank_ID'] . "";

				$result1 = mysqli_query($conn, $sql1);
				if(!$result1){
					echo "ERROR : Currently";
					exit;
				}
				$recv_items = mysqli_fetch_all($result1, MYSQLI_ASSOC);
				foreach($recv_items as $recv_item) {?>
					<tr>
						<td><?php echo $recv_item["Blood_Grp"];?></td>
						<td class="sub"><?php echo $recv_item["Stock"];?></td>
					</tr>
				<?php
				} ?>
			</tbody>
		</table>
	
	<br><hr><br>
    <div class="info">Hello <?php echo $_SESSION["Admin_Name"] ?>, Welcome to your Profile</div>
    
    <div class="profile">
		<div class="msg"></div>
        <table class="stylish">
			<thead>
				<tr>
					<th>Field</th>
					<th>Value</th>
					
				</tr>
			</thead>
			<tbody>
				<form method="POST" id="profile_update">
				<tr>
						<td>Name</td>
						<?php
							echo "<td class='sub'><input id='name' type='text' name='Admin_Name' readonly='readonly' value = ". $_SESSION['Admin_Name'] . "></td>";
						?>
                </tr>
				<tr>
						<td>Email</td>
						<?php
							echo "<td class='sub'><input id='email' type='email' name='Admin_email' readonly='readonly' value = ". $_SESSION['Admin_email'] . "></td>";
						?>
                </tr>
				<tr>
						<td>Contact</td>
						<?php
							echo "<td class='sub'><input id='contact' type='number' name='Admin_Contact' readonly='readonly' value = ". $_SESSION['Admin_Contact'] . "></td>";
						?>				    	
                </tr>
				<tr>
						<td>Admin_ID</td>
						<td class='sub'><?php echo $_SESSION["Admin_ID"];?></td>
									    	
                </tr>
                <tr>
						<td>Hospital Name</td>
						<td class='sub'><?php echo $row["Hosp_Name"];?></td>				    	
				</tr>			
				</form>  

			</tbody>
		</table>
		<div class="controls">
					<input type="button" id="edit" value="Edit"><br><br>
					<input id="commit" type="submit" form="profile_update" value="Save Changes">
		</div>
	</div>
	<div class="copyrights">Copyrights &copy <?php $today = date("Y"); echo $today; ?> LifeSourceGroup , all rights reserved.</div>
			<script src="js/jquery.min.js"></script>
			<script src="control_menu.js"></script> 
			<script>
				document.getElementById("edit").onclick=function(){
					document.getElementById("name").removeAttribute('readonly');
					document.getElementById("email").removeAttribute('readonly');
					document.getElementById("contact").removeAttribute('readonly');
				};	
                document.getElementById("commit").onclick=function(){
                    document.getElementById("name").readOnly=true;
                    document.getElementById("email").readOnly=true;
                    document.getElementById("contact").readOnly=true;
                };										
			</script>
    </body>
</html>
