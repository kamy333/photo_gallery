<?php
require_once('../../includes/initialize.php');
 if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php'); ?>

<?php

//$user= new User;
////$user->kamy_var();
//
//$user->username ="joexxx";
//$user->password ="joexxx";
//$user->nom="joexxx";
//$user->email ="joe@ml.com";
//$user->user_type ="xx";
//$user->user_type_id =2;
//$user->first_name ="jommm";
//$user->last_name ="ppp";
//$user->address ="qqq";
//$user->cp ="ll";
//$user->city ="ge";
//$user->country ="ch";
//$user->phone ="022";
//$user->mobile ="07";
//$user->save();

//
$user=User::find_by_id(7);
//$user->password_set("kamy");
//$user->kamy_var();
//$user->username="paul";
//$user->save();
//
//$user=User::find_by_id(7);
//$user->delete();
//$user=User::find_by_id(8);
//$user->delete();



$user=User::find_by_id(2);
$username="nom";
echo $user->$username;
echo "<br>";
 $db_fields = array('id', 'username', 'hashed_password', 'nom','email','user_type','user_type_id','first_name', 'last_name','address','cp','city','country','phone','mobile');
echo "<pre>";
print_r($db_fields);
echo "<pre>";


function attributes($db_fields)
{
    // return an array of attribute names and their values
    $attributes = array();
    foreach ($db_fields as $field) {
        if (property_exists("User", $field)) {
            $attributes[$field] =$field;
        }
    }
    return $attributes;
}

$sql = join("', '", array_values(attributes($db_fields)));

echo "<pre>";
print_r (attributes($db_fields));
echo "<pre>";

echo $sql;
?>
<?php include_layout_template('admin_footer.php'); ?>
		
