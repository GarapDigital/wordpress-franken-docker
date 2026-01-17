<?php
/** Enable W3 Total Cache */
define("WP_CACHE", true); // Added by W3 Total Cache

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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define("DB_NAME", getenv("DB_NAME"));

/** Database username */
define("DB_USER", getenv("DB_USER"));

/** Database password */
define("DB_PASSWORD", getenv("DB_PASSWORD"));

/** Database hostname */
define("DB_HOST", getenv("DB_HOST"));

/** Database charset to use in creating database tables. */
define("DB_CHARSET", "utf8mb4");

/** The database collate type. Don't change this if in doubt. */
define("DB_COLLATE", "");

/**#@+
 * Authentication unique keys and salts.
 *
 * These values should be provided via environment variables in production.
 * If not provided (for local/dev), generate cryptographically secure salts at runtime.
 *
 * You can generate production salts at https://api.wordpress.org/secret-key/1.1/salt/
 *
 * @since 2.6.0
 */
$salt_keys = [
    "AUTH_KEY",
    "SECURE_AUTH_KEY",
    "LOGGED_IN_KEY",
    "NONCE_KEY",
    "AUTH_SALT",
    "SECURE_AUTH_SALT",
    "LOGGED_IN_SALT",
    "NONCE_SALT",
];

foreach ($salt_keys as $salt_key) {
    $salt_val = getenv($salt_key);
    if ($salt_val && $salt_val !== "put your unique phrase here") {
        define($salt_key, $salt_val);
    } else {
        // Generate a secure random salt for non-production environments or if env is missing.
        // Use random_bytes() when available; fallback to openssl_random_pseudo_bytes().
        try {
            $rand = bin2hex(random_bytes(32));
        } catch (Exception $e) {
            $rand = bin2hex(openssl_random_pseudo_bytes(32));
        }
        define($salt_key, $rand);
    }
}

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = "wp_";

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
/*
 * Control debugging via APP_ENV environment variable.
 * - If APP_ENV=development -> enable debug display and logs
 * - Otherwise -> disable display but keep logging enabled
 */
$app_env = strtolower((string) getenv("APP_ENV"));

if ($app_env === "development" || $app_env === "dev") {
    define("WP_DEBUG", true);
    define("WP_DEBUG_LOG", true);
    define("WP_DEBUG_DISPLAY", true);
} else {
    define("WP_DEBUG", false);
    define("WP_DEBUG_LOG", true);
    define("WP_DEBUG_DISPLAY", false);
}

/**
 * Prevent administrators from editing plugin and theme files from the dashboard.
 * This helps reduce risk if an admin account is compromised.
 */
define("DISALLOW_FILE_EDIT", true);

/* Add any custom values between this line and the "stop editing" line. */

/**
 * Define WordPress constants.
 */

define("WP_HOME", getenv("WP_HOME"));
define("WP_SITEURL", getenv("WP_SITEURL"));

define("WP_ENVIRONMENT_TYPE", getenv("APP_ENV"));

/**
 * Define Redis constants.
 */
define("WP_REDIS_HOST", getenv("REDIS_HOST"));
define("WP_REDIS_PORT", getenv("REDIS_PORT"));
define("WP_REDIS_TIMEOUT", 1);
define("WP_REDIS_READ_TIMEOUT", 1);
define("WP_REDIS_DATABASE", 0);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined("ABSPATH")) {
    define("ABSPATH", __DIR__ . "/");
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . "wp-settings.php";
