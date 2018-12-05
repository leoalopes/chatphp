<?php

include_once('libraries/Connection.php');

class User {
    
    public function __construct() {
        
    }
    
    private function connect() {
        $conn = new Connection();
        return $conn->getConnection();
    }

    public function register($data) {
        $conn = $this->connect();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $verify = $conn->query("select * from person where name = '".$data['name']."';");
        if($verify->num_rows > 0) {
            header(ERROR);
            $response = ['error'=>'Nickname already taken'];
        } else {
            $sql = "insert into person(name, password) values('".$data['name']."', '".$data['password']."');";
            $conn->query($sql);
            header(SUCCESS);
            $_SESSION['logged'] = ['id'=>$conn->insert_id, 'name'=>$data['name'], 'image'=>''];
            $response = [];
        }
        mysqli_close($conn);
        return $response;
    }

    public function login($data) {
        $conn = $this->connect();
        $verify = $conn->query("select * from person where name = '".$data['name']."';");
        if($verify->num_rows == 0) {
            header(ERROR);
            $response = ['error'=>'Nickname not registered yet.'];
        } else {
            $user = $verify->fetch_assoc();
            if(password_verify($data['password'], $user['password'])) {
                header(SUCCESS);
                unset($user['password']);
                $_SESSION['logged'] = $user;
                $response = [];
            } else {
                header(ERROR);
                $response = ['error'=>'Invalid credentials.'];
            }
        }
        mysqli_close($conn);
        return $response;
    }

    public function editProfile($data) {
        $conn = $this->connect();
        if(isset($data['name']) && $data['name'] != '' && $data['name'] != $_SESSION['logged']['name']) {
            $verify = $conn->query("select * from person where name = '".$data['name']."';");
            if($verify->num_rows > 0) {
                header(ERROR);
                $response = ['error'=>'Nickname already registered.'];
                return $response;
            }
        }
        $sql = "update person".(isset($data['name']) && $data['name'] != '' ? " set name = '".$data['name']."'" : "").(isset($data['image']) && $data['image'] != '' ? (isset($data['name']) && $data['name'] != '' ? ", image = '".$data['image']."'" : " set image = '".$data['image']."'") : "")." where id = ".$_SESSION['logged']['id'].";";
        $conn->query($sql);
        $user = $conn->query("select id, name, image from person where id = '".$_SESSION['logged']['id']."';");
        $_SESSION['logged'] = $user->fetch_assoc();
        header(SUCCESS);
        mysqli_close($conn);
        return [];
    }
}

?>