<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'service-health4' );

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
define( 'AUTH_KEY',         'wc?l|kwgG#[qA1,sr~3gm#&1xkt45]BXI};ze#4EEd?Sae9uRgA*[S@P+5II0<jR' );
define( 'SECURE_AUTH_KEY',  '+iCj[,.aO!s?*NKfW`J&zH<{t(g93K$zhW^k$mUe98ib?!T%Y<9M>~XV!&3t1Y+C' );
define( 'LOGGED_IN_KEY',    'g?JUZtda/iEX,CG:iBw{(^(nw?rrtf&0fbP89SIGGO::Y637JXWcuhuBJ7852NLc' );
define( 'NONCE_KEY',        'L6[^7{<ZwZ6]EXw`b{WU8p7i9.R+HCjuk$HPH1k@F55}<@9G{OrxuYML7+/dzp?k' );
define( 'AUTH_SALT',        'G_9[>tHp#S4YE]@X,NiSu)ND8<93fK.01y{$w&%C}8#tW>6n+2,9F=OAf}im};-H' );
define( 'SECURE_AUTH_SALT', 'oql}{.75X0L[JIp9{R,eL<~B:#;{q[z>YD:UO`0lw9=y<1CEc~i]o{t8Ihv$mN!5' );
define( 'LOGGED_IN_SALT',   'C#O^6n,kfuW%>l|:1VAm>cQ}G!7S|Lkw%@WQ$gSKC|NK#VhhTqf1wOKRdhHn@@nQ' );
define( 'NONCE_SALT',       'Sc qKE8|* `a=K*TMe>zCcGd>p%KSz|A4!AIF1]K9a|!$zyCq8HloB}UyHX8EFP!' );

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
