<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * Database settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/documentation/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', 'agasprosper31' );


/** Database hostname */

define( 'DB_HOST', 'mariadb:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


/** The database collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );


/**#@+

 * Authentication unique keys and salts.

 *

 * Change these to different unique phrases! You can generate these using

 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.

 *

 * You can change these at any point in time to invalidate all existing cookies.

 * This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         '~7Jh}#QT_I97:>J7K`UwLNe.AZ6BPof)4T0{Lokn5e?O7*/mPiOK.M=]_IW9s,&|' );

define( 'SECURE_AUTH_KEY',  'Y-G&!h(+3gIi%}52a}a5S!l-<{4W(P.B%mu7xRDo2bVQ~$HmRl}Erx4v]aY!lnm>' );

define( 'LOGGED_IN_KEY',    'O>FPD]|]cOub[j$0hIP Kf5 c@fc:nT%XBigdm)-}(,VzR/TdG;d4%e=>fu -BAR' );

define( 'NONCE_KEY',        'Yi4Z5k7w{u%X!zEZ7ZL]s)KBRwog2Q02DRU*f{zgXV()n`0]w|Z* [W_Za7KvkJZ' );

define( 'AUTH_SALT',        'Yh-o6wl_zQgS9 N~ifKbSWo9[NYm)TR+&<GysDMxG@$$E}s>aK35?Uy QTfS,pgt' );

define( 'SECURE_AUTH_SALT', 'ifj4i:jK2:C<cjZC^Jv=|:(RD35?k26lu]jb-kbh(! [24Zj4PJXV8C?uvJ[5@!h' );

define( 'LOGGED_IN_SALT',   'PbhZHE@zC./uwN=d]_Jz*;%})Gvu0nw+<BF}zUDUlia`XMwV>#1HkTDet,~a}N&@' );

define( 'NONCE_SALT',       'Mm8PY=JhjgF!26)~D03j>>k544`+n[;/i,6QoZx)>/EfYvF!I+gpla4,S2*F %a&' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wp_';


/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the documentation.

 *

 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
