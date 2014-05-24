<?php

defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------
error_reporting(E_ALL);
/**
 * Set the default time zone.f
 *
 * @see  http://docs.kohanaphp.com/features/localization#time
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Moscow');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://docs.kohanaphp.com/features/autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

//-- Configuration and initialization -----------------------------------------

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
$config = include APPPATH . 'config/general.php';
Kohana::init(array('base_url' => $config['base_url'], 'index_file' => '', 'profile' => false));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
//Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
     'auth'       => MODPATH.'auth',       // Basic authentication
    // 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
    'database' => MODPATH . 'database', // Database access
    'image' => MODPATH . 'image', // Image manipulation
    'orm' => MODPATH . 'orm', // Object Relationship Mapping
    'atemail' => MODPATH . 'atemail', // Object Relationship Mapping
    'mptt' => MODPATH . 'mptt', // Object Relationship Mapping
    'geoip' => MODPATH.'geoip3', // Paging of results
        // 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
));


require Kohana::find_file('classes', 'helpers/AuthAdapter');
require Kohana::find_file('classes', 'helpers/MultiORM');
require Kohana::find_file('classes', 'helpers/ViewMessage');
require Kohana::find_file('classes', 'helpers/ViewHead');
require Kohana::find_file('classes', 'helpers/Email');
require Kohana::find_file('classes', 'helpers/ViewFormError');
require Kohana::find_file('classes', 'helpers/hsbc');
require Kohana::find_file('classes', 'helpers/xlsexporter');
require Kohana::find_file('classes', 'helpers/globaliris');
require Kohana::find_file('classes', 'helpers/Phpmailer');
require Kohana::find_file('classes', 'helpers/Geoipthermo');
require Kohana::find_file('classes', 'helpers/AdminHelper');
require Kohana::find_file('classes', 'helpers/AdminInfo');
require Kohana::find_file('classes', 'helpers/FrontHelper');
require Kohana::find_file('classes', 'helpers/ImageWork');
require Kohana::find_file('classes', 'helpers/Mails');
require Kohana::find_file('classes', 'helpers/Safely');
require Kohana::find_file('classes', 'helpers/Morphy/src/common');

        $dir = $_SERVER['DOCUMENT_ROOT'].'/application/classes/helpers/Morphy/dicts/';

        $lang = 'ru_RU';
        $opts = array(
            'storage' => PHPMORPHY_STORAGE_FILE,
        );
        try
        {
            $morphy = new phpMorphy($dir, $lang, $opts);
   
            
        }
        catch(phpMorphy_Exception $e)
        {
            die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
        }


AuthAdapter::init();
//ViewMessage::init();
I18n::$lang = 'en-US';

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::set('admin', 'admin(/<controller>(/<action>(/<id>)(/<sort>)))')
        ->defaults(array(
            'directory' => 'admin',
            'controller' => 'login',
            'action' => ''
        ));

Route::set('checkout', 'checkout(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'checkout',
            'action' => 'index'
        ));

Route::set('error', 'error(/<action>(/<id>))')
    ->defaults(array(
        'controller' => 'error',
        'action' => 'index'
    ));

Route::set('maintenance', 'online-maintenance(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'maintenance',
            'action' => 'index'
        ));

Route::set('captcha', 'captcha(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'captcha',
            'action' => 'captcha'
        ));

Route::set('bookingshedule', 'booking-shedule(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'bookingshedule',
            'action' => 'index'
        ));

Route::set('sandmanresult', 'sandman-result(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'sandmanresult',
            'action' => 'index'
        ));

Route::set('quotation', 'online-quotation(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'quotation',
            'action' => 'index'
        ));

Route::set('ordersuppliescheckout', 'order-supplies-checkout(/<id>)')
        ->defaults(array(
            'controller' => 'supplies',
            'action' => 'ordersuppliescheckout'
        ));

Route::set('ordersuppliesproduct', 'order-supplies-product(/<id>)')
        ->defaults(array(
            'controller' => 'supplies',
            'action' => 'ordersuppliesproduct'
        ));

Route::set('supplies', 'supplies(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'supplies',
            'action' => 'index'
        ));

Route::set('testimonials', 'testimonials(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'testimonials',
            'action' => 'index'
        ));

Route::set('videoofusworking', 'video-of-us-working(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'videoofusworking',
            'action' => 'index'
        ));

Route::set('servicesworksamples', 'services-work-samples(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'servicesworksamples',
            'action' => 'index'
        ));

Route::set('contactus', 'contact-us(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'contactus',
            'action' => 'index'
        ));


Route::set('makeorder', 'makeorder(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'makeorder',
            'action' => 'index'
        ));
        
        Route::set('complex', 'complex(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'complex',
            'action' => 'index'
        ));

Route::set('response', 'response(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'response',
            'action' => 'index'
        ));
        Route::set('forhome', 'forhome(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'forhome',
            'action' => 'index'
        ));
              Route::set('forbusiness', 'forbusiness(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'forbusiness',
            'action' => 'index'
        ));
Route::set('consult', 'consult(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'consult',
            'action' => 'index'
        ));

Route::set('callback', 'callback(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'callback',
            'action' => 'index'
        ));

Route::set('vitalpoints', 'vital-points(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'vitalpoints',
            'action' => 'index'
        ));
Route::set('portfolio', 'portfolio(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'portfolio',
            'action' => 'index'
        ));
Route::set('information', 'information(/<category>(/<id>))')
    ->defaults(array(
        'controller' => 'information',
        'action' => 'index'
    ));

Route::set('news', 'news(/<category>(/<id>))')
    ->defaults(array(
        'controller' => 'news',
        'action' => 'index'
    ));
Route::set('certificates', 'certificates(/<category>(/<id>))')
    ->defaults(array(
        'controller' => 'certificates',
        'action' => 'index'
    ));
Route::set('gradebath', 'gradebath(/<category>(/<id>))')
    ->defaults(array(
        'controller' => 'gradebath',
        'action' => 'index'
    ));
Route::set('orders', 'orders(/<category>(/<id>))')
    ->defaults(array(
        'controller' => 'orders',
        'action' => 'index'
    ));
Route::set('catalog', 'catalog(/<category>(/<id>))')
    ->defaults(array(
        'controller' => 'catalog',
        'action' => 'index'
    ));

Route::set('search', 'search(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'search',
            'action' => 'index'
        ));

Route::set('partner', 'partner(/<action>(/<id>))')
    ->defaults(array(
        'controller' => 'partner',
        'action' => 'index'
    ));

Route::set('index', 'index(/<action>(/<id>))')
        ->defaults(array(
            'controller' => 'index',
            'action' => 'index'
        ));

Route::set('default', '(<id>)')
        ->defaults(array(
            'controller' => 'index',
            'action' => 'index',
        ));
Route::set('files', '(<file>)',array('file' => '.+'))
        ->defaults(array(
                'controller' => 'error',
                'action'     => '404',
            
        ));
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 'XMLHttpRequest' == $_SERVER['HTTP_X_REQUESTED_WITH']) {
    ViewMessage::drawMessages();
}

/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */
/**
* Set the production status
*/
define('IN_PRODUCTION', FALSE);
 
/**
* Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
* If no source is specified, the URI will be automatically detected.
*/
$request = Request::instance();
 
try
{
    $request->execute();
}
catch (ReflectionException $e)
{
    die($e);
   $requestis = explode('/', $request->uri);   
   if($requestis[0]=='admin') {
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'login')));
   } else {
        $request = Request::factory('error/404')->execute();
   }
        
}
catch (Exception $e)
{    
   die($e);
   $requestis = explode('/', $request->uri);   
   if($requestis[0]=='admin') {
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'login')));
   } else {
        $request = Request::factory('error/404')->execute();
   }
}
echo $request->send_headers()->response;
