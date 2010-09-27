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
    <li><span class="ui-icon ui-icon-info"/></span><a href="#footer-info">Informatii</a></li>
    <li><span class="ui-icon ui-icon-person"/></span>0745-456127</li>
    <li class="highlight"><span class="ui-icon ui-icon-comment"/></span><a href="<?php bloginfo('home'); ?>/blog">Blog</a></li>
    <li><span class="ui-icon ui-icon-heart"/></span><a href="<?php bloginfo('home'); ?>/#home-ecosystem">Prietenii Smuff</a></li>    
    <li><span class="ui-icon ui-icon-mail-closed"/></span><a href="<?php bloginfo('home'); ?>/#footer-subscribe">Newsletter</a></li>
    <li><span class="ui-icon ui-icon-refresh"/></span><a href="<?php bloginfo('home'); ?>/despre-noi/business-2-business">Business si Media</a></li>
    <li><span class="ui-icon ui-icon-transfer-e-w"/></span><a href="<?php bloginfo('home'); ?>/despre-noi/parteneri">Parteneri</a></li>    
    <li><span class="ui-icon ui-icon-play"/></span><a href="http://v1.smuff.ro">Site-ul vechi</a></li>
  </ul>  
</div>


