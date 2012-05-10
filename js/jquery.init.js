$(document).ready(function() { 

  
  // Add Custom variables for Google Analytics
  
  // Sidebar icons to categories
  $("#sidebar #home-tag-icons a").click(function() {    
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Sidebar icons',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on Sidebar icons'
   ]);
  });
  
  
  // The main nav menu
  $("#menu a").click(function() {    
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Menu',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on Menu'
   ]);
  });

  // Hot products
  $("#hot-slider a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Hot',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on Hot products'
   ]);
  });
  
  // Hot products link  
  $("a#new-products-link").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Hot products link',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on Hot products link'
   ]);
  });
  
  // Hot products, expanded with hot products link
  $("#noutati a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Hot products expanded',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Expand hot products'
   ]);
  });
  
  // Bestsellers
  $("#bestsellers a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Bestsellers',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on Bestsellers'
   ]);
  });  
  
  // Bestsellers > See more from category
  $("#bestsellers a.all-products-link").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Bestsellers: See more from category link',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on See more from category link'
   ]);
  });
  
  // Promo
  $("#promo a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Promo',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on Promo products'
   ]);
  });
  
  // Promo > See all promo link
  $("#promo a.all-products-link").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Magazine view',
      'Promo: See more promo link',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Magazine view', 
      'Click on See more Promo products'
   ]);
  });
  
  
  // Product page, small images click
  $("#single-scroll img").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Click on small images',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on small images'
   ]);
  });
  
  // Product page, accordion
  $("#single #accordion h3").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Click on accordion',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on accordion'
   ]);
  });
  
  // Product page, main shopping
  $("#post-shopping").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Main shopping box click',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on main shopping box'
   ]);
  });
  
  // Product page, bottom shopping
  $("#post-shopping2").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Secondary shopping box click',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on secondary shopping box'
   ]);
  });
  
  // Product page, other products 
  $("#from-category a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Other products from category',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on Other products from category'
   ]);
  });
  
  // Product page, recommended 
  $("#single #recommended a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Recommended products',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on Recommended products'
   ]);
  });
  
  // Product page, promos
  $("#promos a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Promotions',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on Promo products'
   ]);
  });
  
  // Product page, random 
  $("#random a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Random products',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Click on Random products'
   ]);
  });
  
  
  // Checkout page, recommended 
  $("page.checkout-final #recommended a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Checkout',
      'Recommended products',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Checkout Page', 
      'Click on Recommended products'
   ]);
  });
  
  
  
  // Sidebar categories link
  $("#sidebar-navigation a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Sidebar',
      'Categories',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Sidebar', 
      'Click on sidebar categories'
   ]);
  });
  
  // Footer info
  $("#footer-info a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Footer',
      'Info',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Footer', 
      'Click on footer info links'
   ]);
  });
  
  // Footer subscribe
  $("#footer-subscribe a").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Footer',
      'Subscribe',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Footer', 
      'Click on footer subscribe buttons'
   ]);
  });
  
  
  
  

  // Show shopping info on Product page on click, not just on hover
  $("#shopping-info .shopping-info").click(function() {
    if ($(this).next().is(":visible")) {
      $(this).next().show('slow');
    } else {
      $(this).next().hide('slow');
    }
  });
  

  // Showing all new products alternative way
  $("#new-products-link").click(function() {
    var res = "";
    
    $("#hot-slider li").each(function(){
      $(this).find('img').attr('src', $(this).find('img').attr('rel'));
      res += '<div id="item">' + $(this).html() + '</div>';  
    });
    
    $("#noutati").html(res);
    $("#noutati").fadeIn("slow");
  });
  

  // Adding search result count
  $("#search-counter").html(
    $("#search-count").html()
  );
  

  // Removing "Opiniile Cumparatorilor" from Product page
  $("#accordion h3#comments").prev().prev().hide();


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
  // Home page Hot / New products
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
      $('#main-name').addClass('hidehide');
      $('#tooltips').addClass('tooltips-highlighted');      
    }, 
    function () {
      $('#tooltips').html('');
      $('#tooltips').removeClass('tooltips-highlighted');
      $('#main-name').removeClass('hidehide');
  });
  
  // jQuery Tools Tooltip
  // $("#shopping-info .shopping-info").tooltip({ effect: 'slide'});

  $("#tooltip-trigger").click(function() {
    $("#tooltip-content").slideToggle('slow');
  });
  
  $("#tooltip-close").click(function() {
    $("#tooltip-content").hide('slow');
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
  $(".post .facebook, .post .twitter, .post .google").hover(
    function () {
      $(this).removeClass('opacity-3');
    }, 
    function () {
      $(this).addClass('opacity-3');
  });
  
    
}); 


