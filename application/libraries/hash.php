<?php
/**
 * @author kereell
 *
 */

class Hash {
		
	public function __construct() {}
	
	/**
	 * @param string $data
	 * @return string
	 */
	
	public static function create($data) {
		
		$context = hash_init('sha256', HASH_HMAC, HASH_SALT);
		hash_update($context, $data);

		return hash_final($context, TRUE);
		
	}
	
}