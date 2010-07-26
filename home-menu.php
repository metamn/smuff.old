<div id="home-menu" class="box last">
  <ul>        
    <li><?php get_search_form(); ?></li>    
    <li><span class="ui-icon ui-icon-search"/></span><a href="<?php bloginfo('home'); ?>/cautare-avansata">Cautare avansata</a></li>
    <li><span class="ui-icon ui-icon-script"/></span>
      <?php
        $title = 'Vezi toate produsele'; 
        $link_type = '2'; // 2=table view, 3=grid view
        include "home-all-products-link.php"; 
      ?>
    </li> 
    <li><span class="ui-icon ui-icon-info"/></span><a href="<?php bloginfo('home'); ?>/#footer-info">Informatii</a></li>
    <li><span class="ui-icon ui-icon-person"/></span>0745-456127</li>
    <li><span class="ui-icon ui-icon-comment"/></span><a href="<?php bloginfo('home'); ?>/blog">Blog</a></li>
    <li><span class="ui-icon ui-icon-heart"/></span><a href="<?php bloginfo('home'); ?>/#home-ecosystem">Prietenii Smuff</a></li>
    <li class="old-site"><span class="ui-icon ui-icon-play"/></span><a href="<?php bloginfo('home'); ?>/#footer-info">Site-ul vechi</a></li>
    <li class="menu-spacer">&nbsp;</li>
  </ul>  
</div>


