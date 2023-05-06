<?php
	/**
	 * This file contains the following configurations:
	 *
	 * * MySQL settings
	 * * Database table prefix
	 * * ABSPATH - Main directory
	 * * INCPATH - Includes folder
	 * * LIBPATH - Libraries folder
	 *
	 * @package clifftop
	 */

	#-- MySQL settings - You can get this info from your web host

	/** The name of the database for the clifftop */
	defined("DB_NAME") ? NULL : define("DB_NAME", "chaseteller");

	/** Hostname */
	defined("DB_HOST") ? NULL : define("DB_HOST", "localhost");

	/** Database username */
	defined("DB_USERNAME") ? NULL : define("DB_USERNAME", "root");

	/** Database password */
	defined("DB_PASSWORD") ? NULL : define("DB_PASSWORD", "");

	/** Connection port */
	defined("DB_PORT") ? NULL : define("DB_PORT", "");
?>