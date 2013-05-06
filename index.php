<?php
//Bootstrap
define('QCMF_INSTALL_PATH', dirname(__FILE__));
define('QCMF_SITE_PATH', QCMF_INSTALL_PATH . '/site');

require(QCMF_INSTALL_PATH.'/src/CQcmf/bootstrap.php');

$qcmf = CQcmf::Instance();

//Front controller route
$qcmf->FrontControllerRoute();

//Theme engine renderer
$qcmf->ThemeEngineRender();


?>