<?php
/**
 * Container class, holding views
 * 
 * @package QcmfCore
 */
class CViewContainer {
	
	/**
	 * Member variables
	 */
	private $data = array();
	private $views = array();
	
	/**
	 * Constructor
	 */
	public function __construct() { ; }
	
	/**
	 * Getters
	 */
	public function GetData() {
		return $this->data;
	}
	
	/**
	 * Set page title
	 * 
	 * @param $value string to use as page title
	 */
	public function SetTitle($value) {
		$this->SetVariable('title', $value);
	}
	
	/**
	 * Set any variable that should be available for the theme engine
	 * 
	 * @param $key variable name 
	 * @param $value variable value
	 */
	public function SetVariable($key, $value) {
		$this->data[$key] = $value;
	}
	
	/**
	 * Add view as file to be included and optional variables
	 * 
	 * @param $file string path to file that should be included
	 * @param $variables array containing the variables that should be available for the file included
	 */
	public function AddInclude($file, $variables=array()) {
		$this->views[] = array('type' => 'include', 'file' => $file, 'variables' => $variables);	
	}
	
	/**
	 * Render views according to type
	 */
	public function Render() {
		foreach($this->views as $view) {
			switch($view['type']) {
				case 'include':
					extract($view['variables']);
					include($view['file']);
					break;
			}
		}
	}
	
	
}

?>
