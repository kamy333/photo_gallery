<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject {

	protected static $table_name="admins";
    protected static $db_fields = array('id', 'username', 'hashed_password', 'nom','email','user_type','user_type_id','first_name', 'last_name','address','cp','city','country','phone','mobile');

    const TYPE_ADMIN=1;
    const TYPE_MANAGER=2;
    const TYPE_SECRETARY=3;
    const TYPE_CHAUFFEUR=4;

// not used but is method is_valid_user_type_id ()
    static public $valid_user_type_id=array(
      self::TYPE_ADMIN=>'admin',
      self::TYPE_MANAGER=>'manager',
      self::TYPE_SECRETARY=>'secretary',
      self::TYPE_CHAUFFEUR=>'employee',
    );

    protected static $existing_password;
    public $id;
	public $username;
    public $password;
	protected $hashed_password;
    public $nom;
    public $email;
    public $user_type;
    public $user_type_id;
    public $first_name;
	public $last_name;
    public $address;
    public $cp;
    public $city;
    public $country;
    public $phone;
    public $mobile;
    public $img;


    // not used but can be validated to see that is valid and then use magic set and get (property $user_type id must be protected
    public static function is_valid_user_type_id($user_type_id){
    return array_key_exists($user_type_id,self::$valid_user_type_id);
    }

    // not used but could be set ny magic set and get
   public function set_user_type_id($user_type_id){
     if(self::is_valid_user_type_id($user_type_id))  {
         $this->user_type_id=$user_type_id;
     }
   }


    public static function is_chauffeur()
    {
        if (isset($_SESSION) && isset($_SESSION['user_id'])) {
            $found_user = self::find_by_id($_SESSION["user_id"]);
            if ($found_user->user_type_id == self::TYPE_CHAUFFEUR) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static  function is_kamy()
    {
        if (isset($_SESSION) && isset($_SESSION['user_id'])) {
            $found_user = self::find_by_id($_SESSION["user_id"]);
            if ($found_user->username == 'kamy') {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function is_secretary(){
        if (isset($_SESSION) && isset($_SESSION['user_id'])) {
            $found_user = self::find_by_id($_SESSION["user_id"]);
            if ($found_user->user_type_id == self::TYPE_SECRETARY) {
                return true;
            } else {
                return false;
            }
        }

    }

    public static function is_manager (){
        if (isset($_SESSION) && isset($_SESSION['user_id'])) {
            $found_user = self::find_by_id($_SESSION["user_id"]);
            if ($found_user->user_type_id == self::TYPE_MANAGER) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function is_admin (){
        if (isset($_SESSION) && isset($_SESSION['user_id'])) {
            $found_user = self::find_by_id($_SESSION["user_id"]);
            if ($found_user->user_type_id == self::TYPE_ADMIN) {
                return true;
            } else {
                return false;
            }
        }

    }

    public  function kamy_var(){
        var_dump(get_object_vars($this));
        var_dump(  get_defined_vars());
       // var_dump( get_defined_functions());
        var_dump(get_class_methods($this));

    }

    public function full_name() {
    if(isset($this->first_name) && isset($this->last_name)) {
      return $this->first_name . " " . $this->last_name;
    } else {
      return "";
    }
  }

    public function password_set($value){
        $this->password=trim($value);
        $this->password_encrypt();
    }

     private  function password_encrypt() {
        $hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
        $salt_length = 22; 					// Blowfish salts should be 22-characters or more
        $salt = $this->generate_salt($salt_length);
        $format_and_salt = $hash_format . $salt;
        $hash = crypt($this->password, $format_and_salt);
        $this->hashed_password=$hash;
    }

    private  function generate_salt($length) {
        // Not 100% unique, not 100% random, but good enough for a salt
        // MD5 returns 32 characters
        $unique_random_string = md5(uniqid(mt_rand(), true));

        // Valid characters for a salt are [a-zA-Z0-9./]
        $base64_string = base64_encode($unique_random_string);

        // But not '+' which is valid in base64 encoding
        $modified_base64_string = str_replace('+', '.', $base64_string);

        // Truncate string to the correct length
        $salt = substr($modified_base64_string, 0, $length);

        return $salt;
    }

  private static function  password_check($password) {
        // existing hash contains format and salt at start
       $existing_hash=self::$existing_password;
        $hash = crypt($password, $existing_hash);
        if ($hash === $existing_hash) {
            return true;
        } else {
            return false;
        }
    }

  public static function authenticate($username="", $password="") {
        $record_user=self::find_by_username($username);
        $check= self::password_check($password);
        if ($check){
            return $record_user;
        }else {
            return false;
        }

      //  return $exiting_password;

    }

  public static function find_by_username($username="") {
      global $database;
      $username = $database->escape_value($username);
      $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE username='{$username}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

  public static function find_by_email($email="") {
        $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE email='{$email}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

// Common Database Methods

//    protected static function instantiate($record)    {
//        self::$existing_password = $record["hashed_password"];
//        parent::instantiate($record);
//
//    }

    public function create() {
        $this->password_encrypt();
        parent::create();

    }

    public function update() {
        $this->password_encrypt();
        parent::update();

    }

    public function display_table(){
        $this->set_user_type();
        $output="";
        $output.= "<tr>";
        $output.= "<td class='text-center'>".$this->id."</td>";
        $output.= "<td class='text-center'>".$this->username."</td>";
        $output.= "<td class='text-center'>".$this->nom."</td>";
        $output.= "<td class='text-center'>".$this->email."</td>";
        $output.= "<td class='text-center'>". $this->user_type."</td>";
        $output.= "<td class='text-center'>".$this->user_type_id."</td>";
        $output.= "<td class='text-center'><a href='index.php?id=".urlencode($this->id)."'>Edit</a></td>" ;
        $output.= "<td class='text-center'><a href='index.php?id=".urlencode($this->id)."'>Delete</a></td>" ;

        $output.= "</tr>";
        return $output;

    }




    public function set_user_type() {
if(isset($this->user_type_id))  {
    switch ($this->user_type_id) {
        case self::TYPE_ADMIN :
            $this->user_type="admin";
            break;
        case self::TYPE_MANAGER :
            $this->user_type="manager";
            break;
        case self::TYPE_SECRETARY :
            $this->user_type="secretary";
            break;
        case self::TYPE_CHAUFFEUR :
            $this->user_type="chauffeur";
            break;

    }


}
}

    }

?>