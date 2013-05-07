<?php
/**
 * Helpers for theming, available for all themes in their template files and functions.php.
 * This file is included right before the themes own functions.php
 */

/**
 * Print debuginformation from the framework.
 */
function get_debug() {
	$qcmf = CQcmf::Instance();
	$html = null;
	if (isset($qcmf->config['debug']['display-qcmf'])) {
		$html .= "<hr><h3>Debuginformation</h3><p>The content of CQcmf: </p><pre>" . htmlent(print_r($qcmf, true)) . "</pre>";
	}
	if (isset($qcmf->config['debug']['db-num-queries']) && $qcmf->config['debug']['db-num-queries'] && isset($qcmf->db)) {
		$html .= "<p>Database made " . $qcmf -> db -> GetNumQueries() . " queries.</p>";
	}
	if (isset($qcmf->config['debug']['db-queries']) && $qcmf->config['debug']['db-queries'] && isset($qcmf->db)) {
		$html .= "<p>Database queries: </p><pre>" . implode('<br/><br/>', $qcmf -> db -> GetQueries()) . "</pre>";
	}
	return $html;
}

/**
 * Render views
 */
function render_views(){
	return CQcmf::Instance()->views->Render();
}

/**
 * Prepend the base_url.
 */
function base_url($url=null) {
	return CQcmf::Instance()->request->base_url . trim($url, '/');
}

/**
 * Create internal resource url
 */
function create_url($url=null) {
	return CQcmf::instance()->request->CreateUrl($url);
}

/**
 * Prepende the theme directory url
 */
function theme_url($url) {
	$qcmf = CQcmf::instance();
	return "{$qcmf->request->base_url}themes/{$qcmf->config['theme']['name']}/{$url}";
}

/**
 * Return the current url.
 */
function current_url() {
	return $qcmf->request->current_url;
}

function get_messages_from_session() {
  $messages = CQcmf::Instance()->session->GetMessages();
  $html = null;
  if(!empty($messages)) {
    foreach($messages as $val) {
      $valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
      $class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
      $html .= "<div class='$class'>{$val['message']}</div>\n";
    }
  }
  return $html;
}

?>