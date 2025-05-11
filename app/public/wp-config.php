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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'XqhyDgdb7KP~&pNW<3x1E|)0zYlq~T:R)zjNHF7D9kR~[G]2A}B|e$:ghb%.l3Ai' );
define( 'SECURE_AUTH_KEY',   '0ZK3i3GAD5{>Z((:QaY6aO7#?8:N/[t{g*E~lhdoA_/|H0#jqc,6YcHk9y^0-u9 ' );
define( 'LOGGED_IN_KEY',     'R,SN0mV_$ 7Y}1a86CoWwx{[8nErFfcJO{ &!8plnt|SdHa.ooN!pTvfQ_U`0^tr' );
define( 'NONCE_KEY',         'yi0P]cY?`M>625T`A1tS/uNr[n?Ry}wnXOK|BZ7i=({!an!>AswT5@/onsBM4%!4' );
define( 'AUTH_SALT',         'LRD/IQT$z`g]avlC YJ2i~F&$(SU$faR#i_]]0$QHHa_8CgQ6]x&;7AVCcsgWX7S' );
define( 'SECURE_AUTH_SALT',  'W~}+$mg{rxw~~UVT?~E,_-})MuW.Q?(x]-rZ#?B{b6xf$JO_Da1Qm!U(])W.sr,c' );
define( 'LOGGED_IN_SALT',    'J,aP/.qu)Ng=~[E>|Fsg#b.SR(,YCU+-;&5:WtmR@HEwGP8s1p_jdx7|i=}MEnp)' );
define( 'NONCE_SALT',        'st?}Lxyr2zjtie ;0rASn2S2zv67*<:qU:U,*)9<tyjX@Y&R4ag0)HtA4Gi$I8<`' );
define( 'WP_CACHE_KEY_SALT', '6HTPmXVC9LRc6*.)eAUs.;D<c6`~Atepfk-2siihni:;P{jByL2+I?OnzJ=&$=+^' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
