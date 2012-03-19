<?php

return array
(
	'environment' => array
	(
		'debug'               => FALSE,
		'trim_blocks'         => FALSE,
		'charset'             => 'utf-8',
		'base_template_class' => 'Twig_Template',
		'cache'               => FALSE,//APPPATH.'cache/twig',
		'auto_reload'         => TRUE,
		'strict_variables'    => FALSE,
		'autoescape'          => FALSE,
		'optimizations'       => -1,
	),
	'extensions' => array
	(
		// List extension class names
	),
	'templates'      => APPPATH.'views',
	'suffix'         => 'html',
);