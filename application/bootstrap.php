<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Kiev');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'uk_UA.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('uk_ua');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
//PRODUCTION; DEVELOPMENT
Kohana::$environment = Kohana::DEVELOPMENT;

if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => 'http://www.vyshnya.lviv.ua/',
    'index_file' => false,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	'database'   => MODPATH.'database',   // Database access
	'image'      => MODPATH.'image',      // Image manipulation
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
    'pagination'  => MODPATH.'pagination',  // Pagination
    'orm-mptt'        => MODPATH.'orm-mptt',    // Object Relationship Mapping MPTT
    'calendar'        => MODPATH.'calendar',    // Calendar
    'captcha'    => MODPATH.'captcha', //Captcha
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
//if ( ! Route::cache()) {
Route::set('error', 'error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
        ->defaults(array(
                'controller' => 'error',
));

Route::set('widgets', 'widgets/<controller>(/<param>)', array('param' => '.+'))
	->defaults(array(
            'directory'  => 'widgets',
            'action'     => 'index',
	));
    
Route::set('auth', '<action>', array('action' => 'login|logout|register|restore_password|checkcode'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'auth',
	));
    
Route::set('poll', 'poll')
	->defaults(array(
        'directory'  => 'index',
        'action' => 'index',
		'controller' => 'poll',
	));
    
Route::set('legaladvice', 'page/legaladvice')
	->defaults(array(
                'directory'  => 'index',
                'action' => 'legaladvice',
		'controller' => 'page',
	));

Route::set('contact', 'page/contact')
	->defaults(array(
                'directory'  => 'index',
                'action' => 'contact',
		'controller' => 'page',
	));

Route::set('page', 'page(/<page_alias>)')
	->defaults(array(
        'directory'  => 'index',
        'action' => 'index',
		'controller' => 'page',
	));
    
Route::set('photogallery', 'photogallery(/<photo_alias>)(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
        'action' => 'index',
        'controller' => 'photogallery',
	));

Route::set('search', 'search(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'search',
		'action'     => 'index',
	));

Route::set('materialsstudents', 'materialsstudents/<action>(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'materialsstudents',
        'action' => 'show',
	));
    
Route::set('materialsstudentszaoch', 'materialsstudentszaoch/<action>(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'materialsstudentszaoch',
        'action' => 'show',
	));

Route::set('materialsteachers', 'materialsteachers/<action>/<id>(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'materialsteachers',
        'action' => 'show',
	));
    
Route::set('materialsstudentsadd', 'materialsstudentsadd/<action>(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'materialsstudentsadd',
	));

Route::set('materialsstudentszaochadd', 'materialsstudentszaochadd/<action>(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'materialsstudentszaochadd',
	));

Route::set('news', 'news(/page<page>)',array('page' => '[0-9]+'))
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'news',
		'action'     => 'index',
	));

Route::set('admin', 'admin(/<controller>(/<action>(/page<page>)(/<id>)))',array('page' => '[0-9]+'))
	->defaults(array(
            'directory'  => 'admin',
            'controller' => 'main',
            'action'     => 'index',
	));


Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
        'directory'  => 'index',
		'controller' => 'main',
		'action'     => 'index',
	));
//Route::cache(TRUE);
//}