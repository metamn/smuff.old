<section id="filters">
  <h3 class="outline">Filtrare rezultate</h3>
  
  <nav id="for-who">
    <h3 class="outline">Pentru cine</h3>
    <label class="select">
      <select>
        <?php if ($cat_name == " in Jucarii") { ?>
          <option>Pentru toti</option>
          <option>Pentru baieti</option>
          <option>Pentru fetite</option>
          <option>Big Boys</option>
          <option>Outdoor</option>
        <?php } else { ?>
          <option>Pentru toti</option>
          <option>Pentru El</option>
          <option>Pentru Ea</option>
          <option>Pentru copii</option>
          <option>Casa si birou</option>
        <?php } ?>
      </select>
    </label>
  </nav>
  
  <nav id="price">
    <h3 class="outline">Preturi</h3>
    <label class="select">
      <select>
        <option>Toate preturile</option>
        <option>Sub 100 lei</option>
        <option>Pana in 250 lei</option>
        <option>Pana in 350 lei</option>
        <option>Peste 350 lei</option>
      </select>
    </label>
  </nav>
  
  <nav id="delivery">
    <h3 class="outline">Livrare / Stoc</h3>
    <label class="select">
      <select>
        <option>Toate livrarile</option>
        <option>Livrare in 24 ore</option>
        <option>Max. 2-4 zile</option>
        <option>Max. 5-7 zile</option>
      </select>
    </label>
  </nav>
  
  <nav id="meta" class="last">
    <h3 class="outline">Noutati, Reduceri etc.</h3>
    <label class="select">
      <select>
        <option>Cele mai noi</option>
        <option>Cu pret redus</option>
        <option>Cele mai cautate</option>
        <option>Toate din <?php echo $cat_name ?></option>
      </select>
    </label>
  </nav>
</section>
