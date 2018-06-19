<?php
return [
	'settings' => [
		'displayErrorDetails' => true, // set to false in production
		'addContentLengthHeader' => false, // Allow the web server to send the content-length header

		'db' => [
			'url'  => 'mongodb://localhost:27017',
			'name' => 'avaliacao',
		]
	],
];
