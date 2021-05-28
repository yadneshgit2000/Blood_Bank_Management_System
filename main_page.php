<?php
	session_start();
	if(!isset($_SESSION["Admin_ID"])){
		header("location:index.php");
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard : Life Source Group</title>
		
		<style>
			
			*{
				margin:0;
				padding:0;
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
		    nav .menu{
		        margin-left:40%;
		        margin-top:15px;
		        padding:5px;
		        height:35px;
		    }
		    nav button{
		        float:left;
		        padding:8px;
		        margin: 0px 10px;
		        font-family:Arial, Helvetica, sans-serif;
		        font-weight:bold;
		        font-size:16px;
				color:white;
		        border-radius:10px;
		        background-color:purple ;
		    }	
		    button:hover{
		        background-color:gold;
		        color:black;
				cursor:pointer;
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
				background-color:orange;
			}
			.info{
				text-align:center;
				margin:10px auto;
				padding:10px;
				font-family:calibri;
				font-weight:bold;
				font-size:26px;
			}
            #reg_donor .input, #reg_receiver .input{
                height:30px;
                width:90%;
                border-radius:3px;
                border:gray 2px solid;
                margin:3.8px auto;
                padding:5px;
            }
            #reg_donor .form_btn, #reg_receiver .form_btn{
                padding:10px;
                border-radius:5px;
                margin:10px auto;
                font-weight:bold;
                font-size:16px;
                color:white;
                background-color: green;
            }
            select{
                color:white;
                font-family:calibri;
                font-size:17.1px;
                font-weight:bold;
                background-color:gray;
				height:30px;
                width:90%;
                border-radius:3px;
				margin:8px auto 0px auto;
			}
			
		</style>
		
	</head>
	<body>
	<nav>
		        <img src="img/3.jpg">
		        <div class="logo">   
		            <h2>LifeSourceGroup</h2>
		        </div>
				<div class="menu">
					<button class="btn" id="donor_reg">Register Donor</button>
					<button class="btn" id="recv_reg">Register Reciever</button>
					<button onclick="view()">View Status</button>
					<button onclick="logout()">Logout</button>
				</div>
    </nav>
	
	<div class="info">Donor Transactions</div>
		<table class="stylish">
			<thead>
				<tr>
					<th>Donor Name</th>
					<th>Donor Contact</th>
					<th>Blood Group</th>
					<th>Quantity (in ml)</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<hr>
				<?php 
				include("connection.php");
				$sql1 = "SELECT * FROM donor WHERE Admin_ID = " . $_SESSION['Admin_ID'] . " ";

				$result = mysqli_query($conn, $sql1);
				if(!$result){
					echo "ERROR : Currently";
					echo "<div class='success'>Hello world</div>";
					exit;
				}
				$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
				foreach($items as $item) {?>
					<tr>
						<td><?php echo $item["Donor_Name"];?></td>
						<td><?php echo $item["Donor_Contact"];?></td>
						<td><?php echo $item["Donor_Blood_Grp"];?></td>
						<td class="add"><?php echo $item["Qty"];?></td>
						<td><?php echo $item["date"];?></td>
					</tr>
				<?php
				} ?>
			</tbody>
		</table>	

		<div class="info">Receiver Transactions</div>
		<hr>
		<table class="stylish">
			<thead>
				<tr>
					<th>Receiver Name</th>
					<th>Receiver Contact</th>
					<th>Blood Group</th>
					<th>Quantity (in ml)</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql2 = "SELECT * FROM receiver WHERE Admin_ID = " . $_SESSION['Admin_ID'] . " ";

				$result2 = mysqli_query($conn, $sql2);
				if(!$result2){
					echo "ERROR : Currently";
					echo "<div class='success'>Hello world</div>";
					exit;
				}
				$recv_items = mysqli_fetch_all($result2, MYSQLI_ASSOC);
				foreach($recv_items as $recv_item) {?>
					<tr>
						<td><?php echo $recv_item["Recv_Name"];?></td>
						<td><?php echo $recv_item["Recv_Contact"];?></td>
						<td><?php echo $recv_item["Recv_Blood_Grp"];?></td>
						<td class="sub"><?php echo $recv_item["Qty"];?></td>
						<td><?php echo $recv_item["date"];?></td>
					</tr>
				<?php
				} ?>
			</tbody>
		</table>

		<div class="modal">
                    <div class="modal-content">
                        <div class="close" id="closebtn">+</div>
                    <div class="headline">
                            Donor Registration
                        </div> 
                        <br>
                        <hr><br>
                        <div class="fetched">
                        </div>
                        <br>
                        <form method="POST" id="reg_donor"> 
                            <input class="input" type="text" name="Donor_Name" placeholder="Enter Name" required><br>
                            <input class="input" type="number" name="Donor_Contact" placeholder="Enter Contact" required><br>
							<select name="Donor_Blood_Grp">
								<option value="None">--- Choose Blood Group ---</option>
								<option value="A-pos">A-pos</option>
								<option value="A-neg">A-neg</option>
								<option value="B-pos">B-pos</option>
								<option value="B-neg">B-neg</option>
								<option value="AB-pos">AB-pos</option>
								<option value="AB-neg">AB-neg</option>
								<option value="O-pos">O-pos</option>
								<option value="O-neg">O-neg</option>
							</select required><br>
                            <select name="Qty">
								<option value="0">--- Quantity ---</option>
								<option value="50">50</option>
								<option value="100">100</option>
								<option value="150">150</option>
								<option value="200">200</option>
							</select required><br>
                            
                            <input class="form_btn" type="submit" value="Register">
                        </form>
                    </div>
                </div>

				<div class="modal2">
					<div class="modal2-content">
						<div class="close" id="closebtn2">+</div>
							<div class="headline">
								Receiver Registration
							</div> 
							<br><hr><br>
							<div class="fetched2"></div>
							<br>	
							<form method="POST" id="reg_receiver"> 
								<input class="input" type="text" name="Recv_Name" placeholder="Enter Name" required><br>
								<input class="input" type="number" name="Recv_Contact" placeholder="Enter Contact" required><br>
								<select name="Recv_Blood_Grp">
									<option value="None">--- Choose Blood Group ---</option>
									<option value="A-pos">A-pos</option>
									<option value="A-neg">A-neg</option>
									<option value="B-pos">B-pos</option>
									<option value="B-neg">B-neg</option>
									<option value="AB-pos">AB-pos</option>
									<option value="AB-neg">AB-neg</option>
									<option value="O-pos">O-pos</option>
									<option value="O-neg">O-neg</option>
								</select required><br>
								<select name="Qty">
									<option value="0">--- Quantity ---</option>
									<option value="50">50</option>
									<option value="100">100</option>
									<option value="150">150</option>
									<option value="200">200</option>
								</select required><br>
								<input class="form_btn" type="submit" value="Register">
                        	</form>
					</div>
				</div>
		<script src="js/jquery.min.js"></script>
		<script src="control_menu.js"></script> 
		<script>
			function logout(){
				var accepted = window.confirm("You sure you want to logout?");
				if(accepted == true){
					window.location="logout.php";
				}
			}
			function view(){
				window.location="view.php";
			}
    		document.getElementById("donor_reg").addEventListener("click", function() {
				document.querySelector(".modal").style.display="flex";			
			});
			document.querySelector(".close").addEventListener("click", function() {
				document.querySelector(".modal").style.display="none";
			});
			document.getElementById("recv_reg").addEventListener("click", function() {
				document.querySelector(".modal2").style.display="flex";
			});
			document.querySelector("#closebtn2").addEventListener("click", function() {
				document.querySelector(".modal2").style.display="none";
			});			
        </script>
	</body>
</html>
