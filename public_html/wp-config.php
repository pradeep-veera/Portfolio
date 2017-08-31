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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'id2657632_wp_eccc903731c1b3f8b9edd0ea38b0cebb' );

/** MySQL database username */
define( 'DB_USER', 'id2657632_wp_eccc903731c1b3f8b9edd0ea38b0cebb' );

/** MySQL database password */
define( 'DB_PASSWORD', '07aec7a7b31f1b574e1e691405b1b92e2c304843' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '>$;^H&g]Qi11C7HE~PNymIHM;H@SCVk@X0[WDD}-D8VYo%@Gy8&$RVIfxi,9c~vU' );
define( 'SECURE_AUTH_KEY',  ')fOk&g@j=?)|%;5(m/4uRDcDq1pOY5/Jq +h>1RI/#k3xMBA&aZ9e_&X<sN.Vg{_' );
define( 'LOGGED_IN_KEY',    'JKvN_S8:=0I/,90F$a+K#}m5ZJK-*ch]^1Z]@_fN?}{m^Wg}K?mI0W$I8~}$=hh6' );
define( 'NONCE_KEY',        'Z,=tUbCrq3,|=IK56@q)ZbIpQ7M8SbEU)q.ncy,.ZQ8a_6,0gXG3cIl%Qon<osQU' );
define( 'AUTH_SALT',        'r+;zHWKwd0Bn6^DCGq9h+G<17&jV-?lAT%~[!47ED,-PoZjG%uQPK$QrDBbqWUf(' );
define( 'SECURE_AUTH_SALT', 'Q,=-+T1/My]|QdVP:l|RS8CW>S<*ukC*6lugk~2,.$C;c3@UBJ~F-nnvC_&7BnOt' );
define( 'LOGGED_IN_SALT',   '5|f{-G+S m,[uP}H/c?y>3}jA^CMedYS4ce`_+t:(0:<E?Fc{_c[knoMG7eS03|=' );
define( 'NONCE_SALT',       's0?q@*pJ~e$)X;V{R1Qza-(N7VB.Lzsyx{pth7S;%:NX;KWzH&lXXO2)*9+3Lo]J' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
