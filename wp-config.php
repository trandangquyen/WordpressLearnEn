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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         'i)8EXNeb`]}dU$q2)!/J$i%(yhP(=G_iN[dte0!HTKV!zjw&yZ&~4Xd%%&DM7{EN');
define('SECURE_AUTH_KEY',  'E#>VeOT0q_yH3;FQdTmK.ZgkX~ZMtu3Z*p&>Urajv+S[ge`B|XZ%H,np2g!D,+XM');
define('LOGGED_IN_KEY',    '*yd[Cp:r,L.guJ9e|[}O3wq{GT#yN?O[%;i!|}seJ0EAiWO#!|kM7Jn#YAx`a&>)');
define('NONCE_KEY',        '~`Tw4eKje?S@uAGO!juC1k;Zu3R=+IGn-5z/_d-Q*L}f&yzqa}UhsRl_62^tTm }');
define('AUTH_SALT',        'la6+J^M]^qN- @m,o{3a`6rbaLCwfhuk$>tck}f[n$?A8W`Qv2X39aQqN5;~z|bR');
define('SECURE_AUTH_SALT', 't=vR1PC]XJ bcE$=!Uvv=m:1K^F12V]9$GYff`;?P_#jv5GFnP(8O9R{*7CN->fd');
define('LOGGED_IN_SALT',   'zqOl3X8(9ES}8XS$mGRO(<4?aC<N>l<fzemD>/kkQV-Eb+0W5O3@Dy=a;%[=ZIcW');
define('NONCE_SALT',       '0|I:U0&iqnvUL;r3w[Z1w]VKJ<e]=KU+36UCJd7?4eX{G{^vJr,*yyS<z)!6lS-P');

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
