<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="PHP-SRePS Solution">
        <meta name="author" content="Group 3">
        
        <link rel="stylesheet" href="style/css/style.css">
        <script src="script/record.js"></script>
        
        <title>PHP-SRePS</title>
    </head>

    <!-- Change the body ID depending on the page -->
    <body id="reporting">
        
        
        <!-- HEADER -->
        
        
        <header>
            <div id="topBar"></div><!-- Only exists for style points - Magic happens in css -->
            <a href="index.html" title="Home"><img id='logo' src="style/images/placeholder.png" alt="PHP-SRePS Logo"></a>
            
            <nav id="topNav">
                <ul>
                    <li><a href="sales.php" title="Sales">Sales</a></li>
                    <li><a href="customers.html" title="Customers">Customers</a></li>
                    <li><a href="orders.php" title="Orders">Orders</a></li>
                    <li><a href="stock.php" title="Stock">Stock</a></li>
                    <li><a href="reporting.php" title="Reporting">Reporting</a></li>
                </ul>
            </nav>
        </header>
        
        
        <!-- MAIN -->
        
        
        <main>
            <section>
                <article>
                    
                    <form action="" method="post" id="recordForm">
                        <fieldset>
                            <legend>Search Details</legend>
                            <p>
                                <label for="searchChoice">Search By: </label>
                                <select name="searchChoice" id="recordSearchChoice" class="required">
                                    <option selected="selected" disabled="disabled">Choice</option>
                                    <option value="ID">ID</option>
                                    <option value="Date">Date-Time</option>
                                </select>
                                <label for="search">Search: </label>
                                <input name="search" id="recordSearch" class="required" type="text" maxlength="25" required="required" title="Alphabet, Spaces, Hyphens" disabled="disabled"/>
                            </p>
                            <p id="reportSearchError"></p>
                            <button type="button" id="searchRecords">Search Records</button>
                        </fieldset>
                        <fieldset>
                            <legend>Record Details</legend>
                            <p>
                                <table id="returnedRecord">
                                    <tr>
                                        <th>ID</th>
                                        <th>Time</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                    </tr>

                                    <?php
                                        $host = "";
                                        $user = "";
                                        $pwd = "";
                                        $sql_db = "";

                                        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                                        if ($conn) {

                                            if (isset($_GET["Search"])) {
                                                $search = $_GET["Search"];
                                                $choice = $_GET["Choice"];

                                                switch($choice) {
                                                    case "ID":
                                                        $query = "SELECT Sale.Sale_ID, Sale.saletime, SaleItem.qty, StockItem.Name FROM Sale NATURAL JOIN SaleItem NATURAL JOIN StockItem WHERE Sale.Sale_ID = '$search' ORDER BY Sale_ID";
                                                        break;
                                                    case "Date":
                                                        $query = "SELECT Sale.Sale_ID, Sale.saletime, SaleItem.qty, StockItem.Name FROM Sale NATURAL JOIN SaleItem NATURAL JOIN StockItem WHERE Sale.saletime LIKE '$search' ORDER BY Sale_ID";
                                                        break;
                                                }

                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_fetch_assoc($result);

                                                echo "<tr>\n"
                                                    ."<td>", $row["Sale_ID"], "</td>\n"
                                                    ."<td>", $row["saletime"], "</td>\n"
                                                    ."<td>", $row["name"], "</td>\n"
                                                    ."<td>", $row["qty"], "</td>\n"
                                                    ."</tr>\n";
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td>This</td>
                                        <td>Time</td>
                                        <td>is</td>
                                        <td>dummy</td>
                                    </tr>
                                </table>
                            </p>
                        </fieldset>
                    </form>
                    
                </article>
            </section>
        </main>
        
        
        <!-- FOOTER -->
        
        
        <footer>
            <nav id="botNav">
                <ul>
                    <li><a href="sales.php" title="Sales">Sales</a></li>
                    <li><a href="customers.html" title="Customers">Customers</a></li>
                    <li><a href="orders.php" title="Orders">Orders</a></li>
                    <li><a href="stock.php" title="Stock">Stock</a></li>
                    <li><a href="reporting.php" title="Reporting">Reporting</a></li>
                </ul>
            </nav>
            
            <p>&#169; DP2 PHP-SRePs Group 3 Tue 6:30pm</p>
            <p>Designed by Jai Lafferty, Stuart Bassett, Shenal Samarasinghe and Ryan Payne</p>    
        </footer>
    </body>
</html>