<?PHP
		
	//criar conta do tipo Cliente
	function createConta($nome, $address, $email, $encrypt_pass, $no_gluten, $no_lact, $vegan){ 
		global $conn;

		$insertQuery = "INSERT INTO users (type, name, address, email, password, no_gluten, no_lacti, vegan)

						VALUES ('3','".$nome."','".$address."','".$email."','".$encrypt_pass."','".$no_gluten."', '".$no_lact."', '".$vegan."');"; 
			

		$result = pg_exec($conn, $insertQuery);
	}

	function getUserByEmailAndPass($email, $pass){ //se existir dou o id, se nao existir NULL
		global $conn;

		$query = "	SELECT users.id AS id
					FROM users
					WHERE users.email='".$email."' AND users.password='".$pass."'
					";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_row($result);
		return $row[0];

	}

	function emailExists($email){ //retorna id do user caso o email exista, se nao existir retorna NULL
		global $conn;
		$query = "	SELECT users.id AS id
					FROM users
					WHERE users.email='".$email."'
					";
		
		$result = pg_exec($conn, $query);
		if($result==NULL){
			return NULL;
		}
		else{
			$row = pg_fetch_row($result);
			return $row[0];
		}
	}

	function getNamebyUserID($userID){
		global $conn;
		$query = "	SELECT users.name AS nome
					FROM users
					WHERE users.id=".$userID.";
					";
		
		$result = pg_exec($conn, $query);
		$row = pg_fetch_row($result);
		return $row[0];
		
	}
?>