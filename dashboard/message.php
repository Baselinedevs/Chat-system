<?php
include('../config.php');
if(isset($_POST['MESSAGE'])){
	if($_POST['sub_id'] != ""){
		$_SESSION["mesgid"] = $_POST['sub_id'];
		$_SESSION["msgname"] = $_POST['msgname'];
		header("Location:chat.php");
	}

}
$userid = $_SESSION['userid'];
$check = $db_obj->select_friend_msg($table_pm,$userid);
$array = array();
foreach($check as $id){
	$mid = array("id"=>$id['user2']);
	array_push($array,$mid);
}
include('header.php');
?>
<body>
<?php include('side_menu.php'); ?>

<div id="page-wrapper">
        <div class="container-fluid">

           	<div class="row">			
						
						<div class="col-lg-12">
							<h1 class="page-header1">
								<small> Message friends</small>
							</h1>
							</h1>
							<ol class="breadcrumb">
								<li class="active dfggd">
									Select an friend to start conversation
								</li>
							</ol>
						</div>
			</div>
			
			<div class="col-md-12 ">
						
					<!-- /.row -->
					
							<div class="row">
								<?php 
									foreach($array as $row){
										$id = $row['id'];
										$result = $db_obj->select_message_frnd($table_reg,$id);
										/* echo "<pre>";
										print_r($result);
										echo "</pre>"; */
								?>
								<div class="col-md-5 sect">
								<form action="" method="POST" enctype="multipart/form-data" id='account_select_form'>
									 <div class="account-box__img-icon">
										  <img alt="Facebook Page" class="img_cs" src="img/user.png">  
										</div>
										<div class="account-box__name">
												<input type="hidden" name="sub_id" id="sub_accounts__uid" value='<?php echo $result[0]['id'];?>'>
												<input type="hidden" name="msgname" id="sub_accounts__uid" value='<?php echo $result[0]['username'];?>'>
											   <p class="account_name">
													<?php echo $result[0]['username'];?></p>
										 </div>
										<input type="submit" name="MESSAGE" value="MESSAGE" class="btn submit_btn">
								
								</form>
								</div>
							
							 <?php 
								 }

							?>
							</div>
							
						
					
					</div>
		</div>	
</div>
	
<?php
include('footer.php');
?>