<?php
/**
 * Site configuration, this file is changed by user per site.
 *
 */

/**
 * Set level of error reporting
 */
error_reporting(-1);
ini_set('display_errors', 1);

/**
 * Set what to show as debug or developer information in the get_debug() theme helper.
 */
$qcmf->config['debug']['display-qcmf'] = true;
$qcmf->config['debug']['db-num-queries'] = true;
$qcmf->config['debug']['db-queries'] = true;
$qcmf->config['debug']['session'] = true;
/**
 * What type of urls should be used?
 * 
 * default      = 0      => index.php/controller/method/arg1/arg2/arg3
 * clean        = 1      => controller/method/arg1/arg2/arg3
 * querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
 */
$qcmf->config['url_type'] = 1;

/**
 * Set up database
 */
$qcmf->config['database'][0]['dsn'] = 'sqlite:' . QCMF_SITE_PATH . '/data/.ht.sqlite';

/**
 * Set a base_url to use another than the default calculated
 */
$qcmf->config['base_url'] = null;

/**
 * Define session name
 */
$qcmf->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);
$qcmf->config['session_key'] = 'qcfm';

/**
 * Define server timezone
 */
$qcmf->config['timezone'] = 'Europe/Stockholm';

/**
 * Define internal character encoding
 */
$qcmf->config['character_encoding'] = 'UTF-8';

/**
 * Define language
 */
$qcmf->config['language'] = 'en';


/**
 * Define the controllers, their classname and enable/disable them.
 *
 * The array-key is matched against the url, for example: 
 * the url 'developer/dump' would instantiate the controller with the key "developer", that is 
 * CCDeveloper and call the method "dump" in that class. This process is managed in:
 * $qcmf->FrontControllerRoute();
 * which is called in the frontcontroller phase from index.php.
 */
$qcmf->config['controllers'] = array(
  'index'     => array('enabled' => true,'class' => 'CCIndex'),
  'test' => array('enabled' => true,'class' => 'CCTest'),
  'guestbook' => array('enabled' => true,'class' => 'CCGuestbook'),
  'user' => array('enabled' => true,'class' => 'CCUser'),
  'acp' => array('enabled' => true, 'class' => 'CCAdminControlPanel'),
);

/**
 * Settings for the theme.
 */
$qcmf->config['theme'] = array(
  // The name of the theme in the theme directory
  'name'    => 'core', 
);


