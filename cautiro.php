<?php
  /*
  Template Name: Cautiro
   * @package WordPress
   * @subpackage Default_Theme
   */
?>

<?php 

// Datafeed for cauti.ro
// Syntax: http://merchant.cauti.ro/listele_mele.php


$xmlHead = "<produse xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"http://www.cauti.ro/produse.xsd\">\n";
echo $xmlHead;		// afiseaza capul de document
flush();			// forteaza afisare

/**
 * Initializari variabile
 */
$i=0;
$produs = array();

// array cu caracterele de inlocuit
$search 	= array('\r\n','\n','&trade;','&copy;','&reg;','™','&deg;','&icirc;','&acirc;','&#206','&#258;','&#259;','&#350;','&#351;','&#354;','&#355;','Â','â','Ă','ă','Î','î','Ş','ş','Ţ','ţ');
// array cu caracterele cu care se inlocuiesc caracterele de mai sus
$replace 	= array(' ',' ',' ',' ',' ',' ','grade','i','a','I','A','a','S','s','T','t','A','a','A','a','I','i','S','s','T','t');


$offset = 0;
while ($offset >= 0) {
  $posts = get_posts('numberposts=0&category=10&offset='.$offset);
  if ($posts) {
    foreach ($posts as $p) {
      $id = $p->ID;
      $yes = get_post_meta($id, 'cautiro', true);
      if ($yes) {
        $product_id = get_post_meta($id, 'product_id', true);      
        $category = $yes;
        $brand = get_post_meta($id, 'brand', true);
        if ($brand == '') { $brand = '-'; }
        $title = product_name($product_id);
        $description = '';
        $url = get_permalink($id);
        $imgs = post_attachements($id);
        $img = $imgs[0];  
        $large = wp_get_attachment_image_src($img->ID, 'large'); 
        $image = $large[0];
        $price = product_price($id);
        $stoc = 1;
        $garantie = "1 an";
              
        /* 
			   * Creeaza un array cu datele din fiecare tupla si initializeaza cu valori default campurile optionale 
			   * daca nu au fost aduse din baza de date sau nu gasesc variabilele cu numele corect
			   */
			  $produs = array(
				  // --> date obligatorii
				  'CodProdusMercant'	=> $product_id,
				  'NumeMarca' 		=> $brand,
				  'NumeProdus'		=> $title,
				  'URL'				=> $url,
				  'NumeCategorie'		=> $category,
				  'PretLei'			=> $price,
				  'InStoc'			=> $stoc,
				  // <-- 
				  // --> date optionale
				  'Garantia'			=> 12,
				  'DescriereScurta'	=> '',
				  'Descriere'			=> $description,
				  'URL_poza1'			=> $image,
				  'URL_poza2'			=> '',
				  'URL_poza3'			=> '',
				  'CategoriiProdus'	=> $category,
				  'CodProducator'		=> '',
				  'MPN'				=> '',
				  'Greutate'			=> '',
				  'TipStoc'			=> '',
				  'Activ'				=> 1
				  // <--
			  );
			
			  $nodProdus = "\t<produs id=\"$i\">\n";		// pentru fiecare tupla se creeaza cate un nod de produs
			
			  foreach ($produs as $key => $valoare)						// parcurge arrayul produs
			  {
				  if ($valoare != '' and $valoare != -1)					// daca valorile nu sunt cele default
				  {
					  $nodProdus .= "\t\t<$key>$valoare</$key>\n";		// pentru fiecare camp din array se creeaza noduri copii ai nodului produs
				  }
			  }

			  $nodProdus .= "\t</produs>\n";		// pentru fiecare tupla se inchide nodul de produs
			
			  echo $nodProdus;					// afisez nodul construit
			  flush();							// fortez afisare

			  $i++;								// incrementez counter
		  }
    }
    $offset += 10;
  } else {
    $offset = -1;
  }
}


$xmlFoot = "</produse>";		// definesc footerul documentului XML
echo $xmlFoot;					// afisez footerul
flush();						// fortez afisare


?>
