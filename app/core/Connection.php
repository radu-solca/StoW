<?php

class Connection{

	protected static $db;

	private function __construct() {

		try {
			self::$db = new PDO('oci:dbname=localhost/XE', 'stow', 'stow');
			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
		catch (PDOException $e) {
			echo "Connection Error: " . $e->getMessage();
		}

	}

	public static function getConnection() {

		if (!self::$db) {
			new Connection();
		}

		return self::$db;
	}

}

?>