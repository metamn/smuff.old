
$(document).ready(function() { 

  var ajaxurl = $("#ajax-url").attr("data-url");
  var themeurl = $("#ajax-url").attr("data-theme-url");
  
  
  // Startpage - Hot
  $('.home .navigation').click(function (){
  	var image = $('#large-image img').attr('src');
  	var current = $('#thumbs #items').find('a[data-image=' + image + ']');
  	
  	if ($(this).hasClass('right')) {
  		var change = current.parent().next();
  		if (!change.length) {
  			change = $('#thumbs #items .item').first();
  		}
  	} else {
  		var change = current.parent().prev();
  		if (!change.length) {
  			change = $('#thumbs #items .item').last();
  		}
  	}
  	
  	loadImage(change.find('a'), $('#large-image'));  	
  });
  
  // Single product
  $('.single-post .navigation').click(function (){
  	var image = $('#large-image img').attr('src');
  	var current = $('#thumbs').find('a[data-image=' + image + ']');
  	
  	if ($(this).hasClass('right')) {
  		var change = current.next();
  		if (!change.length) {
  			change = $('#thumbs a').first();
  		}
  	} else {
  		var change = current.prev();
  		if (!change.length) {
  			change = $('#thumbs a').last();
  		}
  	}
  	
  	loadImage(change, $('#large-image'));  	
  });
  
  
  // - load the big image from thumb data
  function loadImage(thumb, large) {
  
  	// Show the spinner
    large.children('a').children('img').attr('src', themeurl + '/img/ajax-loader-invisible.gif');  
  
		var large_info = $('#home-hot #large-image-title #info');
		
		var link = thumb.attr('data-link');
		var image = thumb.attr('data-image');
		var title = thumb.attr('title');
		var excerpt = thumb.attr('data-excerpt');
		var price = thumb.attr('data-price');
		var salePrice = thumb.attr('data-sale-price');
		
		large.children('a').attr('href', link);
		large.children('a').attr('title', title);
		large.children('a').attr('alt', title);
		
		var img = new Image();
    img.onload = function() {
      // change the image
      large.children('a').children('img').attr('src', image);
			large.children('a').children('img').attr('title', title);
			large.children('a').children('img').attr('alt', title);
    };
    img.src = image;
		
		
		large_info.children('a').attr('href', link);
		large_info.children('a').attr('title', title);
		large_info.children('a').attr('alt', title);
		large_info.children('a').children('#title').html(title);
		large_info.children('a').children('#excerpt').html(excerpt);
		
		if (salePrice) {
			large_info.children('a').children('#price').children('.price').html(salePrice + ' Lei');
			large_info.children('a').children('#price').children('.old-price').html(price);
			
			large_info.children('a').children('#price').children('.price').show();
			large_info.children('a').children('#price').children('.old-price').show();
			large_info.children('a').children('#price').children('.normal-price').hide();
			large_info.children('a').children('#price').children('.lei').hide();
		} else {
			large_info.children('a').children('#price').children('.normal-price').html(price);
			large_info.children('a').children('#price').children('.normal-price').show();
			large_info.children('a').children('#price').children('.lei').show();
			
			large_info.children('a').children('#price').children('.price').hide();
			large_info.children('a').children('#price').children('.old-price').hide();
		}
		
		if (!price) {
			large_info.children('a').children('#price').children('.normal-price').hide();
			large_info.children('a').children('#price').children('.lei').hide();
		}
  }
  
  // - load the first image
  loadImage($('#home-hot #thumbs .item a').first(), $('#home-hot #large-image'));
  
  // - click on thumbs
  $('#home-hot #thumbs .item a').live('click', function () {
    loadImage($(this), $('#home-hot #large-image'));
  });



  
  // Single post images


  // - thumb click
  $("#post-images #thumbs a").live('click', function () {
    loadImage($(this).children('img'), $('#large-image'));
  })





  
  
  // Tooltip
  // - http://osvaldas.info/elegant-css-and-jquery-tooltip-responsive-mobile-friendly
  var targets = $( '.tooltip' ),
	target  = false,
	tooltip = false,
	title   = false;
 
  targets.bind( 'mouseenter', function() {
        target  = $(this);
        tip     = target.children('.tooltip-text').html();
        tooltip = $( '<div id="tooltip"></div>' );
 
        if( !tip || tip == '' )
            return false;
 
        // target.removeAttr( 'title' );
        tooltip.css( 'opacity', 0 )
               .html( tip )
               .appendTo( 'body' );
 
        var init_tooltip = function()
        {
            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                tooltip.css( 'max-width', $( window ).width() / 2 );
            else
                tooltip.css( 'max-width', 340 );
 
            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top  = target.offset().top - tooltip.outerHeight() - 20;
 
            if( pos_left < 0 )
            {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass( 'left' );
            }
            else
                tooltip.removeClass( 'left' );
 
            if( pos_left + tooltip.outerWidth() > $( window ).width() )
            {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass( 'right' );
            }
            else
                tooltip.removeClass( 'right' );
 
            if( pos_top < 0 )
            {
                var pos_top  = target.offset().top + target.outerHeight();
                tooltip.addClass( 'top' );
            }
            else
                tooltip.removeClass( 'top' );
 
            tooltip.css( { left: pos_left, top: pos_top } )
                   .animate( { top: '+=10', opacity: 1 }, 50 );
        };
 
        init_tooltip();
        $( window ).resize( init_tooltip );
 
        var remove_tooltip = function()
        {
            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
            {
                $( this ).remove();
            });
 
        };
 
        target.bind( 'mouseleave', remove_tooltip );
        tooltip.bind( 'click', remove_tooltip );
    });
  
  
  

  
  
  // Search
  $("#search-enhanced #advanced-search").click(function() {
  	$(this).parent().slideToggle();
  	$("#search-enhanced #second-row").slideToggle();
  });
  
  
  // Accordion 
  $(".accordion h3").click(function() {
  	$(this).next().slideToggle();
  });
  // - open first accordion on product description
  $("#single #accordion .pane").first().show();
  // Removing "Opiniile Cumparatorilor" from Product page
  $("#accordion h3#comments").prev().prev().hide();
  
  
  // Checkout
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