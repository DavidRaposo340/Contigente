<?PHP

	function getAllReceitas($filtro_rec){ 
        //retorna vetor/lista com: id, nome, difi, tempo e total_price de todas receitas
		//input filtro_rec é o inicio do nome de uma receita. result deve apenas ter receitas com o nome a começar pelo filtro
        //se filtro_rec NULL, retorna todas as receitas
        global $conn;

		if ($filtro_rec != null && $filtro_rec != "") {
			$query = "	SELECT  recipes.id 			As   id, 
								recipes.name 		AS 	 nome,
								recipes.description	As   descr, 
								recipes.method		As   method, 
								recipes.no_person   As   n_doses, 
								recipes.difficulty 	AS 	 difi,
								recipes.total_price	AS 	 total_price,
								recipes.image_name  AS   img_path,
								recipes.type        AS	 type
						FROM recipes
						WHERE recipes.name LIKE 'filtro_rec%' 
						";
			$result = pg_exec($conn, $query);
			return $result;
		}
		else{
			$query = "	SELECT  recipes.id 			As   id, 
								recipes.name 		AS 	 nome,
								recipes.description	As   descr, 
								recipes.method		As   method, 
								recipes.no_person   As   n_doses, 
								recipes.difficulty 	AS 	 difi,
								recipes.total_price	AS 	 total_price,
								recipes.image_name  AS   img_path,
								recipes.type        AS   type
						FROM recipes
			";
			$result = pg_exec($conn, $query);
			return $result;
		}
	}

    function getReceitaByID($id){ 
		//retorna img_path, nome, id, type, difi, tempo, n_doses, total_price, descr e list_prods da receita 
		//ideia das 3 da manha: list_prods é uma lista de ids. que depois tu vais usar tal e qual para adicionar os produtos no carrinh 
        //depois pela funçao getProductByID tiro os nome dos produtos.~

		//funciona na DB
        global $conn;
		$query = "	SELECT  recipes.image_name  AS   img_path
							recipes.id 			As   id, 
							recipes.name 		AS 	 nome,
							recipes.description	As   descr, 
							recipes.method		As   method, 
							recipes.no_person   As   n_doses, 
							recipes.difficulty 	AS 	 difi,
							recipes.total_price	AS 	 total_price,
							recipes.type		AS   type
					FROM recipes
					WHERE recipes.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		return $result;
	}

	function getProductsandQuantityofRecipe($id){ //funciona na DB
		global $conn;
		$query = "	SELECT  list_products.id_product 		As   id_products, 
							list_products.quantity_product	AS   quantity
					FROM list_products
					WHERE list_products.id_recipe='".$id."'
				";
		$result = pg_exec($conn, $query);
		return $result;
	}

	function getTotalPriceProductbyQuantity($id, $quantity){
		global $conn;
		$query = "	SELECT  products.price		As   price 
					FROM products
					WHERE products.id='".$id."'
				";
			$result = pg_exec($conn, $query);
			$row = pg_fetch_row($result);
			$total = $quantity * $row[0];
			return $total;
	}

	function getTotalPriceofRecipe($id){
		global $conn;
		$query = "	SELECT recipes.total_price	AS 	 total_price
					FROM recipes
					WHERE recipes.id='".$id."'
				";
		$result = pg_exec($conn, $query);
		$row = pg_fetch_row($result);
		return $row[0];
	}

	function updateTotalPriceofRecipe($id){ //funcao testada
		$totalprice=0;
		global $conn;

		$result=getProductsandQuantityofRecipe($id); 
		$numRows = pg_numrows($result);

		$i = 0;

		while ($i < $numRows) {
			$row = pg_fetch_row($result, $i);
			$product_id=$row[0]; 
			$quantity=$row[1]; 
			$aux=getTotalPriceProductbyQuantity($product_id, $quantity); 
			$totalprice = $totalprice + $aux;
			echo $totalprice;
		$i++;
		}

		//update do price - query confirmada na DB
		$updateQuery = "UPDATE recipes
						set total_price= ".$totalprice."
						where id ="  . $id .";";

		$result = pg_exec($conn, $updateQuery);
	}
?>

