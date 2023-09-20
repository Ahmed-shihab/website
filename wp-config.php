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
define( 'DB_NAME', 'website' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         '4^w`c([cqoj]i,P4d[Y&aXAEBD25Km%I<Z<2UasDTz#D{PY ;tC.VFq$Q6;f=89Z' );
define( 'SECURE_AUTH_KEY',  '02Y67sChd%I}e:ZJ-W~XlGA7x;iqpBKUky;TadF+{=}8Vq5w?kJ<_!ewKgz3O%Ih' );
define( 'LOGGED_IN_KEY',    'Drey!g8R;?>W:5^6?WLNS$X66mx2 jCI#U5-dE6u)nBRSwcthL[SU`&AAMa:*$IQ' );
define( 'NONCE_KEY',        'NCahO0Nt%Y:C[Pkg4|UN03>Q|%72=m+=x}Cj]G5Q_phbA,>;&J(yoy:5tCOV5y&6' );
define( 'AUTH_SALT',        '.D,:2Q]P mAJ{/!sgM{.9y;BLrVT6&]eyXk;.!(&:O,.C,WlZly>RK0Qv0UO}O0`' );
define( 'SECURE_AUTH_SALT', 'J9]?CR%4Zi.unev9j+7:YMZ7htplkGdD d?hTB_95b<J*=^<)Tw!zUFzOS,|n93H' );
define( 'LOGGED_IN_SALT',   'Zj]g=Zv5BHht;[c:o-KLxJpBS>83dy[O/o(vSR%++_@T.1!sdUb&];S`2u0H27N>' );
define( 'NONCE_SALT',       'IS(KIkBA={qUIHqupc]k47FQV7NHybXsX%!JV!U}3nw@Zevst3k>gakwi|FA`-7z' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
