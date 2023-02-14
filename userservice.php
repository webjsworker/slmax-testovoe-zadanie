<?php
class UserService
{
    public $id = array();


    function __construct($param)
    {
        $files = file_get_contents('bd.json');
        $array = json_decode($files, true);
        $result = array_filter($array, function ($item) use ($param) {
            foreach ($item as $key => $value) {
                if ($value == $param) {
                    array_push($this->id, $item['id']);
                }
            }
            return false;
        });
    }

    function GetUsersById($arrId)
    {
        $files = file_get_contents('bd.json');
        $array = json_decode($files, true);
        $id = $arrId->{'id'};
        $resultarr = [];
        foreach ($id as $key => $value) {
            $result = array_filter($array, function ($item) use ($value) {
                return $item['id'] == $value;
            });
            array_push($resultarr, $result);
        }
        return $resultarr;
    }
}
?>