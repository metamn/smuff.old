$(document).ready(function() { 

  var ajaxurl = $("#ajax-url").attr("data-url");
  
  
  // Accordion 
  $(".accordion h3").click(function() {
  	$(this).next().slideToggle();
  });
  
  // - open first accordion on product description
  $("#single #accordion .pane").first().show();
  
  // Removing "Opiniile Cumparatorilor" from Product page
  $("#accordion h3#comments").prev().prev().hide();
  
  
  
  
  // Tooltips on email subscribe
  // - on hover for smuff, straplines, main categories
  $('.campaign-box .tooltip').hover(
    function () {
      tooltip = $(this).attr('alt');
      $('.campaign-box #tooltips').html(tooltip);
      $('.campaign-box #main-name').addClass('hidehide');
      $('.campaign-box #tooltips').addClass('tooltips-highlighted');      
    }, 
    function () {
      $('.campaign-box #tooltips').html('');
      $('.campaign-box #tooltips').removeClass('tooltips-highlighted');
      $('.campaign-box #main-name').removeClass('hidehide');
  });
  
  
  
  // Mailchimp, manual subscribe
  $("#mailchimp-direct #invite").click(function() {  
    // Get query parameters
    var nonce = $("#mailchimp-direct").attr("data-nonce");    
    var email = $("#mailchimp-direct #email").val();
    var param = $("#mailchimp-direct #param").val();
    
    // Do the ajax
    $.post(
      ajaxurl, 
      {
        'action' : 'subscribe_email',
        'nonce' : nonce,
        'email' : email,
        'param' : param
      }, 
      function(response) {        
        alert(response.message);
      }
    );
    
  });
  
  // Mailchimp, subscribe via api
  $("#mailchimp-api #invite").click(function() {  
    // Get query parameters
    var nonce = $("#mailchimp-api").attr("data-nonce");    
    var email = $("#mailchimp-api #email").val();
    
    // Do the ajax
    $.post(
      ajaxurl, 
      {
        'action' : 'mailchimp_subscribe',
        'nonce' : nonce,
        'email' : email
      }, 
      function(response) {        
        alert(response.message);
      }
    );
    
  });
  
  

  // Invite a friend
  $("#invite-friend #invite").click(function() {  
    // Get query parameters
    var nonce = $("#invite-friend-form").attr("data-nonce");    
    var email = $("#invite-friend-form #email").val();
    var friendEmail = $("#invite-friend-form #friend-email").val();
    var name = $("#invite-friend-form #name").val();
    var friendName = $("#invite-friend-form #friend-name").val();
    var gow = $("#invite-friend-form #gow").val();
    var gowLink = $("#invite-friend-form #gow-link").val();
    
    // Do the ajax
    $.post(
      ajaxurl, 
      {
        'action' : 'invite_friend',
        'nonce' : nonce,
        'email' : email,
        'friend-email' : friendEmail,
        'name' : name,
        'friend-name' : friendName,
        'gow': gow,
        'gow-link' : gowLink
      }, 
      function(response) {        
        alert(response.message);
      }
    );
    
  });
  

  // Giftshopper
  // 
  // Move steps
  $(".giftshopper #steps #next").click(function() {
    $(this).parent().parent().removeClass('active');
    $(this).parent().parent().next().addClass('active');
    
    // Highlight the current navigation item
    var id = $(this).parent().parent().next().attr('id');
    $(".giftshopper #form #nav li").removeClass('active');
    $(".giftshopper #form #nav li#" + id).addClass('active');    
  });
  $(".giftshopper #steps #prev").click(function() {
    $(this).parent().parent().removeClass('active');
    $(this).parent().parent().prev().addClass('active');
    
    // Highlight the current navigation item
    var id = $(this).parent().parent().prev().attr('id');
    $(".giftshopper #form #nav li").removeClass('active');
    $(".giftshopper #form #nav li#" + id).addClass('active');    
  });
  
  
  // Click on breadcrumbs
  $(".giftshopper #form #nav li").click(function() {
    $(".giftshopper #form #nav li").removeClass('active');
    $(this).addClass('active');
      
    var id = $(this).attr('id');
    $(".giftshopper #steps .step").removeClass('active');
    $(".giftshopper #steps #" + id).addClass('active');    
  });
  
  // Update profile info based on form data  
  $(".giftshopper #form input").click(function() {
    var content = $(this).attr('alt'); 
    var id = $(this).parent().parent().parent().attr('id');
    
    if ($(this).attr('checked')) {      
      if ($(this).attr('type') == 'checkbox') {
        content = $(".giftshopper #profile #" + id).next().html() + "<br/>" + content;
      }
      $(".giftshopper #profile #" + id).next().html(content);
    } else {
      if ($(this).attr('type') == 'checkbox') {
        var old = $(".giftshopper #profile #" + id).next().html();
        var neu = old.replace("<br>" + content, '');
        $(".giftshopper #profile #" + id).next().html(neu);
      }      
    }
  });
  
  // Get list name
  $(".giftshopper #form input#name").change(function() {
    var nume = $(this).val();
    if (nume != '') {
      var neu = " pentru " + "<span class='highlight'>" + nume + "</span>";
      $(".giftshopper #profile #name").html(neu);
    }
  });
  
  
  
  
  // Show checkout form details
   $("#checkout #checkout-personal-data").click(function() {
    $("#checkout .wpsc_checkout_field2, #checkout .wpsc_checkout_field4, #checkout .wpsc_checkout_field26, #checkout .wpsc_checkout_field27").slideToggle();
  	$("#checkout .wpsc_checkout_field19, #checkout .wpsc_checkout_field20, #checkout .wpsc_checkout_field21, #checkout .wpsc_checkout_field23, #checkout .wpsc_checkout_field24").slideToggle();
  	$("#checkout .checkout-button-2").slideToggle();
  });
   


  // Add Cart contents to Wishlist
  // -- the ajax call works only if before there is an alert ...
  $("#wishlist #add-to-wishlist a").live('click', function() {
    var posts = $(this).attr('rel').split(',');
    var titles = $(this).attr('rev').split('|');
    var size = posts.length - 2;
    
    posts.map( function(item, index) {
     if (item != '') {      
      var title = titles[index];
      if (index < size) {
        title += " este adaugat la wishlist";
      }
      alert(title);
      $.get(item);
     }
    });    
  });
  
  
  // Show Pricing policy on Chekout page
  $("#pricing-policy").click(function() {
    $("#pricing-policy-details").slideToggle();
  });
  $("#pricing-policy-details #close").click(function() {
    $("#pricing-policy-details").slideUp();
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
  /*
  $('.product-zoom').jqzoom({
    zoomType: 'reverse',
		lens: true,
		preloadImages: false,
		alwaysOn: false
  });
  */
  
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
    
    /*
    // jQZoom
    $('.product-zoom').jqzoom({
    	zoomType: 'reverse',
			lens: true,
			preloadImages: false,
			alwaysOn: false
    });
    */
  }).filter(":first").click();



  
  
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
  $('#header .tooltip').hover(
    function () {
      tooltip = $(this).attr('alt');
      $('#header #tooltips').html(tooltip);
      $('#header #main-name').addClass('hidehide');
      $('#header #tooltips').addClass('tooltips-highlighted');      
    }, 
    function () {
      $('#header #tooltips').html('');
      $('#header #tooltips').removeClass('tooltips-highlighted');
      $('#header #main-name').removeClass('hidehide');
  });
  
 

  $("#tooltip-trigger").click(function() {
    $("#tooltip-content").slideToggle('slow');
  });
  
  $("#tooltip-close").click(function() {
    $("#tooltip-content").hide('slow');
  });
  
  
    
  
  




  // Add Custom variables for Google Analytics
  // ... and Mixpanel
  
  
  // Click on Wishlist in Header
  $("#cart #wishlist a").click(function() {    
    _gaq.push(['_setCustomVar',
      1,
      'Header',
      'Go To Wishlist',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Header', 
      'Go To Wishlist'
   ]);
  });
  
  // Add to Wishlist in Product Page
  $("#post-shopping #wishlist a.wpfp-link").click(function() {    
    _gaq.push(['_setCustomVar',
      1,
      'Product Page',
      'Add To Wishlist',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Add To Wishlist'
   ]);
   mixpanel.track("Add product to wishlist");
  });
  
  // Go to Wishlist in Product Page
  $("#post-shopping #wishlist a").click(function() {    
   if (!($(this).hasClass('wpfp-link'))) {   
    _gaq.push(['_setCustomVar',
      1,
      'Product Page',
      'Go To Wishlist',
      3              
     ]);
     _gaq.push(['_trackEvent', 
        'Product Page', 
        'Go To Wishlist'
     ]);
   }
  });
  
  // Add to Wishlist in Checkout Page
  $("#checkout #add-to-wishlist a").click(function() {    
    _gaq.push(['_setCustomVar',
      1,
      'Checkout Page',
      'Add To Wishlist',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Checkout Page', 
      'Add To Wishlist'
   ]);
   mixpanel.track("Add all products to wishlist on the Chekout page");
  });
  
  // Share and save wishlist
  $(".page-wishlist button").click(function() {    
    _gaq.push(['_setCustomVar',
      1,
      'Wishlist Page',
      'Save Wishlist',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Wishlist Page', 
      'Save Wishlist'
   ]);
   mixpanel.track("Share and save wishlist");
  });
  
  // Take survey on Checkout page
  $(".page-coscumparaturi #survey").click(function() {    
    _gaq.push(['_setCustomVar',
      1,
      'Checkout Page',
      'Take Survey',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Checkout Page', 
      'Take Survey'
   ]);
  });
  
  
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
  
  // Product page, main shopping, Add To Cart
  $("#post-shopping .submit .wpsc_buy_button").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Main shopping box, Add To Cart',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Add To Cart',
      'Main shopping box' 
   ]);
   mixpanel.track("Add to cart", {"Source" : "Main shopping box"});
  });
  
  // Product page, main shopping, Checkout
  $("#post-shopping .checkout .checkout-button").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Main shopping box, Checkout',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Checkout',
      'Main shopping box'
   ]);
   mixpanel.track("Go to Checkout", {"Source" : "Main shopping box"});
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
  
  // Product page, bottom shopping, Add To Cart
  $("#post-shopping2 .submit .wpsc_buy_button").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Secondary shopping box, Add To Cart',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Add To Cart',
      'Secondary shopping box'
   ]);
   mixpanel.track("Add to cart", {"Source" : "Secondary shopping box"});
  });
  
  // Product page, bottom shopping, Checkout
  $("#post-shopping2 .checkout .checkout-button").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Product page',
      'Secondary shopping box, Checkout',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Product Page', 
      'Checkout',
      'Secondary shopping box' 
   ]);
   mixpanel.track("Go to Checkout", {"Source" : "Secondary shopping box"});
  });
  
  
  // Every page, Cart in Header, Checkout
  $("#cart #sliding_cart #checkout").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Header',
      'Checkout',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Header', 
      'Checkout'
   ]);
   mixpanel.track("Go to checkout", {"Source" : "Header"});
  });
  
  // Checkout Page, Make Purchase
  $(".page-coscumparaturi .wpsc_checkout_forms input.make_purchase").click(function() {
    _gaq.push(['_setCustomVar',
      1,
      'Checkout Page',
      'Make Purchase',
      3              
   ]);
   _gaq.push(['_trackEvent', 
      'Checkout Page', 
      'Make Purchase'
   ]);
   mixpanel.track("Make purchase");
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

    
}); 