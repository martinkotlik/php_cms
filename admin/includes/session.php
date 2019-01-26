<?php

class Session {

    private $signed_in = false;
    public $user_id;

    function __construct() {
        session_start();
        $this->check_the_login();
    }
    // getter for private value signed_in
    public function is_signed_in() {
        return this->$signed_in;
    }

    // after login set up user_id with id of user from User class instance
    public function login($user) {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    // logout function
    public function logout($user) {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }


    // check whether session is created and set user_id and signed_in property
    private function check_the_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

}
// create new Session class on aplication start
$session = new Session();

?>
