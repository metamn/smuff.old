<?php
/** WordPress's config file **/
/** http://wordpress.org/   **/

// ** MySQL settings ** //
define('DB_NAME', 'v1');     // The name of the database
define('DB_USER', 'smuff');     // Your MySQL username
define('DB_PASSWORD', 'smuffdotro'); // ...and password
define('DB_HOST', 'localhost');     // ...and the server MySQL is running on
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY', '-lnoZ`nPD2&cC/&9teUsB4>&di|AIRzj<7q&9}un0Hj+E@d+84g67Q,2BQ<Scp*r');
define('SECURE_AUTH_KEY', 'SPI#E-}st<K3z1KC[q}qX5).<&I749V!}*!_lg~tHa)74D%[8E|JOH]t(V-HK}|O');
define('LOGGED_IN_KEY', ',)4n-kt@GuWJWVGpmLB>b-[DcclLx.uBy<F6bKm%xToszJy}ON>kL-l7O!q|/+CO');
define('NONCE_KEY', 'Rd!qa4(5|e_2R:+*+v_qL Ta ]njRVNi]-+NA6Hht`{.9h3a+yH@tJ>CfHwQ!u~*');

$table_prefix  = 'wp_cp53mf_';   // example: 'wp_' or 'b2' or 'mylogin_'

// Turning off Post Revisions. Comment this line out if you would like them to be on.

define('WP_POST_REVISIONS', false );

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-includes/languages.
// For example, install de.mo to wp-includes/languages and set WPLANG to 'de'
// to enable German language support.
define ('WPLANG', 'ro_RO');

/* Stop editing */

$server = DB_HOST;
$loginsql = DB_USER;
$passsql = DB_PASSWORD;
$base = DB_NAME;

define('ABSPATH', dirname(__FILE__).'/');

// Get everything else
require_once(ABSPATH.'wp-settings.php');
?>
