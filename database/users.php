<?PHP
		
		//criar conta do tipo Cliente
		function createConta($nome, $address, $email, $encrypt_pass, $no_gluten, $no_lact, $vegan){ 
		global $conn;

		$insertQuery = "INSERT INTO users (type, name, address, email, password, no_gluten, no_lacti, vegan)
						VALUES ('3','".$nome."','".$address."','".$email."','".$encrypt_pass."','".$no_gluten."', '".$no_lact."', '".$vegan."');"; 
			
		$result = pg_exec($conn, $insertQuery);
		return $result;
	}

	function getUserByEmailAndPass($email, $pass){ //se existir dou o id, se nao existir NULL
		global $conn;

		$query = "	SELECT users.name AS name
					FROM users
					WHERE users.email='".$email."' AND users.password='".$pass."'
					";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_row($result);
        return $row[0];
	}

?>