<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '348406981918786', // App ID
			channelUrl : '//www.smuff.ro/facebook-channel-url.html', // Channel File
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});
		
		// Additional initialization code here
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				//alert('connected');
			} else if (response.status === 'not_authorized') {
				// the user is logged in to Facebook, 
				// but has not authenticated your app
				//alert('not authorized');
			} else {
				// the user isn't logged in to Facebook.
				//alert('not logged in to facebook');
			}
		 });
		
	};
	// Load the SDK Asynchronously
	(function(d){
		 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = "//connect.facebook.net/en_US/all.js";
		 ref.parentNode.insertBefore(js, ref);
	 }(document));
</script>