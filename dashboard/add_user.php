<?php
include('../config.php');
$var = 2;
if(isset($_POST['search'])){
 $var = 3;
	$username = $_POST['username']; 
	$result = $db_obj-> select_user($table_reg,$username); 
}
if(isset($_POST['addfriend'])){
		$check = $db_obj->select_friend($table_pm,$_POST['sub_id'],$_SESSION['userid']);
			if (empty($check)){
				$fields_array = array('user1','user2');
			$fields_value = array($_SESSION['userid'],$_POST['sub_id'],);
			$result = $db_obj->insert($table_pm,$fields_array,$fields_value);
			$fields_value2 = array($_POST['sub_id'],$_SESSION['userid']);
			$result2 = $db_obj->insert($table_pm,$fields_array,$fields_value2);
			if($result && $result2 == "1"){
				header("Location:message.php"); 
			}
			else{
				$message = "Not Inserted";
			}
		}else{
			echo "This person is already added in your friend list";
			die();
		}
		
		
}

/* $result = $db_obj->select_all($table_reg);  */
include('header.php');
?>
<body>
<?php include('side_menu.php'); ?>
<div id="page-wrapper">
					
				<div class="container-fluid">
					<!-- Page Heading -->
					<form name="search" action = "" method = "POST">
								<div class="input-group custom-search-form">
									<input type="text" name="username" class="form-control" placeholder="Search New Friends">
								
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit" name="search">
												<i class="fa fa-search"></i>
											</button>
											<?php echo $message; ?>
										</span>
								</div>
							<form>
				
					<div class="row">			
						
						<div class="col-lg-12">
							<h1 class="page-header1">
								<small> Add new friends</small>
							</h1>
							</h1>
							<ol class="breadcrumb">
							
								<li class="active dfggd">
									Select following friend that you want to add in you friend list
								</li>
							</ol>
						</div>
					</div>
						<?php  if($var == "3"){ ?>
					<div class="col-md-12 ">
						
					<!-- /.row -->
					
							<div class="row">
								<?php 
									if($result){
										
									}else{
										echo "user is not present in the app";
									}
									foreach($result as $row){
										if($row['id']== $_SESSION['userid']){

										}else{
								?>
								<div class="col-md-5 sect">
								<form action="" method="POST" enctype="multipart/form-data" id='account_select_form'>
									 <div class="account-box__img-icon">
										  <img alt="Facebook Page" class="img_cs" src="img/user.png">  
										</div>
										<div class="account-box__name">
												<input type="hidden" name="sub_id" id="sub_accounts__uid" value='<?php echo $row['id']?>'>
											   <p class="account_name">
													<?php echo $row['username'];?></p>
										 </div>
										<input type="submit" name="addfriend" value="Add Friend" class="btn submit_btn">
								
								</form>
								</div>
							
							 <?php 
								 }
									 }
							?>
							</div>
							
						
					
					</div>
					<?php } ?>
					
				</div>
				<!-- /.container-fluid -->
			</div>
	
<?php
include('footer.php');
?>