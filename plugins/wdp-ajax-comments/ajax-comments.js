//WDP AJAX Comments
//Ajaxify WordPress Commenting - Web Developer Plus
//Visit Tutorial: http://webdeveloperplus.com/wordpress/new-wordpress-plugin-wdp-ajax-comments/
//Plugin: http://wordpress.org/extend/plugins/wdp-ajax-comments/
//AJAX Comments JS Code
//Version: 1.2

jQuery('document').ready(function($){
	var commentform=$('form[action$=wp-comments-post.php]');
	commentform.prepend('<div id="wdpajax-info" ></div>');
	var infodiv=$('#wdpajax-info');
	commentform.validate({
		submitHandler: function(form){
			//serialize and store form data in a variable
			var formdata=commentform.serialize();
			//Add a status message
			infodiv.html('<p class="wdpajax-loading notice">Trimitere comentariu ...</p>');
			//Extract action URL from commentform
			var formurl=commentform.attr('action');
			//Post Form with data
			$.ajax({
				type: 'post',
				url: formurl,
				data: formdata,
				dataType: 'html',
				error: function(xhr, textStatus, errorThrown){
					if(xhr.status==500){
						var response=xhr.responseText;
						var text=response.split('<p>')[1].split('</p>')[0];
						infodiv.html('<p class="error" >'+text+'</p>');
					}
					else if(xhr.status==403){
						infodiv.html('<p class="error" >Prea multe comentarii trimise intr-un interval scurt.</p>');
					}
					else{
						if(textStatus=='timeout')
							infodiv.html('<p class="error" >Eroare server. Va rugam incercati sa re-trimiteti comentariul.</p>');
						else
							infodiv.html('<p class="error" >Eroare server</p>');
					}
				},
				success: function(data, textStatus){
				  if ((data=="success") || (data=="error"))
						infodiv.html('<p class="success" >Multumim pentru comentariul Dvs.</p>');
					else
						infodiv.html('<p class="error" >Eroare procesare formular.</p>');
					commentform.find('textarea[name=comment]').val('');
				}
			});
			/*$.post(formurl, formdata, function(data, textStatus){
				if(textStatus=='success'){
					if(data=='success')
						infodiv.html('<p class="wdpajax-success" >Thanks for your comment. We appreciate your response.</p>');
					else{
						infodiv.html('<p class="wdpajax-error" >Comment marked as spam.</p>');
					}
					commentform.find('textarea[name=comment]').val('');
				}
				else if(textStatus=='error'){
					infodiv.html('<p class="wdpajax-error" >Some error</p>');
				}
				else if(textStatus=='timeout'){
					infodiv.html('<p class="wdpajax-error" >Server Time out. Try submitting your comment again.</p>');
				}
			});**/
		}
	});
});
