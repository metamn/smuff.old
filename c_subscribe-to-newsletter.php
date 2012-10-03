<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '348406981918786', // App ID
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});
		
		// listen for and handle auth.statusChange events
		FB.Event.subscribe('auth.statusChange', function(response) {
			if (response.authResponse) {
				// user has auth'd your app and is logged into Facebook
				FB.api('/me', function(me){
					if (me.name) {
						document.getElementById('auth-displayname').innerHTML = me.name;
					}
				})
				document.getElementById('auth-loggedout').style.display = 'none';
				document.getElementById('auth-loggedin').style.display = 'block';
			} else {
				// user has not auth'd your app, or is not logged into Facebook
				document.getElementById('auth-loggedout').style.display = 'block';
				document.getElementById('auth-loggedin').style.display = 'none';
			}
		});
		
		// listen for and handle auth.login events
		FB.Event.subscribe('auth.login', function(response) {
			if (response.authResponse) {
				// user logs ins
				FB.api('/me', function(me) {
					if (me.email) {
						alert(me.email);
					} else {
						alert('no email');
					}
				});
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

<div id="subscribe-newsletter" class="campaign-box">
  <div class="arrow-right"></div>
  <div id="text">
    <h4>
      Inscrie-te la newsletter si ai o <strong>livrare gratuita!</strong>
    </h4>
    <?php include 'mailchimp.php'; ?>  
    <a id="whatis" href="http://www.smuff.ro/despre-noi/inscriere-la-newsletter/" title="Newsletterul Smuff">Ce este?</a>  
  </div>
  <div id="facebook-connect">  	
		<div id="auth-loggedout">
			<h4>Sau</h4>
			<div class="fb-login-button" scope="email,user_birthday">Conectare cu Facebook</div>
		</div>
		<div id="auth-loggedin" style="display:none">
			<strong><span id="auth-displayname"></span></strong>, deja esti conectat cu Smuff prin Facebook.
		</div>
  </div>
</div>

