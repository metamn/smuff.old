$(document).ready(function() { 


  // Scrollables
  // Home page Promotions 
  $("#promo-scroll").scrollable().navigator();	
  
  // Single post images
  $("#single-scroll").scrollable().navigator();
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



  // Accordions
  // For post body
  //$("#accordion").tabs(
  //  "#accordion div.pane", {
    //  tabs: 'h3', 
    //  effect: 'slide', 
    //  initialIndex: null
  //});  
  $("#accordion h3").toggle(
    function () {
      $(this).addClass("current");
      $(this).next(".pane").show();
    },
    function () {
      $(this).removeClass("current");
      $(this).next(".pane").hide();
    }
  );
  // Info pages above footer    
  $("#accordion-footer-info").tabs(
    "#accordion-footer-info div.pane", {
      tabs: 'h3', 
      effect: 'slide', 
      initialIndex: null
  });  
  // Company info toggle
  $("#company h3").click(function() {
    $(".date-firma-info").toggle();
  });




  // Tooltips on startpage
  // - on hover for smuff, straplines, main categories
  $('.tooltip').hover(
    function () {
      tooltip = $(this).attr('alt');
      $('#tooltips').html(tooltip);
      $('#tooltips').addClass('tooltips-highlighted');
    }, 
    function () {
      $('#tooltips').html('');
      $('#tooltips').removeClass('tooltips-highlighted');
  });

  
  // Checkout page checkboxes
  // - simulating shipping selection
  $("input[name='shipping_method']").change(function(){
   original = parseInt($("input[name='checkout_original_price']").val());
   current = parseInt($(this).val());
   n = current + original;
   $(".checkout_total_price").html( n + ".00 RON");
   $("#checkout_shipping_price").val(current);
  });
   
  // S3 slider
  // - on startpage / hot items
  $('#s3slider').s3Slider({
      timeOut: 4000
   });
  
  // Sortable table
  // - on View all products
  $("#archive-all-table").tablesorter({
    sortList: [[0,1]]    
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
