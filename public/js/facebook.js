window.fbAsyncInit = function() {
    FB.init({
      appId      : '834644693287300', // App ID
      channelUrl : 'https://localhost:8000/mychannels/edit-channe/connect.facebook.net/en_US/all.js"', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    FB.Event.subscribe('auth.authResponseChange', function(response) 
		{
	 	 if (response.status === 'connected') 
	  	{
	  		document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
	  	}else if (response.status === 'not_authorized') {
	    	document.getElementById("message").innerHTML +=  "<br>Failed to Connect";
    }else{
	    	document.getElementById("message").innerHTML +=  "<br>Logged Out";
	    }
		});	
};

function Login() {
	FB.login(function(response) {
		if(response.authResponse){
			userProfile();
		}else{
			console.log('User cancelled login or did not fully authorize.');
		}},{scope: 'email,user_photos,user_videos'});
		}

function userProfile() {
	FB.api('/me', function(response) {
				console.log(response);
				 var str="<b>Name</b> : "+response.name+"<br>";
  	  str +="<b>Link: </b>"+response.link+"<br>";
  	  str +="<b>Username:</b> "+response.username+"<br>";
  	  str +="<b>id: </b>"+response.id+"<br>";
  	  str +="<b>Email:</b> "+response.email+"<br>";
  	  str +="<input type='button' value='Get Photo' onclick='getPhoto();'/>";
  	  str +="<input type='button' value='Logout' onclick='Logout();'/>";
  	  document.getElementById("status").innerHTML=str;
			});
}

function Logout()
{
	FB.logout(function(){
		window.location.reload();
	});
}

