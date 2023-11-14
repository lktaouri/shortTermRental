<?php
class Users{   
    
    private $usersTable = "users";      
    public $id;
    public $email; 
    public $password;  
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->usersTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->usersTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->usersTable."(`fname`, `lname`, `address`, `notes`, `country`, `city`, `zipcode`, `email`, `password`, `pnumber`)
			VALUES(?,?,?,?,?,?,?,?,?,?)");
		
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->password = htmlspecialchars(strip_tags($this->password));
		
		
		$stmt->bind_param("ssssssissi", $this->email, $this->password);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->usersTable." 
			SET email = ?, password = ?
			WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
	 
            $stmt->bind_param("ssssssissii", $this->email, $this->password, $this->id);

		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->usersTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}

	function fetch(){

			$stmt = $this->conn->prepare("SELECT * FROM ".$this->usersTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
			
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	function getUserInfo() {
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->usersTable." WHERE email = ? and password = ?");
		$stmt->bind_param("ss", $this->email, $this->password);


		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
}
?>