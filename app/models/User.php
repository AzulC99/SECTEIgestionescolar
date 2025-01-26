
<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }


    public function login($email, $password) {

        $this->db->query(SELECT * FROM users WHERE email = email AND status = "active");
        $this->db->bind(':email', $email);

        $row = $this->db->fetch();

        if (! $row) return false;


        

    }



}   

   