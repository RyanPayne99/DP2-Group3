<?php
	function sanitise_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (isset($_POST["Order"])) {
			$order_id = sanitise_input($_POST["Order"]);
		}


		echo $order_id;
		require_once ("db_settings.php");
        $conn = new PDO($host, $user, $pwd);

        $commitOrder = $conn->prepare('CALL CommitStockOrder(:order_id)');
		$commitOrder->bindParam (':order_id', $order_id, PDO::PARAM_INT);
        $commitOrder->execute();

        header("location: stock.php");
	}
?>
