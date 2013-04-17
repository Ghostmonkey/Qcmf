<?php
/* 
* @package QcmfCore
*/
class CCIndex implements IController {
	
	/**
	* Implementing interface IController. All controllers must have an index action.
	*/
	public function Index() {   
		global $qcmf;
		$qcmf->data['title'] = "The Index Controller";
	}
	
	public function test(){
		
	}
}
?>