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
define('DB_NAME', 'luticavn_luticawordpress');

/** MySQL database username */
define('DB_USER', 'luticavn_samihustk56');

/** MySQL database password */
define('DB_PASSWORD', 'lQcGCABnlEc1');

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
define('AUTH_KEY',         'jQ9f`8QQLaKd!lY,s@{B&>#iQKXJkR@}Y#qBM$0$,MN{p@GRs7a~Kbe@w??=~B2=');
define('SECURE_AUTH_KEY',  '~V+|>Np^T^+s?P?+0v1_7R:=by]~e5iY*lNzh9YP]`m.?)>QVh]I`ON0d(g`v`lT');
define('LOGGED_IN_KEY',    '_ENh6T)? x-HS]C0?ihYM>d3Ji>wjj~iUHB}#r]Wc5SjF[uP~k3}1vUTu+t9Ac#F');
define('NONCE_KEY',        'QzD?MRU_qHHu}U)cs+yQqn=w;Qj $lmMs7Gu!%!lekjT^{~^@](KRiaV?BvD^}$o');
define('AUTH_SALT',        'Y|YWjeKhM|+o(YWrM8dQ@NRt_x?7/Wq9M!6P@Dg/6q%?:UrAEpVSf+(oCwEU9OX,');
define('SECURE_AUTH_SALT', 't&=^UguKMvgY!1oap5F|1gk#:@I}i?N]/v4xEqwSysD<vwB(j,B4|*)Kk.9N3>iM');
define('LOGGED_IN_SALT',   'ksk/6|YIe{n#|LAIu<]yJjpf3W[cBN?(~zP}|i3NT1zfU# 8Z;3vf->;2<,`b`oy');
define('NONCE_SALT',       ':6- X45Byyhn|H6/zm/.zD8,&:lL5x!jnY?&[Rrtd*D;!_9lc1M6%51KhH!L1zOG');

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
