<div id="sidebar-blog" class="column span-6 last">
  <?php include "home-menu.php" ?>
  <div id="sidebar-navigation" class="box last">
    <div class="entry">
      <ul>
        <?php wp_list_categories('title_li='); ?>     
      </ul>
    </div>
    <h3>Etichete</h3>
    <div class="entry tagcloud">
      <?php wp_tag_cloud(); ?>     
    </div>
  </div>
</div>
