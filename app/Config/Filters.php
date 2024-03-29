<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'Adminfilter' => \App\Filters\AdminFilter::class,
		'SelerFilter' => \App\Filters\SelerFilter::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			// 'csrf',
			'Adminfilter' => ['except' => ['/', 'login', 'index/*', 'index', 'home/*', 'home', 'search', 'search/*', 'detail_smartphone/*', 'detail_smartphone', 'detail_seller/*']],
			'SelerFilter' => ['except' => ['/', 'login', 'index/*', 'index', 'home/*', 'home', 'search', 'search/*', 'detail_smartphone/*', 'detail_smartphone', 'detail_seller/*']]
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
			'Adminfilter' => ['except' => ['admin', 'admin/*', 'error', '/', 'home', 'home/*', 'index/*', 'index', 'search', 'search/*', 'detail_smartphone/*', 'detail_smartphone', 'detail_seller/*']],
			'SelerFilter' => ['except' => ['user', 'user/*', 'error', '/', 'home', 'home/*', 'index/*', 'index', 'search', 'search/*', 'detail_smartphone/*', 'detail_smartphone', 'detail_seller/*']],
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
