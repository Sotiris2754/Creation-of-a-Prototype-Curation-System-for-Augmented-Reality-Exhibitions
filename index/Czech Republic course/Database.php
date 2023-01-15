<?php  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * 
 */
class Database
{

	private $dsn = "mysql:host=localhost;dbname=xmul2_21_ws_s_dovas";
	private $user = "xmul2_21_ws_s_dovas";
	private $pass = "sotirios21";
	public $conn;

	function __construct()
	{
		try {
			$this->conn = new PDO($this->dsn,$this->user,$this->pass);
			//echo "Connection succesful.";
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function read()
	{
		$data = array();
		$sql = "SELECT * FROM users";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			$data[] = $row;
		}
		return $data;

	}

	public function insert($fname,$lname,$email,$phone){
		$sql = "INSERT INTO users(first_name,last_name,email,phone) VALUES (:fname,:lname,:email,:phone)";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(
			array(
				':fname'=>$fname,
				':lname'=>$lname,
				':email'=>$email,
				':phone'=>$phone,
			)
		);
		return true;
	}

	public function delete($del_id){
		$sql = "DELETE FROM users WHERE id = :id";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(':id'=>$del_id));
		return true;

	}

	public function getUserById($edit_id){
		$sql = "SELECT * FROM users WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(':id'=>$edit_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return json_encode($result);
	}

	public function update($id,$fname,$lname,$email,$phone){
		$sql = "UPDATE users SET first_name = :fname, last_name = :lname, email = :email, phone= :phone WHERE id = :id";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(
			array(
				':fname'=>$fname,
				':lname'=>$lname,
				':email'=>$email,
				':phone'=>$phone,
				':id'=>$id
			)
		);
		return true;
	}


	public function checkLogin($username,$pass){
		$sql = "SELECT * FROM staff WHERE username = :username AND pass= :pass";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
			':username'=> $username,
			':pass'=>$pass
		));

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
		// return json_encode($result);
	}


}

//$db = new Database();

?>