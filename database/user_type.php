<?PHP

    function getUserTypebyID($id){ //retorna cliente, gestor ou tecnico. query confirmada no site da DB 
        global $conn;
		$query = "	SELECT  user_type.type			    As   type
					FROM user_type INNER JOIN users
					ON users.type=user_type.id
					WHERE users.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
		return $row;
    }

?>