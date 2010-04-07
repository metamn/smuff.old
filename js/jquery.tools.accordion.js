$(document).ready(function() {
  
  // For post body
  $("#accordion").tabs(
    "#accordion div.pane", {
      tabs: 'h3', 
      effect: 'slide', 
      initialIndex: null
  });
  
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
});

