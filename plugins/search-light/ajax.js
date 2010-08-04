var itsas_currentSearchKey = "";
var itsas_top = 0;
var itsas_left = 0;
var itsas_searchFormId = "";
var itsas_searchFieldId = "";
var itsas_searchField = null;
var itsas_count = 0;
var itsas_pageText = "Seiten";
var itsas_postText = "Artikel";
var itsas_theme = "";
function searchLight_init(){
	itsas_searchField = jQuery("#"+itsas_searchFormId+" #" + itsas_searchFieldId);
	itsas_searchField.attr('autocomplete','off');
	jQuery('body').append("<div id='searchLight'></div>");
	jQuery("#searchLight").css('z-index','999')
							.css('display', 'none')
							.css('position','absolute')
							.css('top',itsas_searchField.offset().top + itsas_searchField.height() + itsas_top)
							.css('left',itsas_searchField.offset().left + itsas_left);
	
	jQuery('#searchLight').append("<div id='searchLightIndicator'><img src='"+itsas_theme+"/ajax-loader.gif' alt='loading' title=''/></div>");	
	jQuery("#searchLightIndicator").css('display', 'none');
	jQuery('#searchLight').append("<div id='searchLightPanel'><div id='searchLightStatus'></div><h2>"+itsas_pageText+"</h2><h2>"+itsas_postText+"</h2></div>");
	
	itsas_searchField.dblclick(function () { 
		jQuery("#searchLight").fadeOut();
		//jQuery('#searchLight').html("");
		jQuery("#searchLight #searchLightData #searchKey").html("");
		itsas_searchField.val("");
		itsas_currentSearchKey = "";
    });
	
	itsas_searchField.blur(function(){
		 	jQuery('#searchLight').fadeOut();
	});
	
	itsas_searchField.keyup(function (e){
		if (e.which == 27){// ESC
			itsas_searchField.val("");
			itsas_currentSearchKey = "";
			//jQuery('#searchLight').html("");
			jQuery("#searchLight #searchLightData #searchKey").html("");
			jQuery('#searchLight').fadeOut();
		}else if (e.which == 13){
			if (jQuery('#searchLight li .activeSearchItem').length > 0){
				document.location.href = jQuery('#searchLight li .activeSearchItem').attr('href');
				return false;
			}
		}else if (e.which == 40){ // arrow down
			var b = false;
			//var objSet = jQuery('#searchLight li a');
			var objSet = jQuery('#searchLight a');
			for(i = 0; i < objSet.length; i++){				
				if (objSet.get(i).className == 'activeSearchItem'){
					b = true;
					if (i + 1 < objSet.length){
						objSet.get(i).className = "";
						objSet.get(i+1).className = 'activeSearchItem';
						break;
					}
				}
			}			
			if (!b){
				//jQuery('#searchLight li a:first').addClass('activeSearchItem');	
				jQuery('#searchLight a:first').addClass('activeSearchItem');
			}
		}else if (e.which == 38){		//arrow up
			var b = false;
			//var objSet = jQuery('#searchLight li a');
			var objSet = jQuery('#searchLight a');
			for(i = objSet.length -1 ; i >= 0 ; i--){				
				if (objSet.get(i).className == 'activeSearchItem'){
					b = true;
					if (i - 1 >= 0){
						objSet.get(i).className = "";
						objSet.get(i-1).className = 'activeSearchItem';
						break;
					}
				}
			}			
			if (!b){
				//jQuery('#searchLight li a:last').addClass('activeSearchItem');	
				jQuery('#searchLight a:last').addClass('activeSearchItem');
			}
		}else{
			var str = itsas_searchField.val();
			str = str.replace(/(^\s*)|(\s*$)/g, ""); 
			if (str == itsas_currentSearchKey){
				if (str != "")
					jQuery("#searchLight").fadeIn();
				return;
			}
			itsas_currentSearchKey = str;
			if (str.length >= 1){				
				goSearch(str);
				//setTimeout(function(){goSearch(str);},220);
			}else{
				jQuery("#searchLight").fadeOut();
				//jQuery('#searchLight').html("");
				jQuery("#searchLight #searchLightData #searchKey").html("");
			}
		}
	});
}
jQuery(document).ready(function(){
	jQuery.get("index.php",
				{itsasAjaxSearch:'true', a:'getSettings'},
				function(data){
					itsas_top = data.top;
					itsas_left = data.left;
					itsas_searchFormId = data.searchFormID;
					itsas_searchFieldId = data.searchFieldID;
					itsas_theme = data.theme;
					searchLight_init();
				},
				'json'
	);
});
function goSearch(str){
	if (str == itsas_currentSearchKey){
		itsas_count++;
		if (jQuery("#searchLight #searchLightData #searchKey").html() != itsas_currentSearchKey){
			jQuery('#searchLight').fadeIn();
			jQuery("#searchLightIndicator").fadeIn();
		}
		
		jQuery.get("index.php",
				{itsasAjaxSearch:'true', key:str},
				function(data){
					itsas_count--;
					if (itsas_count == 0){
						jQuery("#searchLightIndicator").fadeOut();
					}
					if (itsas_currentSearchKey == ""){
						jQuery("#searchLightIndicator").fadeOut();
						jQuery("#searchLight").fadeOut();
					}else if (jQuery("#searchLight #searchLightData #searchKey").html() != itsas_currentSearchKey){
						//jQuery("#searchLight").html(data);
						jQuery("#searchLightPanel").html(data);
						jQuery("#searchLight").fadeIn();
						//jQuery("#searchLightIndicator").fadeOut();
					}else{
						jQuery("#searchLight").fadeIn();
						jQuery("#searchLightIndicator").fadeOut();//alert(itsas_currentSearchKey);
					}
				}
		);
	}
}