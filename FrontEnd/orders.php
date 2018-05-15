<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="PHP-SRePS Solution">
        <meta name="author" content="Group 3">
        
        <link rel="stylesheet" href="style/css/style.css">
        
        <title>PHP-SRePS</title>
    </head>

    <!-- Change the body ID depending on the page -->
    <body id="">
        
        
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
                    <form id="stockForm" method="post" action="commit_stock_order.php">
                        <fieldset>
                            <legend>Current Orders</legend>
                            <table id='currentOrder'>
                                <tr>
                                    <th scope='col'>Order ID</th>
                                    <th scope='col'>Item ID</th>
                                    <th scope='col'>Item Name</th>
                                    <th scope='col'>Quantity Ordered</th>
                                    <th scope='col'>Time of Order</th>
                                </tr>
                                <?php
                                    require_once ("db_settings.php");
                                    $conn = new PDO($host, $user, $pwd);

                                    $sfsi = $conn->query('SELECT SIO.SI_ID, SIO.SO_ID, SIO.qty, SI.Name, SO.orderdate FROM StockItem SI NATURAL JOIN StockItemOrder SIO NATURAL JOIN StockOrder SO ORDER BY SI_ID');
                                    while ($row = $sfsi->fetch()) {
                                        echo "<tr>\n"
                                            ."<td>"
                                            ."<input type='radio' name='Order' id=", $row['SO_ID'], " value=",$row['SO_ID'], " />\n"
                                            ."<label for=", $row['SO_ID'], ">", $row['SO_ID'], "</label></td>\n"
                                            ."<td>", $row['SI_ID'], "</td>\n"
                                            ."<td>", $row['Name'], "</td>\n"
                                            ."<td>", $row['qty'], "</td>\n"
                                            ."<td>", $row['orderdate'], "</td>\n"
                                            ."</tr>\n";
                                    }
                                    
                                ?>
                            </table>

                            <p>
                                <input type='reset' value='Reset Form' />
                                <input type='submit' value='Commit Order' />
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