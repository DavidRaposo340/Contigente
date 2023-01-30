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

	function emailExists($email){ //retorna true caso o email exista, se nao existir retorna false
		global $conn;
		$query = "	SELECT users.id AS id
					FROM users
					WHERE users.email='".$email."'
					";
		
		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
        
		if(isset($row['id']))
			return 1;
		
		else
			return 0;
		

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

	function getUserbyID($userID){
		global $conn;
		$query = "	SELECT 	users.name 		As   name, 
							users.address	AS 	 address,
							users.email		AS 	 email,
							users.no_gluten	AS 	 no_gluten,
							users.no_lacti	AS 	 no_lact,
							users.vegan		AS 	 vegan
					FROM users
					WHERE users.id=".$userID.";
					";
		
		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
		return $row;
		
	}

	function getRestrictionsofUser($idUser){
		global $conn;
			$query = "	SELECT  users.no_gluten 	As   no_gluten, 
								users.no_lacti		AS 	 no_lacti,
								users.vegan			As   vegan 
						FROM users
						WHERE users.id="  . $idUser .";
						";
			$result = pg_exec($conn, $query);
			return $result;
	}

	function editConta($userID, $nome, $address, $email, $encrypt_pass, $no_gluten, $no_lact, $vegan){ 
		global $conn;

		$insertQuery = "UPDATE users 
						SET name='".$nome."',
							address='".$address."', 
							email='".$email."',
							password='".$encrypt_pass."', 
							no_gluten='".$no_gluten."', 
							no_lacti='".$no_lact."', 
							vegan='".$vegan."'
						WHERE id ='".$userID."';
						"; 
			

		pg_exec($conn, $insertQuery);
	
	}

	function deleteUser($iduser){
        global $conn;

        $deleteQuery = "DELETE FROM users
                        WHERE users.id='" . $iduser . "'
                       ";

        pg_exec($conn, $deleteQuery);
    }



?>