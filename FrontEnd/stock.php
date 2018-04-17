<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="PHP-SRePS Solution">
        <meta name="author" content="Group 3">
        
        <link rel="stylesheet" href="style/css/style.css">
        <script src="script/stock.js"></script>
        
        <title>PHP-SRePS</title>
    </head>

    <body id="stock">
        
        
        <!-- HEADER -->
        
        
        <header>
            <div id="topBar"></div><!-- Only exists for style points - Magic happens in css -->
            <a href="index.html" title="Home"><img id='logo' src="style/images/placeholder.png" alt="PHP-SRePS Logo"></a>
            
            <nav id="topNav">
                <ul>
                    <li><a href="sales.html" title="Sales">Sales</a></li>
                    <li><a href="customers.html" title="Customers">Customers</a></li>
                    <li><a href="orders.html" title="Orders">Orders</a></li>
                    <li><a href="stock.php" title="Stock">Stock</a></li>
                    <li><a href="reporting.php" title="Reporting">Reporting</a></li>
                </ul>
            </nav>
        </header>
        
        
        <!-- MAIN -->
        
             
        <main>
            <section>
                <article>
                    
                    <form action="" method="post" id="stockForm">
                        <fieldset>
                            <legend>Search Stock</legend>
                            <p>
                                <label for="itemName">Item Name: </label>
                                <input name="itemName" id="stockItemName" type="text" maxlength="64" title="Alphabet, Spaces, Hyphens"/>
                            </p>
                            <p>
                                <label for="itemQuantity">Quantity in Stock:</label>
                                <?php
                                    $host = "";
                                    $user = "";
                                    $pwd = "";
                                    $sql_db = "";

                                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                                    $stockQuantity = "";

                                    if ($conn) {

                                        if (isset($_GET["SearchName"])) {
                                            $searchName = $_GET["SearchName"];

                                            $query = "SELECT Quantity FROM StockItem WHERE Name = '$searchName' ORDER BY Sale_ID";
                                            $result = mysqli_query($conn, $query);
                                            $row = mysqli_fetch_assoc($result);

                                            $stockQuantity = $row["Quantity"];
                                        }
                                    }

                                    if (isset($_SESSION["stockQuantity"])) {
                                        echo "<input name="itemQuantity" id="stockItemQuantity" type="text" disabled="disabled" value="$stockQuantity"/>"
                                    } else {
                                        echo "<input name="itemQuantity" id="stockItemQuantity" type="text" disabled="disabled"/>"
                                    }
                                ?>
                            </p>

                            <button type="button" id="getStockQuantity">Search Stock</button>
                            <p id="stockQuantityError"></p>

                        </fieldset>                        
                    </form>
                    
                </article>
            </section>
        </main>
        
        
        <!-- FOOTER -->
        
        
        <footer>
            <nav id="botNav">
                <ul>
                    <li><a href="sales.html" title="Sales">Sales</a></li>
                    <li><a href="customers.html" title="Customers">Customers</a></li>
                    <li><a href="orders.html" title="Orders">Orders</a></li>
                    <li><a href="stock.php" title="Stock">Stock</a></li>
                    <li><a href="reporting.php" title="Reporting">Reporting</a></li>
                </ul>
            </nav>
            
            <p>&#169; DP2 PHP-SRePs Group 3 Tue 6:30pm</p>
            <p>Designed by Jai Lafferty, Stuart Bassett, Shenal Samarasinghe and Ryan Payne</p>    
        </footer>
    </body>
</html>