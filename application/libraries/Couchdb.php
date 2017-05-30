<?PHP

require_once APPPATH."/libraries/Couch.php";
require_once APPPATH."/libraries/CouchClient.php";
require_once APPPATH."/libraries/CouchDocument.php";
require_once APPPATH."/libraries/CouchReplicator.php";

class Couchdb extends CouchClient {

	function __construct() {
		$ci =& get_instance();
		$ci->config->load("couchdb");
		parent::__construct($ci->config->item("couch_dsn"), $ci->config->item("couch_database"));
	}

}
