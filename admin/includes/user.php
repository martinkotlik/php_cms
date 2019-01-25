<?php

class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    // Set up user query
    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = mysqli_fetch_array($result_set)){
            $object_array[] = self::initialization($row);
        }
        return $object_array;
    }

    // initialization of all atributes for passed records of user
    public static function initialization($record){
        $the_object = new self;

        foreach ($record as $attribute => $value) {
            if($the_object->has_the_attribute($attribute)) {
                $the_object->$attribute = $value;
            }
        }

        return $the_object;
    }

    // return true if object has passed attribute, otherwise false
    private function has_the_attribute($attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }


    // Return set of all users
    public static function find_all_users() {
        return self::find_this_query("SELECT * FROM users");
    }

    // Return specific user
    public static function find_user_by_id($user_id) {
        $result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
        return (!empty($result_array) ? array_shift($result_array) : false);
    }
}




 ?>
