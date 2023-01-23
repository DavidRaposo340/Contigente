<?PHP

	function createConta($nome, $idade, $email, $encrypt_pass, $no_gluten, $no_lact, $vegan){
		global $conn;
        ///mudar pls!!
			$query = "select * from cities where 1=1";
			if($city)	{
				$query .= " AND name like '$city'";
			}

			if(!empty($countries) && sizeof($countries) > 0){
				$query .= " AND ";

				for($i=0; $i < sizeof($countries);$i++){
						if($i>0){
						$query .= " OR ";
						}
						$query .= "country = '". $countries[$i]."'";
				}
			}
			$query .= " order by country;";
			$result = pg_exec($conn, $query);
			return $result;
	}

	function getUserByEmailAndPass($email, $pass){
		$result = "david";
		return $result;
	}
?>