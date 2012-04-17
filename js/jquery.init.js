$(document).ready(function() { 


  // Click on side icons
  $("#left-side-icons li img").click(function() {
    var w = $('.container').css('margin-left');
    if ((w == '0px') || (w == 'auto')) {
      $(".container").animate({
        "margin-left": "40%"
      }, 800);
    } else {
      $(".container").animate({
        "margin": "0 auto"
      }, 800);
    };
    
    $("#left-side-text").toggle('slow');
  });
  


  // jQZoom
  // On Product 
  // after image change jqzoom is reloaded, see below
  $('.product-zoom').jqzoom({
	    zoomWidth: 480,
	    zoomHeight: 330,
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
    updateBefore: true,
    beforeAniFunc: function(t) { 
      var img = $("#hot-slider ul li:nth-child(" + t + ")").find('img').attr('rel');
      //var img2 = img.replace('localhost/smuff', 'smuff.ro');
      $("#hot-slider ul li:nth-child(" + t + ")").find('img').attr('src', img); 
    }
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
	      zoomHeight: 330,
        xOffset: 10,
        yOffset: 0,
        position: "right",
        title: false,
        preload: 0,
        zoomType: 'reverse'
    });
  }).filter(":first").click();



  // Accordions  
  // Product page 
  
  // - open the first pane
  $("#accordion h3").first().addClass("current");
  $("#accordion h3").first().next(".pane").show();
  
  // - add arrow to the accordion titles 
  $("#accordion h3").each(function(){
    var original = $(this).html();
    var neu = original + "<span>&rsaquo;</span>";
    $(this).html(neu);
  });

  
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
  
  // jQuery Tools Tooltip
  $("#shopping-info .shopping-info").tooltip({ effect: 'slide'});

  
  
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
  $(".post .facebook, .post .twitter, .post .google").hover(
    function () {
      $(this).removeClass('opacity-3');
    }, 
    function () {
      $(this).addClass('opacity-3');
  });
  
    
}); 


