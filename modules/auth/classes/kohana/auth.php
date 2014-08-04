<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * User authorization library. Handles user login and logout, as well as secure
 * password hashing.
 *
 * @package    Auth
 * @author     Kohana Team
 * @copyright  (c) 2007-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class Kohana_Auth
{

    // Auth instances
    protected static $instance;

    public static function instance() {
        if (!isset(Auth::$instance)) {
            // Load the configuration for this type
            $config = Kohana::config('auth');

            if (!$type = $config->get('driver')) {
                $type = 'ORM';
            }

            // Set the session class name
            $class = 'Auth_' . ucfirst($type);

            // Create a new session instance
            Auth::$instance = new $class($config);
        }

        return Auth::$instance;
    }

    /**
     * Create an instance of Auth.
     *
     * @return  object
     */
    public static function factory($config = array()) {
        return new Auth($config);
    }

    protected $session;
    protected $config;

    /**
     * Loads Session and configuration options.
     *
     * @return  void
     */
    public function __construct($config = array()) {
        // Clean up the salt pattern and split it into an array
        $config['salt_pattern'] = preg_split('/,\s*/', Kohana::config('auth')->get('salt_pattern'));

        // Save the config in the object
        $this->config = $config;

        $this->session = Session::instance();
    }

    abstract protected function _login($username, $password, $remember);

    abstract public function password($username);

    /**
     * Gets the currently logged in user from the session.
     * Returns FALSE if no user is currently logged in.
     *
     * @return  mixed
     */
    public function get_user() {
        if ($this->logged_in()) {
            return $this->session->get($this->config['session_key']);
        }

        return FALSE;
    }

    /**
     * Attempt to log in a user by using an ORM object and plain-text password.
     *
     * @param   string   username to log in
     * @param   string   password to check against
     * @param   boolean  enable auto-login
     * @return  boolean
     */
    public function login($username, $password, $remember = FALSE) {
        if (empty($password)) {
            return FALSE;
        }

        if (is_string($password)) {
            // Get the salt from the stored password
            //	$salt = $this->find_salt($this->password($username));
            // Create a hashed password using the salt from the stored password
            $password = md5($password);
        }

        return $this->_login($username, $password, $remember);
    }

    /**
     * Log out a user by removing the related session variables.
     *
     * @param   boolean  completely destroy the session
     * @param    boolean  remove all tokens for user
     * @return  boolean
     */
    public function logout($destroy = FALSE, $logout_all = FALSE) {
        if ($destroy === TRUE) {
            // Destroy the session completely
            Session::instance()->destroy();
        } else {
            // Remove the user from the session
            $this->session->delete($this->config['session_key']);

            // Regenerate session_id
            $this->session->regenerate();
        }

        // Double check
        return !$this->logged_in();
    }

    /**
     * Check if there is an active session. Optionally allows checking for a
     * specific role.
     *
     * @param   string   role name
     * @return  boolean
     */
    public function logged_in($role = NULL) {
        return $this->session->get($this->config['session_key'], FALSE);
    }

    /**
     * Creates a hashed password from a plaintext password, inserting salt
     * based on the configured salt pattern.
     *
     * @param   string  plaintext password
     * @return  string  hashed password string
     */
    public function hash_password($password, $salt = FALSE) {
        if ($salt === FALSE) {
            // Create a salt seed, same length as the number of offsets in the pattern
            $salt = substr($this->hash(uniqid(NULL, TRUE)), 0, count($this->config['salt_pattern']));
        }

        // Password hash that the salt will be inserted into
        $hash = $this->hash($salt . $password);

        // Change salt to an array
        $salt = str_split($salt, 1);

        // Returned password
        $password = '';

        // Used to calculate the length of splits
        $last_offset = 0;

        foreach ($this->config['salt_pattern'] as $offset) {
            // Split a new part of the hash off
            $part = substr($hash, 0, $offset - $last_offset);

            // Cut the current part out of the hash
            $hash = substr($hash, $offset - $last_offset);

            // Add the part to the password, appending the salt character
            $password .= $part . array_shift($salt);

            // Set the last offset to the current offset
            $last_offset = $offset;
        }

        // Return the password, with the remaining hash appended
        return $password . $hash;
    }

    /**
     * Perform a hash, using the configured method.
     *
     * @param   string  string to hash
     * @return  string
     */
    public function hash($str) {
        return hash($this->config['hash_method'], $str);
    }

    /**
     * Finds the salt from a password, based on the configured salt pattern.
     *
     * @param   string  hashed password
     * @return  string
     */
    public function find_salt($password) {
        $salt = '';

        foreach ($this->config['salt_pattern'] as $i => $offset) {
            // Find salt characters, take a good long look...
            $salt .= substr($password, $offset + $i, 1);
        }

        return $salt;
    }

    protected function complete_login($user) {
        // Regenerate session_id
        $this->session->regenerate();

        // Store username in session
        $_SESSION[$this->config['session_key']] = $user;

        return TRUE;
    }

    public function uri() {
        return $uri_admin = array(
            'Главная' => 'admin/index',
            'Меню' => 'admin/topmenu',
//            'Статические Страницы -> Преимущества' => 'admin/benefits',
            'Статические Страницы -> Страницы' => 'admin/pages',
            'Статические Страницы -> Новости и Акции' => 'admin/news',
            'Статические Страницы -> Сертификаты' => 'admin/certificates',
            'Статические Страницы -> Полезная информация -> Разделы' => 'admin/information/categories',
            'Статические Страницы -> Полезная информация -> Страницы' => 'admin/information/pages',
            'Блоки -> Преимущества' => 'admin/blocks/benefits',
//            'Блоки -> Где купить' => 'admin/blocks/wheretoby',
            'Блоки -> Позвоните нам' => 'admin/blocks/callus',
            'Блоки -> Как не ошибиться в выборе ванны' => 'admin/blocks/trouble_choose',
            'Блоки -> Скомплектовать ванну' => 'admin/blocks/grade',
            'Блоки -> Адреса' => 'admin/addresses',
            'Блоки -> Продукция Thermolux' => 'admin/blocks/production',
            'Блоки -> Футер' => 'admin/blocks/footer',
            'Слайдер' => 'admin/slider',
            'Товары -> Категории товаров' => 'admin/productscat',
            'Товары -> Справочник' => 'admin/directory',
            'Товары -> Типы аксессуаров' => 'admin/blocks/acctypes',
            'Товары -> Массажные опции' => 'admin/massage',
            'Товары -> Комплектация' => 'admin/grade',
            'Товары -> Товары' => 'admin/catalog',
            'Пользователи' => 'admin/internal',
            'Покупатели -> Заказы' => 'admin/orders',
            'Покупатели -> Отзывы' => 'admin/response',
            'Покупатели -> Звонки' => 'admin/callback',
            'Покупатели -> Поисковые фразы' => 'admin/searchlog',
            'Покупатели -> Связаться' => 'admin/contacts',
            'Покупатели -> Обратная связь' => 'admin/consult',
            'Покупатели -> Шаблоны' => 'admin/templates',
            'Покупатели -> Партнеры' => 'admin/partner',
            'Редактор css' => 'admin/css'
            //            'Mainmenu' => 'admin/mainmenu',
            //            'Edit Pages -> Edit Categorys' => 'admin/categorys',
            //            'Shopping Cart -> Edit Supplies' => 'admin/supplies',
            //            'FloorSand Services -> Sandman Offices' => 'admin/postcodes',
            //            'FloorSand Services -> Online Quotation' => 'admin/quotation',
            //            'FloorSand Services -> Maintenance Contract' => 'admin/maintenance',
            //            'FloorSand Services -> Booking Schedule' => 'admin/bookingshedule',
            //            'FloorSand Services -> Confirmed Booking' => 'admin/confirmedbooking',
            //            'FloorSand Services -> Online Diary' => 'admin/onlinediary',
            //            'FloorSand Services -> Testimonials' => 'admin/testimonials',
            //            'Консультации' => 'admin/consult',
            //            'FloorSand Services -> Promocodes' => 'admin/promocodes',
            //            'Edit Pages -> Edit Meta Tags' => 'admin/meta',
            //            'Edit Pages -> Edit Products Pages' => 'admin/products',
            //            'Edit Pages -> Edit Work Samples' => 'admin/servicesworksamples',
            //            'Edit Pages -> Edit Video Of Us Working' => 'admin/videoofusworking',
            //            'Часто задаваемые вопросы' => 'admin/faq',
            //            'Customer Profiles -> Online Quotation Area' => 'admin/userscustomers/onlinequotation',
            //            'Customer Profiles -> Maintenance Contract Area' => 'admin/userscustomers/maintenancecontract',
            //            'Customer Profiles -> Buy Supplies Area' => 'admin/userscustomers/buysupplies',
            //            'Sales -> Supplies Sales' => 'admin/supplies/check',
            //            'Продажи' => 'admin/sales',
            //            'Комплексные услуги' => 'admin/complex',
            //            'Продажи множ' => 'admin/manysales',
            //            'Sales -> All Sales' => 'admin/checkout',
            //            'Страница поиска' => 'search',


            //            'Vital Points' => 'admin/vitalpoints',
            //            'Emails & Marketing' => 'admin/emails'
        );
    }

}

// End Auth
