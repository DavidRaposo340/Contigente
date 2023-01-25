<?PHP

	function getAllProducts($familia, $no_gluten, $no_lact, $vegan, $prec_min, $prec_max ){ //query confirmada na DB
		//retorna vetor/lista com: img_path, nome, id e price de todos os produtos (conforme os filtros) 
		global $conn;
		$query = "	SELECT  products.id 			As   product_id, 
							products.family_id 		As   product_familyid, 
							products.quantity		As   product_quantity, 
							products.price   		As   product_price, 
							products.image_name 	AS 	 product_image,
							products.name 			AS 	 product_name 
					FROM products INNER JOIN family_products
					ON products.family_id=family_products.id
					WHERE family_products.name='".$familia."'
					AND products.price BETWEEN $prec_min AND $prec_max;
				";

		$result = pg_exec($conn, $query);
		echo "DEBUG num_rows: " . pg_num_rows($result);
		echo $result;
		return $result;
	}

	function getProductByID($id){ //query confirmada na DB
		//retorna img_path, nome, id, price, familia e restr (e descr) do produto 
		global $conn;
		$query = "	SELECT  products.id 			As   product_id, 
							products.family_id 		As   product_familyid, 
							products.quantity		As   product_quantity, 
							products.price   		As   product_price, 
							products.image_name 	AS 	 product_image,
							products.name 			AS 	 product_name,
							family_products.name    AS   product_familyname 
					FROM products INNER JOIN family_products
					ON products.family_id=family_products.id
					WHERE products.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		return $result;
	}


	function updateProductPrice($id, $newprice){ //da erro na DB
		global $conn;

		$updateQuery = "UPDATE products
						set price = ".$newprice."
						WHERE id ="  . $id .";";

		$result = pg_exec($conn, $updateQuery);

	}

	function getQuantityofProductbyID($id){ //funcionou na DB
		global $conn;

		$query = "SELECT products.quantity as quant
					FROM products
					WHERE id ="  . $id .";";

		$result = pg_exec($conn, $query);
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
