<?php
$username = $_POST['username'];
$password = $_POST['password']; //encrypt the password
$success = false;
$db_fullname = $db_phone = $db_birthday = "";

include('database.php');

$db = getDB();

if($db)
{
    $query = "SELECT * FROM account WHERE username = '$username'";
    $result = pg_query($query);

    if ($result)
    {
        $db_password = pg_result($result, 0, "password");
        $db_fullname = pg_result($result, 0, "fullname");
        $db_phone = pg_result($result, 0, "phone");
        $db_birthday = pg_result($result, 0, "birthday");
        
        


        //Decrypt the password and then compare
        if(password_verify($password, $db_password))
        {
            $success = true;
        }
    }
}

echo json_encode(array('success' => $success,
                        'fullname' => $db_fullname,
                        'phone' => $db_phone,
                        'birthday' => $db_birthday,));
                        

?>