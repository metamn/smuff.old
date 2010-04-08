$(document).ready(function() { 
  //S3 slider
  $('#s3slider').s3Slider({
      timeOut: 4000
   });
  
  // Sortable table
  $("#archive-all-table").tablesorter({
    sortList: [[0,1]]    
  }); 
    
	$("#slider").easySlider({
		auto: true,
		continuous: true,
		speed: 1600,
		pause: 4000 
	});
  
  // add opacity on twitter fb buttons on mouse hover, blog index
  $(".post .facebook, .post .twitter").hover(
    function () {
      $(this).removeClass('opacity-3');
    }, 
    function () {
      $(this).addClass('opacity-3');
  });
  
  // on click show the search form on sidebar/menu 
  $("li.search-link").click(function() {
    var strResponse = '<form action="http://nucumpar.ro/" id="searchform" method="get">';
    strResponse = strResponse + '<input type="text" class="search" id="s" name="s" value="cautare ...">';
    strResponse = strResponse + '</form>';
    $(this).html(strResponse);
    $(this).removeClass('search-link');
    $(this).append('<li><span class="ui-icon ui-icon-search"/></span><a href="http://nucumpar.ro/cautare-avansata">Cautare avansata</a></li>');
    $("li.menu-spacer").remove();
  });
}); 
