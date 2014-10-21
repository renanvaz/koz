<?php

return [
	'default' => [
		/**
		 * The following options must be set:
		 *
		 * string   key     secret passphrase
		 * integer  mode    encryption mode, one of MCRYPT_MODE_*
		 * integer  cipher  encryption cipher, one of the Mcrpyt cipher constants
		 */
		'key'    => '',
		'mode'   => MCRYPT_MODE_NOFB,
		'cipher' => MCRYPT_RIJNDAEL_128,
	],
];