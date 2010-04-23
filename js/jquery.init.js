$(document).ready(function() { 
  
  // Checkout page checkboxes
  $("input[name='shipping_method']").change(function(){
   original = parseInt($("input[name='checkout_original_price']").val());
   current = parseInt($(this).val());
   n = current + original;
   $(".checkout_total_price").html( n + ".00 RON");
   $("#checkout_shipping_price").val(current);
  });
   
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
