$(document).ready(function() {  
  
  // Sales div hover
  $('#promo .item').hover(function() {
    $(this).addClass('promo-item-hover');    
  }, function() {
    $(this).removeClass('promo-item-hover');    
  });
  
  // Promo thumb click
  $("#top-sales img.small-image").click(function(event){
    var newImage = $(this).attr('rel');
    var productID = "#" + $(this).attr('rev');
  
    $("#top-sales img.large-image").attr('src', newImage);
    $('#top-sales #info').html($(productID).html());
    $('#top-sales #info').hide();
  });
  
  // Promo large click
  $('#top-sales img.large-image').click(function(event) {
    $('#top-sales #info').toggle('slow');
  });  
  
  // Single post thumb click 
  $("#single-scroll img.small-image").click(function(){
    var newImage = $(this).attr('rev');
    var wrap = $("#large-image");
    var img = new Image();
    img.onload = function() {
		  // change the image
		  wrap.find("img").attr("src", newImage);
	  };
	  img.src = newImage;
  }).filter(":first").click();
  
  // Sticky close
  $('#sticky .sticky-close').click(function(event) {
    $('#sticky').slideUp('slow');
  });
});
