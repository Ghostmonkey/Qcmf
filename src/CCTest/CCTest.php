<?php
/**
 * Controller for development and testing purpose, helpful methods for the developer.
 * 
 * @package QcmfCore
 */
class CCTest extends CObject implements IController {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Implementing interface IController. All controllers must have an index action.
	 */
	public function Index() {  
		$this->Menu();
	}

	public function DisplayObject() {
		$this->Menu();
		
		$this->data['main'] .= <<<EOD
		<h2>Dumping CTest</h2>
		<p>The contents of the controller, including properties from CObject which enables access to resources in CQcmf</p>
EOD;
		$this->data->main['main'] .= '<pre>' . htmlentities(print_r($this, true)) . '</pre>';
	}

	/**
	* Create a list of links in the supported ways.
	*/
	public function Links() {  
		$this->Menu();
		
		//$qcmf = CQcmf::Instance();
		
		$url = 'test/links';
		$current      = $this->request->CreateUrl($url);
		
		$this->request->cleanUrl = false;
		$this->request->querystringUrl = false;    
		$default      = $this->request->CreateUrl($url);
		
		$this->request->cleanUrl = true;
		$clean        = $this->request->CreateUrl($url);    
		
		$this->request->cleanUrl = false;
		$this->request->querystringUrl = true;    
		$querystring  = $this->request->CreateUrl($url);
		
		$this->data['main'] .= <<<EOD
			<h2>CRequest::CreateUrl()</h2>
			<p>Here is a list of urls created using above method with various settings. All links should lead to
			this same page.</p>
			<ul>
			<li><a href='$current'>This is the current setting</a>
			<li><a href='$default'>This would be the default url</a>
			<li><a href='$clean'>This should be a clean url</a>
			<li><a href='$querystring'>This should be a querystring like url</a>
			</ul>
			<p>Enables various and flexible url-strategy.</p>
EOD;
	}


	/**
	 * Create a method that shows the menu, same for all methods
	 */
	private function Menu() {  
		//$this = CQcmf::Instance();
		$menu = array('test', 'test/index', 'test/links');
		$html = null;
		foreach($menu as $val) {
			$html .= "<li><a href='" . $this->request->CreateUrl($val) . "'>$val</a>";  
		}
		$this->data['title'] = "The Test Controller";
		$this->data['main'] = <<<EOD
			<h1>The Test Controller</h1>
			<p>This is what you can do for now:</p>
			<ul>
			$html
			</ul>
EOD;
	}
  
}
?>