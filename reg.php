<?php
include'config.php';
if(isset($_POST['submit'])){
		$username= $_POST['username'];
		$password= md5($_POST['passid']);
		$address= $_POST['address'];
		$country= $_POST['country'];
		$zip= $_POST['zip'];
		$email= $_POST['email'];
		$gender= $_POST['gender'];
		$select=$db_obj->select_user($table_reg,$username);
		if($select){
			echo "user is present with this name please try with any other name";
		}else{
			$fields_array=array('username','password','address','country','zip','email','gender','status');
			$fields_value=array($username,$password,$address,$country,$zip,$email,$gender,'0');
			$result = $db_obj->insert($table_reg,$fields_array,$fields_value);
			if($result==1){
				echo "your sucess fully inserted";
			}else{
				echo "<pre>";
				print_r($result);
				echo "</pre>";
			}
		}	
		
	}

?><!DOCTYPE html>  
<html lang="en"><head>  
<meta charset="utf-8">  
<title>Registration form</title> 
<style>
h1 {  
margin-left: 70px;  
}  
form li {  
list-style: none;  
margin-bottom: 5px;  
}  
  
form ul li label{  
float: left;  
clear: left;  
width: 100px;  
text-align: right;  
margin-right: 10px;  
font-family:Verdana, Arial, Helvetica, sans-serif;  
font-size:14px;  
}  
  
form ul li input, select, span {  
float: left;  
margin-bottom: 10px;  
}  
  
form textarea {  
float: left;  
width: 350px;  
height: 150px;  
}  
  
[type="submit"] {  
clear: left;  
margin: 20px 0 0 230px;  
font-size:18px  
}  
  
p {  
margin-left: 70px;  
font-weight: bold;  
}  
</style> 
<meta name="keywords" content="example, JavaScript Form Validation, Sample registration form" />  
<meta name="description" content="This document is an example of JavaScript Form Validation using a sample registration form. " />  
<link rel='stylesheet' href='js-form-validation.css' type='text/css' />  
<script src="sample-registration-form-validation.js"></script>  
</head>  
<body onload="document.registration.userid.focus();">  
<h1>Registration Form</h1>  
<p>Use tab keys to move from one input field to the next.</p>  
<form name='registration' action='' method='POST'>  
<ul>   
<li><label for="username">User Name:</label></li>
<li><input type="text" name="username" size="50" /></li>  
<li><label for="passid">Password:</label></li>  
<li><input type="password" name="passid" size="12" /></li>    
<li><label for="address">Address:</label></li>  
<li><input type="text" name="address" size="50" /></li>  
<li><label for="country">Country:</label></li>  
<li><select name="country">  
<option selected="" value="Default">(Please select a country)</option>  
<option value="AF">Australia</option>  
<option value="AL">Canada</option>  
<option value="DZ">India</option>  
<option value="AS">Russia</option>  
<option value="AD">USA</option>  
</select></li>  
<li><label for="zip">ZIP Code:</label></li>  
<li><input type="text" name="zip" /></li>  
<li><label for="email">Email:</label></li>  
<li><input type="text" name="email" size="50" /></li>  
<li><label id="gender">Sex:</label></li>  
<li><input type="radio" name="gender" value="Male" /><span>Male</span></li>  
<li><input type="radio" name="gender" value="Female" /><span>Female</span></li>    
<li><input type="submit" name="submit" value="Submit" /></li>  
</ul>  
</form>  
</body>  
</html>  