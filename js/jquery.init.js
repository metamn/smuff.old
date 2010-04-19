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
  
  
}); 
