<?php

class db{

/*** Declare instance as static to have a singleton db class***/
private static $instance = NULL;
private static $pagingSource=NULL;
public $messageProcess=NULL;
private $pager = 20;




private function __construct() {
/**
*
* the constructor is set to private so
* so nobody can create a new instance using new
*
*/
  /*** maybe set the db name here later ***/
}

/**
*
* Return DB instance or create intitial connection
*
* @return object (PDO)
*
* @access public
*
*/
public static function getInstance() {

if (!self::$instance)
    {
    self::$instance = new PDO("mysql:host=localhost;dbname=dixeam_amazone", 'root', 'vertrigo');// or die('Connection error');
    self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	
	
return self::$instance;
}


private function __clone(){
/**
*
* Like the constructor, we make __clone private
* so nobody can clone the instance
*
*/
}


public function rawSelectQuery($sql,$pager=null,$curpage=null)
        {
		$pagelimit =null;
		if(!is_null($pager))
			{
			$sql1=$sql;
			$sql = $sql.' LIMIT ?,?';
			$pagelimit = array(((is_null($curpage)?1:$curpage)*$pager),$pager);
			self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
			}
			$dbexec = self::$instance->prepare($sql);
            $dbexec->execute($pagelimit);
			$return = $dbexec->fetchAll(PDO::FETCH_ASSOC);
			(!is_null($pager)?self::rawSelectQueryPaging($sql1,current(array_keys($return[0])),$pager,$curpage):''/*do nothing*/);
			
            return $return;
        }
		
public function rawSelectQueryPaging($sql=null,$firstfield = null,$pager=0,$curpage=1)
        {
		
		 if(!is_null($sql))
			{
			$sql = str_ireplace('from','FROM',$sql) ;
			$sql = explode('FROM', $sql);
			$sql = "SELECT COUNT(".$firstfield.") AS total FROM ".$sql[1];
			$dbexec = self::$instance->prepare($sql);
			$dbexec->execute(); 
			$records = $dbexec->fetch(PDO::FETCH_COLUMN);
			$pages = (ceil( $records / $pager )+(($records%$pager==0)?0:1));
			self::$pagingSource = '<div class="pageholder "><a href="#" class='.(($curpage < 2)?'disabled':"").'>&lt;&lt;PREV</a><ul class="pagination">';
			$startloop = (($curpage > 2)?$curpage-2:$curpage);
			
			for($x=1;$x<=$pages;$x++)
				{
				self::$pagingSource .= '<li><a href="'.$_GET['rt'].'.php/p/'.$x.'">'.$x.'</a></li>';
				}
			self::$pagingSource .='</ul><a href="#" class='.(($curpage > ($pages-1))?'disabled':"").'>NEXT&gt;&gt;</a></div>';
			
			
			}
		else
			{
			return self::$pagingSource;
			} 
		
		}
		
		

public function dbSelect($table, $fieldname=null, $id=null)
        {
            $sql = "SELECT * FROM `$table` WHERE `$fieldname`=:id";
            $dbexec = self::$instance->prepare($sql);
            $dbexec->bindParam(':id', $id);
            $dbexec->execute();
            return $dbexec->fetchAll(PDO::FETCH_ASSOC);
        }
		
public function dbInsert($table, $values)
        {
            $fieldnames = array_keys($values[0]);
            $size = sizeof($fieldnames);
            $i = 1;
            $sql = "INSERT INTO $table";
            $fields = '( ' . implode(' ,', $fieldnames) . ' )';
            $bound = '(:' . implode(', :', $fieldnames) . ' )';
            $sql .= $fields.' VALUES '.$bound;

            /*** prepare and execute ***/
            $dbexec = self::$instance->prepare($sql);
            foreach($values as $vals)
            {
                $dbexec->execute($vals);
            }
        }
		
public function dbUpdate($table, $fieldname, $value, $pk, $id)
        {
            $sql = "UPDATE `$table` SET `$fieldname`='{$value}' WHERE `$pk` = :id";
            $dbexec = self::$instance->prepare($sql);
            $dbexec->bindParam(':id', $id, PDO::PARAM_STR);
            if ($dbexec->execute())
			{
			  self::$messageProcess = "Update Successful!";
			}
			else
			{
			  self::$messageProcess = "Update Failed!";
			}
        }
		
public function dbDelete($table, $fieldname, $id)
        {
            $sql = "DELETE FROM `$table` WHERE `$fieldname` = :id";
            $dbexec = self::$instance->prepare($sql);
            $dbexec->bindParam(':id', $id, PDO::PARAM_STR);
			if ($dbexec->execute())
			{
			  self::$messageProcess = "Delete Successful!";
			}
			else
			{
			  self::$messageProcess = "Delete Failed!";
			}
        }

} /*** end of class ***/

?>
