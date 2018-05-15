<?php
	function sanitise_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$t = time();

		if (isset($_POST["StockItemText"])) {
			$textStockItem = sanitise_input($_POST["StockItemText"]);
		}
		if ($_POST["StockItemList"] != "Unselected") {
			$selectedStockItem = sanitise_input($_POST["StockItemList"]);
		}
		if (isset($_POST["StockItemQty"])) {
			$quantity = sanitise_input($_POST["StockItemQty"]);
		}

		require_once ("db_settings.php");
        $conn = new PDO($host, $user, $pwd);

		if ($textStockItem != "") {
			$addItem = $conn->prepare('CALL AddItem(:itemName)');
			$addItem->bindParam(':itemName', $textStockItem);
			$addItem->execute();

			$itemName = $textStockItem;
		} else {
			$itemName = $selectedStockItem;
		}

        $createOrder = $conn->prepare('CALL CreateStockOrder(:orderTime, @out_ID)');
		$createOrder->bindParam (':orderTime', $t, PDO::PARAM_INT);
        $createOrder->execute();
        $orderResult = $conn->query('SELECT @out_ID')->fetch(PDO::FETCH_ASSOC);
        $so_id = $orderResult['@out_ID'];
		echo $so_id;

        $orderItem = $conn->prepare('CALL OrderStock(:itemName, :orderQuantity, :SO_ID)');
		$orderItem->bindParam (':itemName', $itemName, PDO::PARAM_STR);
		$orderItem->bindParam (':orderQuantity', $quantity, PDO::PARAM_INT);
		$orderItem->bindParam (':SO_ID', $so_id, PDO::PARAM_INT);
        $orderItem->execute();

        header("location: orders.php");
	}
?>
