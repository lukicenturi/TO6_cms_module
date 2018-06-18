<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '02_cms_module_06');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'q}oZlbylk/e3wu:H0tRA4n4ebsf 1T>gF73JeSHLzbHn%MD=8x+cY=MGyyW`~7)R');
define('SECURE_AUTH_KEY',  'B:.^0>X]8)l+[B(Gw(lQz6SMmnMKjMHG&n1M96>28@44 l<x94[qQ1q>t^|?2afA');
define('LOGGED_IN_KEY',    'PEkh,3w.3c,MpSH<-*4R606HuwQ_SNB)(5G:DBQ3qPY4l[.ZXB$jkDtzY!wX 00r');
define('NONCE_KEY',        '@)S<%ebwUHq}?EM+xg7xKko{QdSnuCbkteva2?<)C/L-Bat$SV0mR6+?1X9pfLKz');
define('AUTH_SALT',        'y7p]gExyqd)[;@2$%qPj%pvukzm#`cO:Q9%APyesrBh~.oDG3$YQe6308t@}]Y<M');
define('SECURE_AUTH_SALT', ')c7UGj*Y;{f`E!Uzlu/Xiz-(P=$P]h!F*NY,cp@xaU4.lrNg31 9(X6m_O`dw+^4');
define('LOGGED_IN_SALT',   'D[0V@#b}rbfo$>.Ja)6uW/ALUI-Hfg-rYqD3)U>}jC>Y,GAF(bGaF1ClGsy1O q.');
define('NONCE_SALT',       '`[o5d;n2B=KP28-)PoO&5$Sfw*g*R&}4w};E_b]> G`8^8z-3]tN]$9gG^`p-Br+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
