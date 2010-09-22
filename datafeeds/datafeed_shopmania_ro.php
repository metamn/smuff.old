<?php

// Database access info
$db_location = "";
$db_name = "";
$db_username = "";
$db_password = "";

// Datafeed specific settings
$datafeed_separator = "|"; // Possible options are \t or |
$datafeed_currency = "RON"; // Please make sure that you are using the corect currency code. Possible values are RON, EUR, USD

// Connect to the database
$conn = @mysql_connect($db_location, $db_username, $db_password);
if (mysql_error()) {
	print "Connection error. Please check the connection settings. Bye bye...";
	exit;
}
// Select database to use
else {
	@mysql_select_db($db_name, $conn);
	if (mysql_error()) {
		print "Connection error. Please check the connection settings. Bye bye...";
		exit;
	}
}

$prod_table = ""; // products table
$cat_table = ""; // categories table

// Query database for extracting data. It might be needed to left join the categories table for extracting the category name
$q = "SELECT $cat_table.name, $prod_table.manufacturer, $prod_table.model, $prod_table.id, $prod_table.name, $prod_table.desc, $prod_table.image, $prod_table.price FROM $prod_table
LEFT JOIN $cat_table ON $prod_table.cat_id = $cat_table.id
WHERE $prod_table.status = 'active'";
$r = @mysql_query($q);

// There are no errors so we can continue
if (!mysql_error()) {

	while (list($cat_name, $prod_manufacturer, $prod_model, $prod_id, $prod_name, $prod_desc, $prod_image, $prod_price) = mysql_fetch_row($r)) {		
		// Clean product name (new lines)
		$prod_name = str_replace("\n", "", strip_tags($prod_name));
		// Clean product description (Replace new line with <BR>). In order to make sure the code does not contains other HTML code it might be a good ideea to strip_tags()
		$prod_desc = replace_not_in_tags("\n", "<BR />", $prod_desc);
		$prod_desc = str_replace("\n", " ", $prod_desc);
		$prod_desc = str_replace("\r", "", $prod_desc);
		
		// Clean product names and descriptions (separators)
		if ($datafeed_separator == "\t") {
			$prod_name = str_replace("\t", " ", strip_tags($prod_name));
			$prod_desc = str_replace("\t", " ", $prod_desc);
		}
		elseif ($datafeed_separator == "|") {
			$prod_name = str_replace("|", " ", strip_tags($prod_name));
			$prod_desc = str_replace("|", " ", $prod_desc);
		}
		else {
			print "Incorrect columns separator.";
			exit;			
		}
		
		$prod_url = function_to_get_product_url($prod_id);		
		$prod_image = function_to_get_product_image($prod_image);		
		
		// Here you can overwrite the default currency if your products are listed with different currencies
		// $datafeed_currency = $prod_currency
		
		// Required fields are: category name, merchant product ID, product name, product URL, product price
		// For the product model you should only use the manufacturer code, ISBN code or UPC code - If you are not sure about a field please leave it empty
		
		// Strip html from category name
		$cat_name = html_to_text($cat_name);
		
		// Output the datafeed content
		print  
		$cat_name . $datafeed_separator . 
		$prod_manufacturer . $datafeed_separator . 
		$prod_model . $datafeed_separator . 
		$prod_id . $datafeed_separator . 
		$prod_name . $datafeed_separator . 
		$prod_desc . $datafeed_separator . 
		$prod_url . $datafeed_separator . 
		$prod_image . $datafeed_separator . 
		$prod_price . $datafeed_separator . 
		$datafeed_currency . "\n";
	}

}
else {
	print "Query error: " . mysql_error();
}

// Function to return the Product URL based on your product ID
function function_to_get_product_url($prod_id){	
	return "http://www.example.com/product.php?id=" . $prod_id;
}

// Function to return the Product Image based on your product image or optionally Product ID
function function_to_get_product_image($prod_image){	
	return "http://www.example.com/product_images/" . $prod_image . ".jpg";	
}

function html_to_text($string){

	$search = array (
		"'<script[^>]*?>.*?</script>'si",  // Strip out javascript
		"'<[\/\!]*?[^<>]*?>'si",  // Strip out html tags
		"'([\r\n])[\s]+'",  // Strip out white space
		"'&(quot|#34);'i",  // Replace html entities
		"'&(amp|#38);'i",
		"'&(lt|#60);'i",
		"'&(gt|#62);'i",
		"'&(nbsp|#160);'i",
		"'&(iexcl|#161);'i",
		"'&(cent|#162);'i",
		"'&(pound|#163);'i",
		"'&(copy|#169);'i",
		"'&(reg|#174);'i",
		"'&#8482;'i",
		"'&#149;'i",
		"'&#151;'i",
		"'&#(\d+);'e"
		);  // evaluate as php
	
	$replace = array (
		" ",
		" ",
		"\\1",
		"\"",
		"&",
		"<",
		">",
		" ",
		"&iexcl;",
		"&cent;",
		"&pound;",
		"&copy;",
		"&reg;",
		"<sup><small>TM</small></sup>",
		"&bull;",
		"-",
		"uchr(\\1)"
		);
	
	$text = preg_replace ($search, $replace, $string);
	return $text;
	
}

function replace_not_in_tags($find_str, $replace_str, $string) {
	
	$find = array($find_str);
	$replace = array($replace_str);	
	preg_match_all('#[^>]+(?=<)|[^>]+$#', $string, $matches, PREG_SET_ORDER);	
	foreach ($matches as $val) {	
		if (trim($val[0]) != "") {
			$string = str_replace($val[0], str_replace($find, $replace, $val[0]), $string);
		}
	}	
	return $string;
}

?>