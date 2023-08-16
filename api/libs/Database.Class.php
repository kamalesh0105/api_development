<?

use Database as GlobalDatabase;

class Database
{

    public static $conn = null;
    public static function get_Connection()
    {

        $config_json = file_get_contents("../../env.json");
        $config = json_decode($config_json, true);



        if (Database::$conn != null) {
            return Database::$conn;
        } else {
            Database::$conn = mysqli_connect($config['server'], $config['username'], $config['password'], $config['database']);
            if (!(Database::$conn)) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                return Database::$conn;
            }
        }
    }
}
