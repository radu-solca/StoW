<?php 

class User {

	protected $id = null;
	protected $username = null;
	protected $password = null;
	protected $email = null;
	protected $name = null;
	protected $surname = null;
	protected $roles = [];

	protected $ordby = null;
	protected $ordtype = null;
	protected $limit = null;

	public function register(){
		$db = Connection::getConnection();

		$query =   'DECLARE
						v_id_output users.usr_id%type;
					BEGIN
						v_id_output := usr_utils.register(?,?,?,?,?);
					END;'; 

		$params = [$this->username, md5($this->password), $this->email, $this->name, $this->surname];

		$stmt = $db->prepare($query);
		$stmt->execute($params);
	}

	public function login(){
		$db = Connection::getConnection();

		$query =   'SELECT * 
					FROM users_view
					WHERE ID =
						(
						SELECT usr_utils.login(?,?) 
						AS "ID"
						FROM dual
						)
					'; 

		$params = [$this->username, md5($this->password)];

		$stmt = $db->prepare($query);
		$stmt->execute($params);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$userData = $result[0];
		//do NOT store the password in session.
		unset($userData['PASSWORD']);

		$_SESSION["userData"] = $userData;
	}

	public function logout(){
		unset($_SESSION['userData']);
	}

	public function find(){
			$query = 'SELECT * FROM users_view';

			$cond = array();
			$params = array();

			if (!empty($this->id)) {
			    $cond[] = "ID = ?";
			    $params[] = $this->id;
			}

			if (!empty($this->username)) {
			    $cond[] = "USERNAME = ?";
			    $params[] = $this->username;
			}

			if (!empty($this->password)) {
			    $cond[] = "PASSWORD = ?";
			    $params[] = $this->md5(password);
			}

			if (!empty($this->email)) {
			    $cond[] = "EMAIL = ?";
			    $params[] = $this->email;
			}

			if (!empty($this->name)) {
			    $cond[] = "NAME = ?";
			    $params[] = $this->name;
			}

			if (!empty($this->surname)) {
			    $cond[] = "SURNAME = ?";
			    $params[] = $this->surname;
			}

			if(!empty($this->roles)){
				foreach($this->roles as $role){
					$cond[] = "usr_utils.usr_has_role(ID, ?) = 1";
					$params[] = $role;
				}
			}
			
			if (count($cond)) {
			    $query .= ' WHERE ' . implode(' AND ', $cond);
			}
			
			if (!empty($this->ordby)) {
				if(empty($this->ordtype)){
					$this->ordtype = 'ASC';
				}
			    $query .= " ORDER BY $this->ordby $this->ordtype";
			}

			if (!empty($this->limit)) {
			     $query = "SELECT * FROM ( " . $query . ") WHERE rownum <= ?";
			     $params[] = $this->limit;
			}
			

			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function exists(){
		$result = $this->find();
		return empty($result) ? false : true;
	}

	public function withId($id){
		$this->id = $id;
		return $this;
	}

	public function withUsername($username){
		$this->username = $username;
		return $this;
	}

	public function withPassword($password){
		$this->password = $password;
		return $this;
	}

	public function withEmail($email){
		$this->email = $email;
		return $this;
	}

	public function withName($name){
		$this->name = $name;
		return $this;
	}

	public function withSurname($surname){
		$this->surname = $surname;
		return $this;
	}

	public function withRole($role){
		$this->roles[] = $role;
		return $this;
	}

	public function orderBy($ordby, $ordtype = 'ASC'){
		$this->ordby = $ordby;
		$this->ordtype = $ordtype;
		return $this;
	}

	public function limit($limit){
		$this->limit = $limit;
		return $this;
	}

	public function reset(){
		$this->id = null;
		$this->username = null;
		$this->password = null;
		$this->email = null;
		$this->name = null;
		$this->surname = null;
		$this->roles = [];
	}

}

 ?>