<?php require_once("Model/Item.php") ?>
<?php 
	
    if (isset($_POST['getCart'])) {
		session_start();
		echo getCart($_POST['getCart']);	
    }
	
	if (isset($_POST['deleteItem'])) {
		session_start();
        echo deleteItem($_POST['deleteItem']);
		
    }
	
	if (isset($_POST['actionQty'])) {
		session_start();
        echo actionQty($_POST['actionQty']);
		
    }
	
	if (isset($_POST['getSessionCart'])) {
		session_start();
        echo getSessionCart($_POST['getSessionCart']);
		
    }
	
    function getCart($data){
		$count = 0;
		$obj;
		$array = array();
		$id = 0;
		$copy = false;
		
		if(isset($_SESSION["cart"])){
			foreach($_SESSION['cart'] as $props){
				if($props-> getTypeName()== $data){
					$copy = true;
					$convert = intval($props-> getQty());
					$convert++;
					$objNew = new Item;
					$objNew-> setTypeName($props-> getTypeName());
					$objNew-> setImgFront($props-> getImgFront());
					$objNew-> setImgRear($props-> getImgRear());
					$objNew-> setProductName($props-> getProductName());
					$objNew-> setBrand($props-> getBrand());
					$objNew-> setPrice($props-> getPrice());
					$objNew-> setDetails($props-> getDetails());
					$objNew-> setId($id++);
					$objNew-> setQty($convert);
					$array[$count] = $objNew;
					$count++; 
				}
				else{
					$objNew = new Item;
					$objNew-> setTypeName($props-> getTypeName());
					$objNew-> setImgFront($props-> getImgFront());
					$objNew-> setImgRear($props-> getImgRear());
					$objNew-> setProductName($props-> getProductName());
					$objNew-> setBrand($props-> getBrand());
					$objNew-> setPrice($props-> getPrice());
					$objNew-> setDetails($props-> getDetails());
					$objNew-> setId($id++);
					$objNew-> setQty($props-> getQty());
					$array[$count] = $objNew;
					$count++; 
				}
			}
			if($copy == true){
				$_SESSION["cart"] = $array;
				return json_encode($array);
			}
		}
		
		$fh = fopen('ShoppingCart/shoppingCart.txt', 'r');
		while(! feof($fh)){
			$line = fgets($fh);
			$exploded = explode("\r\n",$line);
			$theData = implode("", $exploded);
			$exploded = explode(",", $theData);
			$length = count($exploded);
			$obj = new Item;
			
			for($x = 0; $x < $length; $x++){
				switch($x){
					case 0:
						$obj->setTypeName($exploded[$x]);
						break;
					case 1:
						$obj->setImgFront($exploded[$x]);
						break;
					case 2:
						$obj->setImgRear($exploded[$x]);
						break;
					case 3:
						$obj->setProductName($exploded[$x]);
						break;
					case 4:
						$obj->setBrand($exploded[$x]);
						break;
					case 5:
						$obj->setPrice($exploded[$x]);
						break;
					case 6:
						$obj->setDetails($exploded[$x]);

						if($obj->getTypeName() == $data){
							$obj-> setId($id++);
							$obj-> setQty(1);
							$array[$count] = $obj;
							$count++;
						}
						break;
				}
			}
		}
		fclose($fh);
		$_SESSION["cart"] = $array;
		return json_encode($array);
    }
	
	function deleteItem($id){
		$count = 0;
		$array = array();
		$convert = intval($id);
		$id = $convert;
		unset($_SESSION['cart'][$id]);
		
		foreach($_SESSION['cart'] as $key => $props) {
			$objNew = new Item;
			$objNew-> setTypeName($props-> getTypeName());
			$objNew-> setImgFront($props-> getImgFront());
			$objNew-> setImgRear($props-> getImgRear());
			$objNew-> setProductName($props-> getProductName());
			$objNew-> setBrand($props-> getBrand());
			$objNew-> setPrice($props-> getPrice());
			$objNew-> setDetails($props-> getDetails());
			$objNew-> setId($count);
			$objNew-> setQty($props-> getQty());
			$array[$count] = $objNew;
			$count++; 
		}
		$_SESSION["cart"] = $array;
		return json_encode($array);		
	}
	
	function actionQty($qty){
		$array = array();
		$count = 0;
		$size = count($qty);
		
		for($i = 0; $i < $size; $i++){
			foreach($_SESSION['cart'] as $props){
				if($props-> getTypeName()== $qty[$i]["type"]){
					$objNew = new Item;
					$objNew-> setTypeName($props-> getTypeName());
					$objNew-> setImgFront($props-> getImgFront());
					$objNew-> setImgRear($props-> getImgRear());
					$objNew-> setProductName($props-> getProductName());
					$objNew-> setBrand($props-> getBrand());
					$objNew-> setPrice($props-> getPrice());
					$objNew-> setDetails($props-> getDetails());
					$objNew-> setId($props-> getId());
					$objNew-> setQty($qty[$i]["qty"]);
					$array[$count] = $objNew;
					$count++; 
				}
			}
		}
		$_SESSION["cart"] = $array;
		return json_encode($array);	
	}
	
	function getSessionCart($summary){
		return json_encode($_SESSION["cart"]);
	}
?>