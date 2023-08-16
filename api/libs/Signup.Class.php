<?
include "Database.Class.php";

class Signup
{
    public $conn;
    private $username;
    private $password;
    private $email;
    private $userid;

    public function __construct($username, $password, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->conn = Database::get_Connection();
    }

    public function Signup()
    {
        if (isset($this->username) and isset($this->password) and isset($this->email)) {
            $option = [
                'cost' => 7,
            ];
            $hashpass = password_hash($this->password, PASSWORD_BCRYPT, $option);
            $bytes = random_bytes(16);
            $token = bin2hex($bytes); //to verify users over email
            $query = "INSERT INTO `auth` (`username`, `password`, `email`, `active`,`token`)
            VALUES ('$this->username', '$hashpass', '$this->email', '1','$token')";
            if ($this->conn->query($query)) {
                $this->userid = mysqli_insert_id($this->conn);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
            //throw new Exception("username and pass is not set");
        }
    }

    public function getUserID()
    {
        return $this->userid;
    }
}
