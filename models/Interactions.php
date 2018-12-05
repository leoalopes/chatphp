<?php

include_once('libraries/Connection.php');

class Interactions {
    
    public function __construct() {
        
    }
    
    private function connect() {
        $conn = new Connection();
        return $conn->getConnection();
    }

    public function setReceiver($data) {
        $conn = $this->connect();
        $sql = "select * from person where id=".$data['receiver'].";";
        $person = $conn->query($sql);
        if($person->num_rows == 0) {
            header(ERROR);
        } else {
            $_SESSION['logged']['receiver'] = $person->fetch_assoc();
            header(SUCESS);
        }
        mysqli_close($conn);
        return;
    }

    public function stayOnline() {
        $conn = $this->connect();
        $sql = "select * from online_person where id_person=".$_SESSION['logged']['id'].";";
        $verify = $conn->query($sql);
        if($verify->num_rows > 0) {
            $sql = "update online_person set last_update='".date('Y-m-d H:i:s')."' where id_person=".$_SESSION['logged']['id'].";";
            $conn->query($sql);
        } else {
            $sql = "insert into online_person values(".$_SESSION['logged']['id'].", '".date('Y-m-d H:i:s')."');";
            $conn->query($sql);
        }
        mysqli_close($conn);
        header(SUCCESS);
    }

    public function getOnline() {
        $conn = $this->connect();
        $sql = "select * from online_person op join person p on p.id = op.id_person where p.id != ".$_SESSION['logged']['id'].";";
        $online = $conn->query($sql);
        if($online->num_rows == 0) {
            $response = [];
        } else {
            $response = [];
            while($row = $online->fetch_assoc()) {
                $response[] = $row;
            }
        }
        mysqli_close($conn);
        header(SUCCESS);
        return $response;
    }

    public function getMessages() {
        $conn = $this->connect();
        $sql = "select m.*, p.*, p2.id as p2_id, p2.name as p2_name, p2.image as p2_image from message m join person p on m.sender = p.id join person p2 on m.receiver = p2.id where m.receiver = ".$_SESSION['logged']['id']." or m.sender = ".$_SESSION['logged']['id']." order by m.sent_at desc;";
        $verify = $conn->query($sql);
        if($verify->num_rows == 0) {
            $response = [];
        } else {
            $response = [];
            while($row = $verify->fetch_assoc()) {
                $found = false;
                foreach($response as $index => $u) {
                    if($row['id'] == $_SESSION['logged']['id']) {
                        if($u['id'] == $row['p2_id']) {
                            $found = true;
                        }
                    } else {
                        if($u['id'] == $row['id']) {
                            $found = true;
                        }
                    }
                }
                if(!$found) {
                    if($row['id'] == $_SESSION['logged']['id']) {
                        $message = ['id'=>$row['id_message'], 'text'=>$row['text'], 'sent_at'=>$row['sent_at'], 'received'=>false];
                        $response[] = ['id'=>$row['p2_id'], 'name'=>$row['p2_name'], 'image'=>$row['p2_image'], 'message'=>$message];
                    } else {
                        $message = ['id'=>$row['id_message'], 'text'=>$row['text'], 'sent_at'=>$row['sent_at'], 'received'=>true];
                        $response[] = ['id'=>$row['id'], 'name'=>$row['name'], 'image'=>$row['image'], 'message'=>$message];
                    }
                }
            }
        }
        mysqli_close($conn);
        header(SUCCESS);
        return $response;
    }

    public function getReceiverMessages() {
        $conn = $this->connect();
        $sender = $_SESSION['logged']['id'];
        $receiver = $_SESSION['logged']['receiver']['id'];
        $sql = "select * from message where sender = ".$sender." and receiver = ".$receiver." or sender = ".$receiver." and receiver = ".$sender." order by sent_at asc;";
        $messages = $conn->query($sql);
        $response = [];
        if($messages->num_rows > 0) {
            while($row = $messages->fetch_assoc()) {
                $row['received'] = ($row['sender'] == $sender ? false : true);
                $response[] = $row;
            }
        }
        mysqli_close($conn);
        header(SUCCESS);
        return $response;
    }

    public function sendMessage($data) {
        $conn = $this->connect();
        $sender = $_SESSION['logged']['id'];
        $receiver = $_SESSION['logged']['receiver']['id'];
        $sql = "insert into message(text, sender, receiver, sent_at) values('".$data['text']."', ".$sender.", ".$receiver.", '".date('Y-m-d H:i:s')."');";
        $conn->query($sql);
        mysqli_close($conn);
        header(SUCCESS);
    }
}

?>