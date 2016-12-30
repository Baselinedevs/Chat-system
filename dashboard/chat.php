<?php
include '../config.php';
/* echo "<pre>";
print_r($_SESSION);
echo "</pre>";
die(); */
include('header.php');
?>
<script type="text/javascript">

    	
    	// display name on page
    	$("#zone").html("You are: <span>" + name + "</span>");
    	
    	// kick off chat
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 
    		 
			 
    		 // watch textarea for key presses
          


			 $("#messagebox").keydown(function(event) {  

				
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                  
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key press
    		 $('#messagebox').keyup(function(e) {	
    		 	var str = document.getElementById("id").value;			
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
    			        chat.send(text, str);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    				
    			  }
             });
            
    	});
    </script>
<body onload="setInterval('chat.update()', 1000)">

<?php include 'side_menu.php';?>
<div id="page-wrapper">
        <div class="container-fluid">

			<div class="col-md-12" id= "info">
				<h1 class="page-header21">
					<small><?php echo $_SESSION['msgname'];?></small>
				</h1>		
			</div>
           	<div class="row" id="Row">			
						
						<div class="col-lg-12">
							<h1 class="page-header1">
								<small> Message</small>
							</h1>		
						</div>
			</div>
			
			<div class="col-md-12" id= "zone">
						
					<!-- /.row -->
					
							<div class="row">
								<div class="col-md-12 sect" id = "chat_zone">
	
								</div>
								<form id="send-message-zone">
										 <input type="hidden" name="sub_id" id="id" value='<?php echo $_SESSION['mesgid'];?>'>
										<textarea class="textarea" id="messagebox" maxlength="300" placeholder="Type here!"></textarea><div class="emojis" ></div>
									</form>	

							
				
							</div>
							
						
					
					</div>
		</div>	
</div>
	
<?php
include('footer.php');
?>