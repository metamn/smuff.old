$(document).ready(function() { 

  // jQZoom
  // On Product 
  // after image change jqzoom is reloaded, see below
  $('.product-zoom').jqzoom({
	    zoomWidth: 480,
	    zoomHeight: 325,
      xOffset: 10,
      yOffset: 0,
      position: "right",
      title: false,
      preload: 0,
      zoomType: 'reverse'
  });
  
  // Slider
  // Home page Hot
  $("#hot-slider").sudoSlider({ 
    prevNext: false,
    fade: true,
    customLink: 'a.hot-slider-link',
    updateBefore: true
  });
  
  
  // jQueryTools Scrollables
  // --
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
      wrap.find("a").attr("href", newImage);
    };
    img.src = newImage;
    
    // jQZoom
    $('.product-zoom').jqzoom({
	      zoomWidth: 480,
	      zoomHeight: 315,
        xOffset: 10,
        yOffset: 0,
        position: "right",
        title: false,
        preload: 0,
        zoomType: 'reverse'
    });
  }).filter(":first").click();



  // Accordions
  // For post body
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
  // Show comments on last checkout page
  $("#page.checkout-final #feedback .pointer").click(function() {
    $("#page.checkout-final #comments").toggle();
  });


  // Hover on Product thumbs
  // - on Home Promo, Recommended items, All products, Search results ....
  $("#recommended .item, #promo-scroll .item, #archive-all-grid #item, #search-results #item").hover(
    function () {
      $(this).addClass('product-thumb-highlighted');
    }, 
    function () {
      $(this).removeClass('product-thumb-highlighted');
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

  
  
  // Sortable table
  // - on View all products
  $("#archive-all-table").tablesorter({
    sortList: [[0,1]]    
  }); 
  // - on Partner list 
  $("#partners-table").tablesorter({
    sortList: [[1,1]]    
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


