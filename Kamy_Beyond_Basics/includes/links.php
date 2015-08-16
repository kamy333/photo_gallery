<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class Links extends DatabaseObject {
    protected static $table_name="links";
    protected static $db_fields=array('id', 'name', 'web_address', 'description', 'category','sub_category_1','sub_category_2','privacy','rank','username');
    public $id;
    public $name;
    public $web_address;
    public $description;
    public $category;
    public $sub_category_1;
    public $sub_category_2;
    public $privacy;
    public $rank;
    public $username;


   public function display(){
    $output="";
    $output.="<td>";
    $output.=$this->name;
    $output.="</td>";
    return $output;
   }

}