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
	if (isset($qcmf->config['debug']['display-qcmf']) && $qcmf->config['debug']['display-qcmf']) {
		$html .= "<hr><h3>Debuginformation</h3><p>The content of CQcmf: </p><pre>" . htmlent(print_r($qcmf, true)) . "</pre>";
	}
	if (isset($qcmf->config['debug']['db-num-queries']) && $qcmf->config['debug']['db-num-queries'] && isset($qcmf -> db)) {
		$html .= "<p>Database made " . $qcmf -> db -> GetNumQueries() . " queries.</p>";
	}
	if (isset($qcmf->config['debug']['db-queries']) && $qcmf->config['debug']['db-queries'] && isset($qcmf -> db)) {
		$html .= "<p>Database queries: </p><pre>" . implode('<br/><br/>', $qcmf -> db -> GetQueries()) . "</pre>";
	}
	return $html;
}
/**
 * Prepend the base_url.
 */
function base_url($url) {
	return $qcmf->request->base_url . trim($url, '/');
}


/**
 * Return the current url.
 */
function current_url() {
	return $qcmf->request->current_url;
}
?>