<?PHP
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
									WHERE products.price BETWEEN $prec_min AND $prec_max 
			";
			
		if($familia!="todas"){ //se a familia nao for nula, faz os filtros pela familia
			$query .= "AND family_products.name='".$familia."' ";
		}
		if($no_gluten){
			$query .= "AND products.no_gluten=TRUE ";
		}

		if($no_lact){
			$query .= "AND products.no_lacti=TRUE ";
		}

		if($vegan){
			$query .= "AND products.vegan=TRUE ";
		}			

		$query .= ";";

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
					WHERE products.id='".$id."';
				";

		$result = pg_exec($conn, $query);
		return $result;
	}
	
	function getFamilyIDbyName($family){
		global $conn;
		$query = "	SELECT  family_products.id   As   family_id
					FROM 	family_products 
					WHERE 	family_products.name		=	'".$family."';

				";
		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
		return $row['family_id'];
	}

	function updateProductPrice($id, $newprice){ 
		global $conn;

		$updateQuery = "UPDATE products
						set price = ".$newprice."
						WHERE id ="  . $id .";";

		$result = pg_exec($conn, $updateQuery);

	}

	function editProduct($id, $familiaid, $quantity, $price, $no_gluten, $no_lact, $vegan, $nome){ 
		global $conn;

		$updateQuery = "UPDATE products 
						SET 	price 		='".$price."', 
								family_id 	='".$familiaid."', 
								quantity 	='".$quantity."',
								no_gluten 	='".$no_gluten."',
								no_lacti 	='".$no_lact."',
								vegan 		='".$vegan."',
								name 		='".$nome."'
						WHERE	id 			='".$id."';
						";

		$result = pg_exec($conn, $updateQuery);
	}

	function deleteProduct($id){
        global $conn;

        $deleteQuery = "DELETE FROM products
                        WHERE products.id='" . $id . "'
                       ";

        pg_exec($conn, $deleteQuery);
    }

	function getPriceofProduct($id){
		global $conn;
		$query = "	SELECT  products.price   As   price, 
						FROM products 
						WHERE products.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
		return $row['price'];
	}

	function getQuantityofProductbyID($id){ 
		global $conn;

		$query = "SELECT products.quantity as quant
					FROM products
					WHERE id ="  . $id .";";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);
		return $row['quant'];
	}

	function getRestrictionsofProductbyID($id){
		global $conn;

		$query = "SELECT products.no_gluten AS no_gluten,
						 products.no_lacti  AS no_lactose,
						 products.no_lacti  AS vegan
					FROM products
					WHERE id =".$id.";";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);

		if($row['no_gluten']=="t")
			$row['no_gluten']="Isento de glúten";
		
		else
			$row['no_gluten']="Contém glúten";
		

		if($row['no_lactose']=="t")
			$row['no_lactose']="Sem lactose";

		else
			$row['no_lactose']="Contém lactose";
		

		if($row['vegan']=="t")
			$row['vegan']="Vegan";
		
		else
			$row['vegan']="Não vegan";
		
		return $row;

	}

	
	function getBoolRestrictionsofProductbyID($id){
		global $conn;

		$query = "SELECT products.no_gluten AS no_gluten,
						 products.no_lacti  AS no_lactose,
						 products.vegan  AS vegan
					FROM products
					WHERE id =".$id.";";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_assoc($result);	
		return $row;

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
					WHERE family_products.name='".$family."'; ";

		$result = pg_exec($conn, $query);
		//$family_id = pg_fetch_assoc($result['familyproducts_id']);
		$row=pg_fetch_assoc($result);
		$family_id=$row['familyproducts_id'];
		
		$query = "INSERT into products (family_id, quantity, price, no_gluten, no_lacti, vegan, image_name, name)
						 values ('".$family_id."', '".$quantity."', '".$price."' ,'".$no_gluten."', '".$no_lacti."', '".$vegan."','".$image."', '".$name."');";

		$result = pg_exec($conn, $query);
		return $query;	
	}

	function getFamilyProducts(){
		global $conn;

		$query = "	SELECT  *		
					FROM family_products
				 ;";

		$result = pg_exec($conn, $query);
		return $result;	
	}

	function getNameofProductbyID($idProduct){
		global $conn;

		$query = "	SELECT name as nome		
					FROM products
					WHERE id ='". $idProduct."';
				 ";

		$result = pg_exec($conn, $query);
		$row = pg_fetch_row($result);
		return $row[0];
	}

	function getProductbyFilter($filtro_product){
		global $conn;
		$query = "	SELECT  products.id 			As   id, 
							products.family_id 		As   familyid,
							products.quantity		As   quantity, 
							products.price   		As   price, 
							products.image_name 	AS 	 img_path,
							products.name 			AS 	 nome,
							family_products.name    AS   familia
					FROM products INNER JOIN family_products
					ON products.family_id=family_products.id
					WHERE LOWER(products.name) LIKE LOWER('%".$filtro_product."%')
				";
			$result = pg_exec($conn, $query);
			return $result;
	}
	

	
?>
