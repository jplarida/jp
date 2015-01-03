<?php

define("DB_RT_ARRAY",0);		// return row as an assoc aray where fieldnames are keys
define("DB_RT_OBJECT",1);		// return row as an object where fieldnames are properties

class MySQL {
	
	var $type;			// database type
	var $conn_id;		// database connection id
	var $current_db;	// name of the current selected database
	var $num_queries;	// number of queries per session
	var $modif = FALSE;	// specifies if there were any modifications to the database [write queries]
	
	var $encoded_fields = array(); //name of encoded fields in db
	var $encoded_pass = 'hndbyt3'; // the password used to encode/decode encoded fields from MySQL tables
	
	var $msg = '';


	function MySQL($connect_params = "", $type = 0) { // initializes module and connects to the database
		$this->type = $type;
		if ($connect_params != "") $this->Connect($connect_params);
		}


	function Connect($connect_params = "") { // connects to the database
		extract($connect_params);
		$this->conn_id = @mysql_connect($server,$user,$password,TRUE) or die("MySQL Connect Error.");
		if ($database != "") $this->SelectDB($database);
		}


	function Close() { // closes the database connection
		mysql_close($this->conn_id);
		}	
	

	function SelectDB($database) { // selects and sets the current database
		mysql_select_db($database,$this->conn_id) or die("MySQL::SelectDB() error");
		$this->current_db = $database;
		}
	

	function Query($query, $db = "") { // queries the database
		$this->num_queries++;
		
		if ($db) $result = mysql_db_query($db ,$query,$this->conn_id);
			else $result = mysql_query($query,$this->conn_id) or die($query . mysql_error());
		return $result;
	}


	function FileToString($file_name) {
	 	if(!file_exists($file_name)) return "<i>Error: file '$file_name' not found ...</i>";
		return file_get_contents($file_name);
	}


	function FetchObject($result) {
		return mysql_fetch_object($result);
		}


	function FetchRow($result) {
		return mysql_fetch_row($result);
		}


	function FetchArray($result,$result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($result,$result_type);
		}


	function NumRows($result) {
		return mysql_num_rows($result);
		}


	function AffectedRows() {
		return mysql_affected_rows($this->conn_id);
		}


	function InsertID() {
		return mysql_insert_id($this->conn_id);
		}

	function NumQueries() {
		return $this->num_queries;
		}


	function QFetchObject($query) {
		return $this->FetchObject($this->Query($query));
		}


	function QFetchRow($query) {
		return $this->FetchRow($this->Query($query));
		}


	function QFetchArray($query) {
		return $this->FetchArray($this->Query($query));
		}


	function RowCount($table,$where_clause = "") { // returns the number of rows from a table based on a certain [optional]
		$result = $this->FetchRow($this->Query("SELECT COUNT(*) FROM $table $where_clause;"));
		return $result[0];
		}


	function FetchRowArray($result,$return_type = DB_RT_ARRAY,$key = "") { // fetch an array w/ rows from the database
		$ret_val = array();
		$i = 0;
		while ($row = (($return_type == DB_RT_ARRAY) ? $this->FetchArray($result) : $this->FetchObject($result)))
			$ret_val[(($key == "") ? $i++ : (($return_type == DB_RT_ARRAY) ? $row["$key"] : $row->$key))] = $row;
		return (count($ret_val) != 0) ? $ret_val : NULL;
		}


	function QFetchRowArray($query,$return_type = DB_RT_ARRAY,$key = "") { // FetchRowArray wrapper
		return $this->FetchRowArray($this->Query($query),$return_type,$key);
		}


	function GetTableFields($table) { // returns an array w/ the tables fields
		$fields = $this->QFetchRowArray("SHOW FIELDS FROM `$table`");
		$ret_val = array();
		foreach ($fields as $field)	$ret_val[] = $field["Field"];
		return $ret_val;
		}
		
		
	function GetTableFieldsEnc($table){ //returns all fields separated by comma where encoded fields are prepared to be decoded
		$fields = $this -> GetTableFields($table); // table fields array
		foreach($this -> encoded_fields as $key1 => $enc_field){
			foreach($fields as $key2 => $field){
				if(strtoupper($enc_field) == strtoupper($field)){
					//replace field with decode syntax
					$fields[$key2] = "decode(".$field.", '".$this -> encoded_pass."') as ".$field;
				}
			}
		}
		return implode(',', $fields);
	}


	function QuerySelectByID($table,$id,$fields = "*",$return_type = DB_RT_ARRAY) { // fetches a row from a table based on a certain id using the SELECT SQL query
		// build query
		$query = "SELECT $fields FROM `$table` WHERE `id` = '$id'";
		// fetch row
		return ($return_type == DB_RT_ARRAY) ? $this->QFetchArray($query) : $this->QFetchObject($query);
		}


	function QuerySelectLimit($table,$fields,$where_clause,$start,$count,$pm = TRUE,$order_by = "",$order_dir = "ASC",$return_type = DB_RT_ARRAY) { // complex fetch row array w/ WHERE/LIMIT/ORDER SQL clauses and page modifier
		// check if $count is empty just to be safe
		$count = ($count == "") ? 0 : $count;
		// recompute $start if page modifier set
		$_start = ($pm == TRUE) ? ((($start == 0) ? 1 : $start) * $count - $count) : $start;
		// setup order clause
		$order_clause = ($order_by != "") ? "ORDER BY $order_by " . (in_array($order_dir,array("ASC","DESC")) ? "$order_dir " : "") : "";
		// setup where clause
		$where_clause = ($where_clause != "") ? "WHERE $where_clause " : "";
		// limit clause
		$limit_clause = ($start >= 0) ? "LIMIT $_start,$count" : "";
		// build query
		$query = "SELECT $fields FROM `$table` {$where_clause}{$order_clause}{$limit_clause}";
		// fetch rows
		return $this->QFetchRowArray($query,$return_type);
		}


	function QueryInsert($table,$fields) { // builds and performes a SQL INSERT query based on the user data
		// first get the tables fields
		$table_fields = $this->GetTableFields($table);
		if (count($fields) == 0) {
			$names[] = "id";
			$values[] = "''";
		} else
			// prepare field names and values
			foreach ($fields as $field => $value)
				// check for valid fields
				if (in_array($field,$table_fields)) {
					$names[] = "`$field`";
					$value = str_replace("\\", "", $value);
					$value = str_replace('"', "'", $value);
					$value = addslashes($value);
					
					if(in_array($field, $this -> encoded_fields)) $values[] = "encode('".$value."', '".$this -> encoded_pass."')";
													 		 else $values[] = "'$value'";
				}
		// build field names and values
		$names = implode(",",$names);
		$values = implode(",",$values);
		// perform query
		//die("INSERT INTO `$table` ($names) VALUES($values)");
		$this->Query("INSERT INTO `$table` ($names) VALUES($values)");
		return $this->InsertID();
		}


	function QueryUpdate($table,$fields,$where_clause) { // builds and performs a SQL UPDATE query based on the user data
		if (is_array($fields)) {
			// first get the tables fields
			$table_fields = $this->GetTableFields($table);
			// prepare query
			foreach ($fields as $field => $value)
				// check for valid fields
				if (in_array($field,$table_fields)) {
					$value = str_replace("\\", "", $value);
					$value = str_replace('"', "'", $value);
					$value = addslashes($value);
					if(in_array($field, $this -> encoded_fields)) 
 						 $pairs[] = "`$field` = encode('".$value."', '".$this -> encoded_pass."')";
					else $pairs[] = "`$field` = '$value'";
					}
			// build and perform query
			if ( (isset($pairs)) && (is_array($pairs)) ) $this->Query("UPDATE `$table` SET " . implode(", ",$pairs) . " WHERE($where_clause)");
			}
		}


	function QueryUpdateByID($table,$fields) { // builds and performs a SQL UPDATE query based on the user data
		$id = $fields["id"];
		unset($fields["id"]);
		$this->QueryUpdate($table,$fields,"`id` = '$id'");
		}

	
}

/*$config['mysql_connection']['server']  = 'localhost';
$config['mysql_connection']['user']   = 'root';
$config['mysql_connection']['password']  = '';
$config['mysql_connection']['database']  = 'amazone';*/


/*$config['mysql_connection']['server']  = 'localhost';
$config['mysql_connection']['user']   = 'newsinterval';
$config['mysql_connection']['password']  = 'newsinterval@123';
$config['mysql_connection']['database']  = 'amazone';*/

$config['mysql_connection']['server']  = 'localhost';
$config['mysql_connection']['user']   = 'root';
$config['mysql_connection']['password']  = 'vertrigo';
$config['mysql_connection']['database']  = 'dixeam_amazone';

$sql_obj    =  new MySQL($config["mysql_connection"], 0);

?>