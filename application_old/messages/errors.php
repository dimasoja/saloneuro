<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(

   'email' => Array
    (
        'check_email' => 'Invalid email',
        'email'       => 'This is not a valid e-mail format. Please check and re-enter your e-mail address',
        'email_exists'=> ':field already exists'
    ),
    'phone' => Array
    (
        'regex' => 'Telephone number does not match required format.'
    )
    ,
     'mphone' => Array
    (
        'regex' => 'Mobile number does not match required format.'
    )
    );