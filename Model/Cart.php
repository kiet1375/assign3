<?php require_once("../Model/ShoppingCart.php") ?>
<?php 
	session_start();
    if (isset($_POST['getCart'])) {
        echo getCart($_POST['getCart']);
    }
	
    function getCart($data){
		//echo $data;
		$count = 0;
		$obj;
		$array = [];
		$fh = fopen('../ShoppingCart/shoppingCart.txt', 'r');
		while(! feof($fh)){
			$line = fgets($fh);
			$exploded = explode("\r\n",$line);
			$theData = implode("", $exploded);
			$exploded = explode(",", $theData);
			$length = count($exploded);
			$obj = new ShoppingCart;
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
						$array[$count] = $obj;
						$count++;
						break;
				}
			}
		}
		fclose($fh);
		return json_encode($array);
    }
	function writeToFile($par){
		$myFile = "../ShoppingCart/shoppingCart.txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $par);
		fclose($fh);
	}
	function addToCart($par){
		$myFile = "../ShoppingCart/shoppingCart.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		fwrite($fh, $par);
		fclose($fh);
	}

?>