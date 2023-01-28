<?PHP

    //retorna vetor/lista com: id, prod (id), quant 
    function getShoppingCartbyUserID($user) //vao existir varias linhas se existirem vários produtos no carrinho do user(id)
    {
        global $conn;
        $query = "	SELECT  shopping_cart.id 		            As   id, 
							shopping_cart.id_product            As   id_prod,
							shopping_cart.quantity_product	    As   quant,
                            products.name                       As   name
                        FROM contigente.shopping_cart  JOIN contigente.products
                        ON shopping_cart.id_product=products.id
                        WHERE shopping_cart.id_user='".$user."';
				";
		$result = pg_exec($conn, $query);
		return $result;
        
    }

    function getTotalPriceofShoppingCartofUser($user){
        global $conn;
        $totalpriceCart= 0;

        $query = "  SELECT  shopping_cart.id 		            As   id, 
							shopping_cart.id_product            As   prod,
							shopping_cart.quantity_product	    As   quant
                        FROM shopping_cart 
                        WHERE shopping_cart.id_user='".$user."'
				    ";
		$result = pg_exec($conn, $query);
        $numRows = pg_numrows($result);

        $i = 0;
		while ($i < $numRows) {
			$row = pg_fetch_row($result, $i);
			$product_id=$row[1]; 
			$quantity=$row[2]; 
			$aux=getTotalPriceProductbyQuantity($product_id, $quantity); //esta função é do products.php, nao sei bem se a posso chamar aqui
			$totalpriceCart = $totalpriceCart + $aux;

		$i++;
		}
        return $totalpriceCart;
    }

    function insertinShoppingCart($user, $idproduct, $quantity){
        global $conn;

        $query = "	SELECT  shopping_cart.id_product         As   id_product,
                            shopping_cart.quantity_product   As   cart_quant
                    FROM    shopping_cart 
                    WHERE   shopping_cart.id_user='".$user."';
                 ";
        $result = pg_exec($conn, $query);
        $update=0;

        $row = pg_fetch_assoc($result);
        while(isset($row['id_product'])){

            if($row['id_product'] == $idproduct){
                $update=1;

                $new_quant=$row['cart_quant']+$quantity; 
                $updateQuery = "UPDATE shopping_cart
                                set quantity_product= ".$new_quant."
                                where id_product =". $idproduct ." AND id_user='".$user."';
                                ";

                pg_exec($conn, $updateQuery);               
                
            }
            $row = pg_fetch_assoc($result);
        }  
        if ($update==0){

            $insertQuery = "INSERT INTO shopping_cart (id_product, id_user, quantity_product)
                            VALUES ('" . $idproduct . "','" . $user . "','" . $quantity . "');
                            ";
            pg_exec($conn, $insertQuery);
        }
        
    }


    function deleteShoppingCart($user){
        global $conn;

        $deleteQuery = "DELETE FROM shopping_cart 
                        WHERE shopping_cart.id_user='" . $user . "'
                       ";

        pg_exec($conn, $deleteQuery);
    }

    function removeOneUnifromShoppingCart($user, $id_product){
        global $conn;

        $query = "	SELECT  shopping_cart.quantity_product  As quantidade
                    FROM    shopping_cart 
                    WHERE   shopping_cart.id_user=".$user." AND shopping_cart.id_product='".$id_product."'
                 ";
        $result = pg_exec($conn, $query);
        $row = pg_fetch_row($result);
        $quantity = $row[0];

        if(($quantity-1)>0){
            $quantity = $quantity - 1;   
            $updateQuery = "UPDATE  shopping_cart
                            set     quantity_product= ".$quantity."
                            where   id_product =".$id_product." AND id_user='".$user."';
                            ";
            pg_exec($conn, $updateQuery);    
            
        }
        else{
            removeLinefromShoppingCart($user, $id_product);
        }
    }

    function removeLinefromShoppingCart($user, $id_product){
        global $conn;
        $deleteQuery = "DELETE FROM shopping_cart
                        where id_product =".$id_product." AND id_user='".$user."';
                        ";
        pg_exec($conn, $deleteQuery);
    }

?>