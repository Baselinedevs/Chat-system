<?php
include('../config.php');				
	$function = $_POST['function'];
    $log = array();
    switch($function) {
    	 case('update'):
				$result7 = $db_obj->select_friend($table_pm,$_SESSION['userid'],$_SESSION['mesgid']);
					if($result7[0]['message']!=""){
							$resultjson = $result7[0]['message'];
							$array = json_decode($resultjson,true);
							if(empty($array[0])){
								if($array['message']['id'] == $_SESSION['userid']){
									echo '<ol class="chat">';
												$time = $array['message']['date'];
												$variable = date('Y/d/m H:i:s a', $time);
												$var = explode(" ",$variable);
											echo ' <li class="self">
												<div class="avatar"><img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
											  <div class="col-md-12 msg">
												<div class="selfdiv"><p><h1>'.$_SESSION['username'].'<h1></p>
												<p>'.$array['message']['mesg'].'</p></div>
												<time>'.$var[0].' '.$var[1].' '.$var[2].'</time>
												  </div>
											</li></ol>';
								}else{
									echo '<ol class="chat">';
									$time = $array['message']['date'];
									$variable = date('Y/d/m H:i:s a', $time);
									$var = explode(" ",$variable);
									 echo '<li class="other">
											<div class="avatar"><img src="http://i.imgur.com/HYcn9xO.png" draggable="false"/></div>
											<div class="col-md-12 msg">
											<div class="other-time" ><time>'.$var[0].' '.$var[1].' '.$var[2].'</time></div>
											<div class="othdiv"><p><h1>'. $_SESSION['msgname'].'<h1></p>
											<p>'.$array['message']['mesg'].'</p></div>	
											</div>
											</li></ol>';
								}
							}else{
								foreach($array as $row){
									foreach($row as $data){
											echo '<ol class="chat">';
											if($data['id']==$_SESSION['userid']){
												$time = $data['date'];
												$variable = date('Y/d/m H:i:s a', $time);
												$var = explode(" ",$variable);
											echo ' <li class="self">
												<div class="avatar"><img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
											  <div class="col-md-12 msg">
												<div class="selfdiv"><p><h1>'.$_SESSION['username'].'<h1></p>
												<p>'.$data['mesg'].'</p></div>
												<time>'.$var[0].' '.$var[1].' '.$var[2].'</time>
												  </div>
											</li>';
											}else{
												$time = $data['date'];
												$variable = date('Y/d/m H:i:s a', $time);
												$var = explode(" ",$variable);
											 echo '<li class="other">
													<div class="avatar"><img src="http://i.imgur.com/HYcn9xO.png" draggable="false"/></div>
												  <div class="col-md-12 msg">
												  <div class="other-time" ><time>'.$var[0].' '.$var[1].' '.$var[2].'</time></div>
													<div class="othdiv"><p><h1>'. $_SESSION['msgname'].'<h1></p>
													<p>'.$data['mesg'].'</p></div>
													
												  </div>
											</li>';

											}
											echo '</ol>';
									}
								}
							}
							} 
					
             break;
    	 
    	 case('send'):
		 			$result7 = $db_obj->select_friend($table_pm,$_SESSION['userid'],$_SESSION['mesgid']);
					if($result7[0]['message']!=""){
							$resultjson = $result7[0]['message'];
							$array = json_decode($resultjson,true);
							$arraydata=array();
							if(empty($array[0])){
								foreach($array as $row){
									$date=$row['date'];
									$id1 = $row['id'];
									$message = $row['mesg'];
									$coll = array("date"=>$date,"id"=>$id1,"mesg"=>$message);
									$main = array("message"=>$coll);
									array_push($arraydata,$main);
									unset($coll);
									unset($main);
								}
								$date2 = time();;
								$msg2 = $_POST['message'];
								$message2=preg_replace("@\n@","",$msg2);
								$id2 = $_SESSION['userid'];
								$coll2 = array("date"=>$date2,"id"=>$id2,"mesg"=>$message2);
								$main2 = array("message"=>$coll2);
								array_push($arraydata,$main2);
								$arr = json_encode($arraydata, true);
								$result = $db_obj->update_account_table($table_pm,$arr,$_SESSION['userid'],$_SESSION['mesgid']);
								$result2 = $db_obj->update_account_table($table_pm,$arr,$_SESSION['mesgid'],$_SESSION['userid']);		
								
							}else{
								$date = time();;
								$msg = $_POST['message'];
								$message=preg_replace("@\n@","",$msg);
								$id3 = $_SESSION['userid'];
								$mid = array("date"=>$date,"id"=>$id3,"mesg"=>$message);
								$mid2 = array("message"=>$mid);
								array_push($array,$mid2);
								$arr = json_encode($array, true);
								$result = $db_obj->update_account_table($table_pm,$arr,$_SESSION['userid'],$_SESSION['mesgid']);
								$result2 = $db_obj->update_account_table($table_pm,$arr,$_SESSION['mesgid'],$_SESSION['userid']);
									
							} 
					}else{
						$msg=$_POST['message'];
						$message=preg_replace("@\n@","",$msg);
						$date = time();
						$id4 = $_SESSION['userid'];
						$array = array("date"=>$date,"id"=>$id4,"mesg"=>$message);
						$array2 = array("message"=>$array);
						$arr = json_encode($array2, true);
						$result = $db_obj->update_account_table($table_pm,$arr,$_SESSION['userid'],$_SESSION['mesgid']);
						$result2 = $db_obj->update_account_table($table_pm,$arr,$_SESSION['mesgid'],$_SESSION['userid']);
					}
        	 break;
    	
    }
   // echo json_encode($log);

?>