<?php

define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') );
define( 'DB_USER', getenv('WORDPRESS_DB_USER') );
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') );
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') );
define( 'DB_CHARSET', getenv('WORDPRESS_DB_CHARSET', 'utf8') );
define( 'DB_COLLATE', getenv('WORDPRESS_DB_COLLATE', '') );

define('WP_CONTENT_DIR', '/var/www/wp-content');

define( 'WP_ALLOW_MULTISITE', true);
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
define( 'DOMAIN_CURRENT_SITE', '127.0.0.1' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );

$table_prefix  = getenv('TABLE_PREFIX') ?: 'wp_';

foreach ($_ENV as $key => $value) {
    $capitalized = strtoupper($key);
    if (!defined($capitalized)) {
        define($capitalized, $value);
    }
}

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

// wp-secrets
define( 'AUTH_KEY',         getenv('WORDPRESS_AUTH_KEY'));
define( 'SECURE_AUTH_KEY',  getenv('WORDPRESS_SECURE_AUTH_KEY'));
define( 'LOGGED_IN_KEY',    getenv('WORDPRESS_LOGGED_IN_KEY'));
define( 'NONCE_KEY',        getenv('WORDPRESS_NONCE_KEY'));
define( 'AUTH_SALT',        getenv('WORDPRESS_AUTH_SALT'));
define( 'SECURE_AUTH_SALT', getenv('WORDPRESS_SECURE_AUTH_SALT'));
define( 'LOGGED_IN_SALT',   getenv('WORDPRESS_LOGGED_IN_SALT'));
define( 'NONCE_SALT',       getenv('WORDPRESS_NONCE_SALT'));

define( 'WP_DEBUG', getenv('WORDPRESS_DEBUG', false ));

require_once(ABSPATH . 'wp-settings.php');
