<?php

return [
	// MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'main/index/{page:\d+}' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'about' => [
		'controller' => 'main',
		'action' => 'about',
	],
	'contact' => [
		'controller' => 'main',
		'action' => 'contact',
	],
	'post/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'post',
	],
	
	'user/login' => [
		'controller' => 'user',
		'action' => 'login',
	],
	'user/logout' => [
		'controller' => 'user',
		'action' => 'logout',
	],
	'user/register' => [
		'controller' => 'user',
		'action' => 'register',
	],
	'user/account' => [
		'controller' => 'user',
		'action' => 'account',
	],
	'user/confirm/{token:\w+}' => [
		'controller' => 'user',
		'action' => 'confirm',
	],
	'user/recovery' => [
		'controller' => 'user',
		'action' => 'recovery',
	],
	'user/reset/{token:\w+}' => [
		'controller' => 'user',
		'action' => 'reset',
	],
	
	
	// AdminController
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
	'admin/add' => [
		'controller' => 'admin',
		'action' => 'add',
	],
	'admin/edit/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'edit',
	],
	'admin/delete/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'delete',
	],
	'admin/posts/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'posts',
	],
	'admin/posts' => [
		'controller' => 'admin',
		'action' => 'posts',
	],
];