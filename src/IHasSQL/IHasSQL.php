<?php
/**
 * Interface for classes that interacts with the database. Encapsulates all SQL requests
 * 
 * @package QcmfCore
 */
interface IHasSQL {
	public static function SQL($key=null);
}
?>