<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'driver' => 'ORM',
	'hash_method' => 'md5',
	'salt_pattern' => '2, 5, 7, 10, 11, 18, 26, 28, 30, 31',
	'lifetime' => 1209600,
	'session_key' => 'auth_user',
	'users' => array
	(
		// 'admin' => 'b3154acf3a344170077d11bdb5fff31532f679a1919e716a02',
	),
);
