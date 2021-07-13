<?php

class EmailReader {
      
	// imap server connection
	public $conn;

	// inbox storage and inbox message count
	private $inbox;
	private $msg_cnt;

	// email login credentials. catherine@zcrit.com bc2143772000d1f6a475191b9f9642ab sarah@zcrit.com f189a84e42ba7c943c65b8373562498c
	private $server = 'zcrit.com';
	private $user   = '';
	private $pass   = '';
	private $port   = 993; // adjust according to server settings

	// connect to the server and get the inbox emails
	function __construct() {
		$this->connect();
		$this->inbox();
	}

	// close the server connection
	function close() {
		$this->inbox = array();
		$this->msg_cnt = 0;

		imap_close($this->conn);
	}

	// open the server connection
	// the imap_open function parameters will need to be changed for the particular server
	// these are laid out to connect to a Dreamhost IMAP server
	function connect() {
        $current_user = wp_get_current_user();
        $userID = $current_user->ID;
        $user_stored = get_user_meta($userID, 'zxzzoomactive_'.$userID.'_user');
        $user_pass = get_user_meta($userID, 'zxzzoomactive_'.$userID.'_user_pass');
        $zcrit_user_email = $user_stored[0];
        $zcrit_user_pass = $user_pass[0];
		$this->conn = imap_open('{'.$this->server.'/notls}', $zcrit_user_email, $zcrit_user_pass);
	}

	// move the message to a new folder
	function move($msg_index, $folder='INBOX.Processed') {
		// move on server
		imap_mail_move($this->conn, $msg_index, $folder);
		imap_expunge($this->conn);

		// re-read the inbox
		$this->inbox();
	}

	// get a specific message (1 = first email, 2 = second email, etc.)
	function get($msg_index=NULL) {
		if (count($this->inbox) <= 0) {
			return array();
		}
		elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) {
			return $this->inbox[$msg_index];
		}

		return $this->inbox[0];
	}

	// delete message
	function delete($msg_index) {
		// delete
		imap_delete($this->conn, $msg_index);
		imap_expunge($this->conn);
		// the inbox
		$this->inbox();
	}

	// read the inbox
	function inbox() {
		$this->msg_cnt = imap_num_msg($this->conn);

		$in = array();
		for($i = 1; $i <= $this->msg_cnt; $i++) {
			$in[] = array(
				'index'     => $i,
				'header'    => imap_headerinfo($this->conn, $i),
				'body'      => imap_body($this->conn, $i),
				'structure' => imap_fetchstructure($this->conn, $i)
			);
		}

		return $this->inbox = $in;
	}

   

}

?>
