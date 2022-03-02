<?php

class SignupContr extends  Signup{

    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdRepeat, $email){
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    public function signupUser() {
        if ($this->emptyInput() == false) {
            //echo "Empty input!";
            header("location: ../index.php?error=empyinput");
            exit();
        }
        if ($this->invalidUid() == false) {
            //echo "Invalid username!";
            header("location: ../index.php?error=username");
            exit();
        }
        if ($this->invalidEmail() == false) {
            //echo "Invalid email!";
            header("location: ../index.php?error=email");
            exit();
        }
        if ($this->pwdMatch() == false) {
            //echo "Password don`t match!";
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        if ($this->uidTakenCHeck() == false) {
            //echo "Username or email taken!";
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    private function emptyInput() {
        $result = true;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
            $result = false;
        }

        return $result;
    }

    private function invalidUid() {
        $result = true;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid))
        {
            $result = false;
        }

        return $result;
    }

    private function invalidEmail() {
        $result = true;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result = false;
        }

        return $result;
    }

    private function pwdMatch() {
        $result = true;
        if($this->pwd !== $this->pwdRepeat)
        {
            $result = false;
        }

        return $result;
    }

    private function uidTakenCHeck() {
        $result = true;
        if(!$this->checkUser($this->uid, $this->email))
        {
            $result = false;
        }

        return $result;
    }

}
