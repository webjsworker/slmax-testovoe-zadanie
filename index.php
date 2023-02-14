<?php
require("user.php");
require("userservice.php");

$user = new User('10', 'Tom', 'Tommy', '1995-09-10', '1', 'NY');
$id = '10';
//$user->AddUser($user);
//$user->RemoveUser($user);
//$user->GetUserById($id);
//User::convertGender($user);
//User::GetAge($user);
//$user->FormatUser($user);

try {
    if (class_exists('User')) {
        $arrId = new UserService('Tom');
        $arrId->GetUsersById($arrId);
    } else {
        return throw new Exception("User class not exist");
    }

} catch (Exception $e) {
    echo 'Exception: ', $e->getMessage();
}

?>
