<?PHP
	//retorna vetor/lista com: img_path, nome, id e price de todos os produtos (conforme os filtros)
	//esta é a antiga que já testamos
	/*function getAllProducts($familia, $no_gluten, $no_lact, $vegan, $prec_min, $prec_max ){ 
        global $conn;

        $query = "    SELECT  products.id             As   id, 
                            products.family_id         As   familyid, 
                            products.quantity        As   quantity, 
                            products.price           As   price,
                            products.image_name     AS      img_path,
                            products.name             AS      nome 
                            FROM products INNER JOIN family_products
                            ON products.family_id=family_products.id
                            WHERE family_products.name='".$familia."'
                            AND products.price BETWEEN $prec_min AND $prec_max;
                    ";

        $result = pg_exec($conn, $query);

        return $result;
    }*/

	//nao esta muito elegante, funciona na DB mas nao consigo testar no samba pq os filtros n funcionam na minha pag nao sei porque
	function getAllProducts($familia, $no_gluten, $no_lact, $vegan, $prec_min, $prec_max ){ 
		global $conn;
		$query = "    SELECT  		products.id             	As   id, 
									products.family_id      	As   familyid, 
									products.quantity       	As   quantity, 
									products.price          	As   price,
									products.image_name     	AS   img_path,
									products.name          		AS   nome 
									FROM products INNER JOIN family_products
									ON products.family_id=family_products.id
			";
			
		if($familia){ //se a familia nao for nula, faz os filtros pela familia
			$query .= "WHERE family_products.name='".$familia."'";
			if($prec_min AND $prec_max){ //ou queres separar?
				$query .= "AND products.price BETWEEN $prec_min AND $prec_max";
			}	
	
			if($no_gluten){
				$query .= "AND products.no_gluten=TRUE";
			}
	
			if($no_lact){
				$query .= "AND products.no_lact=TRUE";
			}
	
			if($vegan){
				$query .= "AND products.vegan=TRUE";
			}	
		}
		else{ //nao foi selecionada a família
			if($prec_min AND $prec_max){ //ou queres separar?
				$query .= "WHERE products.price BETWEEN $prec_min AND $prec_max";
			}	
	
			if($no_gluten){
				$query .= "AND products.no_gluten=TRUE";
			}
	
			if($no_lact){
				$query .= "AND products.no_lact=TRUE";
			}
	
			if($vegan){
				$query .= "AND products.vegan=TRUE";
			}	
		}

		$result = pg_exec($conn, $query);
		return $result;
	}

	//Retorna img_path, nome, id, price, familia  do produto 
	function getProductByID($id){ 
		global $conn;
		$query = "	SELECT  products.id 			As   id, 
							products.family_id 		As   familiaid,
							products.quantity		As   quantity, 
							products.price   		As   price, 
							products.image_name 	AS 	 img_path,
							products.name 			AS 	 nome,
							family_products.name    AS   familia
					FROM products INNER JOIN family_products
					ON products.family_id=family_products.id
					WHERE products.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		return $result;
	}


	function updateProductPrice($id, $newprice){ 
		global $conn;

		$updateQuery = "UPDATE products
						set price = ".$newprice."
						WHERE id ="  . $id .";";

		$result = pg_exec($conn, $updateQuery);

	}

	function getPriceofProduct($id){
		global $conn;
		$query = "	SELECT  products.price   As   price, 
						FROM products 
						WHERE products.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
		return $row[0];
	}

	function getQuantityofProductbyID($id){ 
		global $conn;

		$query = "SELECT products.quantity as quant
					FROM products
					WHERE id ="  . $id .";";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
		return $row[0];
	}

	function getRestrictionsofProductbyID($id){
		global $conn;

		$query = "SELECT products.no_gluten AS no_gluten,
						 products.no_lacti  AS no_lactose,
						 products.no_lacti  AS vegan
					FROM products
					WHERE id ="  . $id .";";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);

		if($row['no_gluten']==TRUE)
		{
			$row['no_gluten']="Isento de glúten";
		}
		else
		{
			$row['no_gluten']=NULL;
		}

		if($row['no_lactose']==TRUE)
		{
			$row['no_lactose']="Sem lactose";
		}
		else
		{
			$row['no_lactose']=NULL;
		}

		if($row['vegan']==TRUE)
		{
			$row['vegan']="Sem lactose";
		}
		else
		{
			$row['vegan']=NULL;
		}

		return $row;
		/* depois acedes assim
		echo $row['no_lactose'];
		echo $row['no_gluten'];
		echo $row['vegan'];*/
	}

	function updateQuantityofProduct($id, $quant){ //funcionou na DB
		global $conn;

		$updateQuery = "UPDATE products
						set quantity= ".$quant."
						where id ="  . $id .";";

		$result = pg_exec($conn, $updateQuery);
	}

	function createProduct($family, $quantity, $price, $no_gluten, $no_lacti, $vegan, $image, $name){
		global $conn;

		$query = "	SELECT  family_products.id As familyproducts_id
					FROM family_products
					WHERE family_products.name='".$family."' ";
		$result = pg_exec($conn, $query);
		$family_id=$result;

		$query = "INSERT into products (family_id, quantity, price, no_gluten, no_lacti, vegan, image_name, name)
						 values ('".$family_id."', '".$quantity."', '".$price."' ,'".$no_gluten."', '".$no_lacti."', '".$vegan."','".$image."', '".$name."');";

		$result = pg_exec($conn, $query);
		return $query;	
	}

	

	
?>
