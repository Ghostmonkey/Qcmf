<?php
/**
 * A guestbook controller. A basic example of controller and model functionality
 * 
 * @package QcmfCore
 */
class CCGuestbook extends CObject implements IController, IHasSQL {
	
	private $pageTitle = 'Qcmf guestbook demonstration';
	private $pageHeader = '<h1>Guestbook</h1><p>Demonstrating a guestbook in Qcmf</p>';
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}
	/**
	 * SQL statements go here
	 */
	public static function SQL($key=null) {
		$queries = array(
			'create table guestbook'  => "CREATE TABLE IF NOT EXISTS Guestbook (id INTEGER PRIMARY KEY, entry TEXT, created DATETIME default (datetime('now')));",
			'insert into guestbook'   => 'INSERT INTO Guestbook (entry) VALUES (?);',
			'select * from guestbook' => 'SELECT * FROM Guestbook ORDER BY id DESC;',
			'delete from guestbook'   => 'DELETE FROM Guestbook;',
			);
		if(!isset($queries[$key])) {
			throw new Exception("No such SQL query, key '$key' was not found.");
			}
		return $queries[$key];
	}
	
	/**
	 * Handles actions relating to the Guest Book
	 */ 
	public function Handle() {
		if(isset($_POST['doAdd'])){
			$this->SaveNewToDatabase(strip_tags($_POST['newEntry']));
		}
		elseif(isset($_POST['doClear'])) {
			$this->DeleteAllFromDatabase();
		}
		elseif(isset($_POST['doCreate'])) {
			$this->CreateTableInDatabase();
		}
		header('Location: ' . $this->request->CreateUrl('guestbook'));
	}
	
	/**
	 * Save a new entry to database.
	 */
	private function SaveNewToDatabase($entry) {
		$this->db->ExecuteQuery(self::SQL('insert into guestbook', $entry));
		if($this->db->rowCount() != 1) {
			die('Failed to insert new guestbook item into database.');
		}
	}
	
	/**
	 * Delete all entries from the database.
	 */
	private function DeleteAllFromDatabase() {
		$this->db->ExecuteQuery(self::SQL('delete from guestbook'));
	}

	/**
	 * Create the database
	 */
	private function CreateTableInDatabase() {
		try {
			$this->db->executeQuery(self::SQL('create table gusetbook'));
		} catch(Exception$e) {
			die("Failed to open database: " . $this->config['database'][0]['dsn'] . "</br>" . $e);
		}
	}
	
	 /**
	  * Read all entries from the database.
	  */
	private function ReadAllFromDatabase() {
		try {
			$this->db->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      		return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * from guestbook'));
		} catch(Exception $e) {
			return array();
			}
		}
	
	/**
	* Implementing interface IController. All controllers must have an index action.
	*/ 
	public function Index() {
		/*
		$formAction = $this->request->CreateUrl('guestbook/handle');
		$this->pageForm = "
			<form action='{$formAction}' method='post'>
			<p>
			<label>Message:
			<br/>
			<textarea name='newEntry'></textarea>			</label>
			</p>
			<p>
			<input type='submit' name='doAdd' value='Add message' />
			<input type='submit' name='doClear' value='Clear all messages' />
			<input type='submit' name='doCreate' value='Create Table' />
			</p>
			</form>
			";
		$this->data['title'] = $this->pageTitle;
		$this->data['main']  = $this->pageHeader . $this->pageForm . print($_POST);
	
		$entries = $this->ReadAllFromDatabase();
    	foreach($entries as $val) {
      		$this->data['main'] .= "<div style='background-color:#f6f6f6;border:1px solid #ccc;margin-bottom:1em;padding:1em;'><p>At: {$val['created']}</p><p>" . htmlent($val['entry']) . "</p></div>\n";
    	}
		*/

		$this->views->SetTitle($this->pageTitle);
		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
			'entries' => $this->ReadAllFromDatabase(),
			'formAction' => $this->request->CreateUrl('guestbook/handle')
			));
		 
	}
}
?>