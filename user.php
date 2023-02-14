<?php
class User
{
    public $id, $first_name, $last_name, $date, $gender, $city;

    function __construct(
        $id,
        $first_name,
        $last_name,
        $date,
        $gender,
        $city = 'undefined'
    )
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->date = $date;
        $this->gender = $gender;
        $this->city = $city;
    }
    static function convertGender($user)
    {
        if ($user->gender == 0) {
            $user->gender = 'woman';
        }
        if ($user->gender == 1) {
            $user->gender = 'man';
        }
        return $user->gender;
    }
    static function GetAge($user)
    {
        $diff = date('Ymd') - date('Ymd', strtotime($user->date));
        return substr($diff, 0, -4);

    }

    private function Message()
    {
        echo 'User has been created';
    }
    private function getUsers()
    {
        $files = file_get_contents('bd.json');
        $array = json_decode($files, true);
        return $array;
    }
    function AddUser($user)
    {
        $bdArr = $this->getUsers();
        $bdArr[] = $user;
        file_put_contents('bd.json', json_encode($bdArr));
        unset($bdArr);
        unset($user);
        $this->Message();
    }

    function RemoveUser($userId)
    {
        $array = $this->getUsers();
        $result = array_filter($array, function ($item) use ($userId) {
            return $item['id'] != $userId->{'id'};
        });
        if ($result) {
            $data = $result;
            $data = json_encode($result);
            file_put_contents('bd.json', $data);
        }
    }

    function GetUserById($id)
    {
        $array = $this->getUsers();
        $result = array_filter($array, function ($item) use ($id) {
            return $item['id'] == $id;
        });
        echo json_encode($result[0]);
        return $result[0];
    }
    function FormatUser($user)
    {
        $obj = new stdClass();
        $obj->id = $this->id;
        $obj->first_name = $this->first_name;
        $obj->last_name = $this->last_name;
        $obj->date = $this->date;
        $obj->gender = $this->gender;
        $obj->city = $this->city;
        $this->date = self::GetAge($user);
        $this->gender = self::convertGender($user);
        return $obj;
    }
    
}
?>