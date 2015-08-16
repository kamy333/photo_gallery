<?php require_once("../includes/initialize.php"); ?>

<?php include_layout_template('header.php'); ?>
<?php

$username="kamy";
$password='kamy';


//$check=User::authenticate($username,$password);
//print_r($record["hashed_password"]) ;

$sql="SELECT * from admins WHERE username='kamy'";

$hi=$database->query($sql);
$found_user=$database->fetch_array($hi);


var_dump($found_user);
//echo User::$existing_password;
//echo $record->hashed_password."<br>";
//echo $record->full_name();
//var_dump($record);
//var_dump($user);

//$user = User::find_by_id(2);
//echo $user->full_name();
//
//echo "<hr />";
//
//$users = User::find_all();
//foreach($users as $user) {
//    echo "User: ". $user->hashed_password ."<br />";
//    echo "User: ". $user->username ."<br />";
//  echo "Name: ". $user->full_name() ."<br />";
//  echo "email: ". $user->email ."<br />";
//  echo "user_type: ". $user->user_type ."<br />";
//  echo "user_type ID: ". $user->user_type_id ."<br><br>";
//
//}


//var_dump($user);
//var_dump($users);


//$user=new User;

//$admin=$user->find_by_sql("select * from admins WHERE username='kamy'");
//
//echo "<pre>";
//foreach ( $admin as $val) {
//
//    echo "<pre>";
//foreach ( $val as $key=>$val2) {
//    echo $key."-".$val2."<br>";
//}
//
//  //  print_r($val) ;
//}
//echo "</pre>";

//echo $admin [0][0];
//var_dump($admin);
//$username=$user->username;
//$existing_password= $user->hashed_password;
//$check=user::password_check($password,$existing_password);






echo "<br>";
if(isset($check)){
    if( $check){
        echo "password match";
    } else {
        echo "password did not match";
    }

}

//$user->kamy_var();
//$user->username="kamy";
//$user->first_name="kam";
//$user->kamy_var();




?>
<?php include_layout_template('footer.php'); ?>
