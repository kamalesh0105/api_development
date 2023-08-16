<?
include "Database.Class.php";

class Signup
{
    public $conn;
    private $username;
    private $password;
    private $email;

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

            $query = "INSERT INTO `auth` (`username`, `password`, `email`, `active`)
            VALUES ('$this->username', '$hashpass', '$this->email', '1')";
            if ($this->conn->query($query)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
            //throw new Exception("username and pass is not set");
        }
    }
}
