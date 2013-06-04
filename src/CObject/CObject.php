<?php
/**
 * Holding a instance of CQcmf to enable use of $this in subclasses.
 *
 * @package QcmfCore
 */
class CObject {

	public $config;
	public $request;
	public $data;
	public $db;
	public $views;
	public $session;

	/**
	 * Constructor
	 */
	protected function __construct($qcmf = null) {
		if (!$qcmf) {
			$qcmf = CQcmf::Instance();
		}
		$this -> config = &$qcmf -> config;
		$this -> request = &$qcmf -> request;
		$this -> data = &$qcmf -> data;
		$this -> db = &$qcmf -> db;
		$this -> views = &$qcmf -> views;
		$this -> session = &$qcmf -> session;
		$this -> user = &$qcmf -> user;
	}

	/**
	 * Redirect to another url and store the session
	 */
	protected function RedirectTo($urlOrController = null, $method = null) {
		$qcmf = CQcmf::Instance();
		if (isset($this -> config['debug']['db-num-queries']) && $this -> config['debug']['db-num-queries'] && isset($this -> db)) {
			$this -> session -> SetFlash('database_numQueries', $this -> db -> GetNumQueries());
		}
		if (isset($this -> config['debug']['db-queries']) && $this -> config['debug']['db-queries'] && isset($this -> db)) {
			$this -> session -> SetFlash('database_queries', $this -> db -> GetQueries());
		}
		if (isset($this -> config['debug']['timer']) && $this -> config['debug']['timer']) {
			$this -> session -> SetFlash('timer', $ly -> timer);
		}
		$this -> session -> StoreInSession();
		header('Location: ' . $this -> request -> CreateUrl($urlOrController, $method));
	}

	/**
	 * Redirect to a method within the current controller. Defaults to index-method. Uses RedirectTo().
	 *
	 * @param string method name the method, default is index method.
	 */
	protected function RedirectToController($method = null) {
		$this -> RedirectTo($this -> request -> controller, $method);
	}

	/**
	 * Redirect to a controller and method. Uses RedirectTo().
	 *
	 * @param string controller name the controller or null for current controller.
	 * @param string method name the method, default is current method.
	 */
	protected function RedirectToControllerMethod($controller = null, $method = null) {
		$controller = is_null($controller) ? $this -> request -> controller : null;
		$method = is_null($method) ? $this -> request -> method : null;
		$this -> RedirectTo($this -> request -> CreateUrl($controller, $method));
	}

}
?>