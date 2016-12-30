var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat(){
}

//Updates the chat
function updateChat(){
		  if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "post.php",
			   data: {  
			   			'function': 'update',
						'state': state,
						'file': file
						},
			   //dataType: "json",
			   success: function(data){
					//alert (JSON.stringify(data));
					
					document.getElementById("chat_zone").innerHTML = "";
					 $('#chat_zone').append($("<p>"+data+"</p>"));
					 instanse = false;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 } 
}

//send the message
function sendChat(message, str)
{
 $.ajax({
		   type: "POST",
		   url: "post.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': str,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
				//alert (JSON.stringify(data));
			   updateChat();
		   },
		});
   
}
