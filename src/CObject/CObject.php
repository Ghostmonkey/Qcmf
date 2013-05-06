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

}
?>