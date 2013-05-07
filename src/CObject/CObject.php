<?php
/**
* Holding a instance of CLydia to enable use of $this in subclasses.
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
   protected function __construct() {
    $qcmf = CQcmf::Instance();
    $this->config = &$qcmf->config;
    $this->request = &$qcmf->request;
    $this->data = &$qcmf->data;
	$this->db = &$qcmf->db;
	$this->views = &$qcmf->views;
	$this->session = &$qcmf->session;
  }

	/**
	 * Redirect to another url and store the session
	 */
	protected function RedirectTo($url) {
    $ly = CQcmf::Instance();
    if(isset($ly->config['debug']['db-num-queries']) && $ly->config['debug']['db-num-queries'] && isset($ly->db)) {
      $this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
    }    
    if(isset($ly->config['debug']['db-queries']) && $ly->config['debug']['db-queries'] && isset($ly->db)) {
      $this->session->SetFlash('database_queries', $this->db->GetQueries());
    }    
    if(isset($ly->config['debug']['timer']) && $ly->config['debug']['timer']) {
	    $this->session->SetFlash('timer', $ly->timer);
    }    
    $this->session->StoreInSession();
    header('Location: ' . $this->request->CreateUrl($url));
  }

}
?>