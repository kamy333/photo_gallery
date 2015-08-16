<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class DatabaseObject {

	// I'm waiting for Late Static Bindings in PHP 5.3
	// http://www.php.net/lsb

    // the below can be in his own class with php.5.3 move to DatabaseObject and change self to static or get_called_class() to get which object is calling aloo add the
    // protected static $table_name

    protected static $table_name;
    protected static $existing_password;
    protected static $db_fields;


    public static function find_all() {
        $table=static::$table_name;
        return static::find_by_sql("SELECT * FROM {$table} ");
    }

    public static function find_by_id($id=0) {
        global $database;

        $result_array = static::find_by_sql("SELECT * FROM"." ".static::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql="") {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    public static function count_all(){
        global $database;
        $table=static::$table_name;
        $result_set=$database->query("SELECT count(*) FROM {$table} ");
        $row=$database->fetch_array($result_set);
        return $row ? array_shift($row): false;

    }

    private static function instantiate($record) {
        // Could check that $record exists and is an array
        if(isset($record["hashed_password"])){
        static::$existing_password = $record["hashed_password"];
    }
        // if move to DatabaseObject class self change by
        // $object = new $class_name;
        // $class_name=get_called_class();
        $object = new static;
        // Simple, long-form approach:
        // $object->id 				= $record['id'];
        // $object->username 	= $record['username'];
        // $object->password 	= $record['password'];
        // $object->first_name = $record['first_name'];
        // $object->last_name 	= $record['last_name'];

        // More dynamic, short-form approach:
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }


    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->attributes());
    }

    private function attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach(static::$db_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach($this->attributes() as $key => $value){
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save(){
        // if the id is set then we update and prevent to create another same user
        // if(isset($this->id)){$this->update();} else {$this->create();}
        return isset($this->id)? $this->update(): $this->create() ;

    }


    public function create() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO"." ".static::$table_name." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }


    public function update() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".static::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }


    public function delete() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM"." ".static::$table_name;
        $sql .= " WHERE id=". $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;

        // NB: After deleting, the instance of User still
        // exists, even though the database entry does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted";
        // but, for example, we can't call $user->update()
        // after calling $user->delete().
    }


}