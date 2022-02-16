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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kreatives' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'f`pW/s~Q9O@=uLJYkf`?G.Ulr_qb<{tg@sp)ixP #N,5rMAhm!f#$/BIy?([_K$A' );
define( 'SECURE_AUTH_KEY',  '9~PoE[9q.?B^0GRW{>fh</K<lnd-V{KD>ECEE[*C)?pa{te_5dm`A)jzq|i#souh' );
define( 'LOGGED_IN_KEY',    '/}~1q1z1w@9AgyljMDxMCb[8?*wcE_ebz3;,u20_i10B5E;4)V4FTCg)%aHHx]`l' );
define( 'NONCE_KEY',        '5>=!:k!a/}cb}:TX.fVEk}EoNlLjBiNu`q<}<MK;|{9J3eD^uFw&0[lbO40^em_e' );
define( 'AUTH_SALT',        '<)#r=`;UK=[MvZE^29A7buKuo@BCjBr }S!Ogs,[om$F/ZBXl2XeH1DX/Ne&baFl' );
define( 'SECURE_AUTH_SALT', 'm5nil/@BQf%^v#yW<XO?$&F%T#D 2ON -IfToN[T0SbMk%x?4QOG^hyv;zZlbqiT' );
define( 'LOGGED_IN_SALT',   'd4]Azhk%OjNw,!hezoGqmGMyN_/K,UiLwg0B<@WY`|xeXbGB}w8:bX[gh#U-kH|]' );
define( 'NONCE_SALT',       '>-L-@5x&3^(>SDCFme>)|GHG:5T#$oYJY|*2x{=9x[Dj0Er}11E(`<Wb>7GA;_-S' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
