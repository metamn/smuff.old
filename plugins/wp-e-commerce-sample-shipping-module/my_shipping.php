<?php
/*
 Plugin Name: WP E-Commerce Skeleton Shipping Method
 Plugin URI: http://getshopped.org/resources/docs/get-involved/writing-a-new-shipping-module/
 Description: Sample Custom Shipping Module For WP E-Commerce
 Version: 0.2
 Author: Lee Willis
 Author URI: http://www.leewillis.co.uk/
*/

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 */

class my_shipping {

	var $internal_name;
	var $name;
	var $is_external;

	function my_shipping () {

		// An internal reference to the method - must be unique!
		$this->internal_name = "my_shipping";
		
		// $this->name is how the method will appear to end users
		$this->name = "My Shipping Method";

		// Set to FALSE - doesn't really do anything :)
		$this->is_external = FALSE;

		return true;
	}
	
	/* You must always supply this */
	function getName() {
		return $this->name;
	}
	
	/* You must always supply this */
	function getInternalName() {
		return $this->internal_name;
	}
	
	
	/* Use this function to return HTML for setting any configuration options for your shipping method
	 * This will appear in the WP E-Commerce admin area under Products > Settings > Shipping
         *
	 * Whatever you output here will be wrapped inside the right <form> tags, and also
	 * a <table> </table> block */

	function getForm() {

		$shipping = get_option('my_shipping_options');
		
		$output .= '<tr>';
		$output .= '	<td>';
		$output .= '		Posta Romana, cu plata la livrare:<br/>';
		$output .= '		<input type="text" name="shipping[posta]" value="'.htmlentities($shipping['posta']).'"><br/>';
		$output .= '	</td>';
		$output .= '</tr>';
		
		$output .= '<tr>';
		$output .= '	<td>';
		$output .= '		Fan Curier, cu plata la livrare:<br/>';
		$output .= '		<input type="text" name="shipping[ramburs]" value="'.htmlentities($shipping['ramburs']).'"><br/>';
		$output .= '	</td>';
		$output .= '</tr>';
		
		$output .= '<tr>';
		$output .= '	<td>';
		$output .= '		Fan Curier, cu plata prin transfer bancar:<br/>';
		$output .= '		<input type="text" name="shipping[transfer]" value="'.htmlentities($shipping['transfer']).'"><br/>';
		$output .= '	</td>';
		$output .= '</tr>';
		
		$output .= '<tr>';
		$output .= '	<td>';
		$output .= '		Ridicare din sediul Tg. Mures:<br/>';
		$output .= '		<input type="text" name="shipping[ridicare]" value="'.htmlentities($shipping['ridicare']).'"><br/>';
		$output .= '	</td>';
		$output .= '</tr>';

		return $output;
	}
	


	/* Use this function to store the settings submitted by the form above
	 * Submitted form data is in $_POST */

	function submit_form() {

		if($_POST['shipping'] != null) {

			$shipping = (array)get_option('my_shipping_options');
			$submitted_shipping = (array)$_POST['shipping'];

			update_option('my_shipping_options',array_merge($shipping, $submitted_shipping));

		}

		return true;

	}
	
	/* If there is a per-item shipping charge that applies irrespective of the chosen shipping method
         * then it should be calculated and returned here. The value returned from this function is used
         * as-is on the product pages. It is also included in the final cart & checkout figure along
         * with the results from GetQuote (below) */

	function get_item_shipping(&$cart_item) {

		global $wpdb;

		// If we're calculating a price based on a product, and that the store has shipping enabled

		$product_id = $cart_item->product_id;
		$quantity = $cart_item->quantity;
		$weight = $cart_item->weight;
		$unit_price = $cart_item->unit_price;

    		if (is_numeric($product_id) && (get_option('do_not_use_shipping') != 1)) {

			$country_code = $_SESSION['wpsc_delivery_country'];

			// Get product information
      			$product_list = $wpdb->get_row("SELECT *
			                                  FROM `".WPSC_TABLE_PRODUCT_LIST."`
				                         WHERE `id`='{$product_id}'
			                                 LIMIT 1",ARRAY_A);

       			// If the item has shipping enabled
      			if($product_list['no_shipping'] == 0) {

        			if($country_code == get_option('base_country')) {

					// Pick up the price from "Local Shipping Fee" on the product form
          				$additional_shipping = $product_list['pnp'];

				} else {

					// Pick up the price from "International Shipping Fee" on the product form
          				$additional_shipping = $product_list['international_pnp'];

				}          

        			$shipping = $quantity * $additional_shipping;

			} else {

        			//if the item does not have shipping
        			$shipping = 0;

			}

		} else {

      			//if the item is invalid or store is set not to use shipping
			$shipping = 0;

		}

    		return $shipping;	
	}
	


	/* This function returns an Array of possible shipping choices, and associated costs.
         * This is for the cart in general, per item charges (As returned from get_item_shipping (above))
         * will be added on as well. */

	function getQuote() {

		global $wpdb, $wpsc_cart;

		// This code is let here to show how you can access delivery address info
		// We don't use it for this skeleton shipping method

		if (isset($_POST['country'])) {

			$country = $_POST['country'];
			$_SESSION['wpsc_delivery_country'] = $country;

		} else {

			$country = $_SESSION['wpsc_delivery_country'];

		}
		
		// Retrieve the options set by submit_form() above
		$my_shipping_rates = get_option('my_shipping_options');
			  
		// Return an array of options for the user to choose
		// The first option is the default
		return array ("Posta Romana, cu plata la livrare" => (float) $my_shipping_rates['posta'],
		              "Fan Curier, cu plata la livrare" => (float) $my_shipping_rates['ramburs'],
		              "Fan Curier, cu plata prin transfer bancar" => (float) $my_shipping_rates['transfer'],
		              "Ridicare din sediul Tg. Mures" => (float) $my_shipping_rates['ridicare']);

	}
	
	
} 

function my_shipping_add($wpsc_shipping_modules) {

	global $my_shipping;
	$my_shipping = new my_shipping();

	$wpsc_shipping_modules[$my_shipping->getInternalName()] = $my_shipping;

	return $wpsc_shipping_modules;
}
	
add_filter('wpsc_shipping_modules', 'my_shipping_add');
?>
