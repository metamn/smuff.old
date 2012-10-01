
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
  	<h4>Sau</h4>
  	<div id="fb-login-button" class="fb-login-button" scope="email">Conectare cu Facebook</div>
  </div>
</div>

<script>
document.getElementById('fb-login-button').onclick = function() {
  FB.login(function(response) {
    alert(response);
    if (response.status === 'connected') {
      alert('User is logged in');
    } else {
      alert('User is logged out');
    }
  });
};
</script>
