<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="PHP-SRePS Solution">
        <meta name="author" content="Group 3">
        
        <link rel="stylesheet" href="style/css/style.css">
        <script src="script/stock.js" type="text/javascript"></script>
        
        <title>PHP-SRePS</title>
    </head>

    <script type="text/javascript">
        function ShowHideSelect(chkIsNew) {
            var nameText = document.getElementById("itemNameText");
            var nameList = document.getElementById("itemNameList")
            if (chkIsNew.checked) {
                nameText.style.display = "none";
                nameList.style.display = "inline";
            } else {
                nameText.style.display = "inline";
                nameList.style.display = "none";
            }
        }

        
    </script>

    <body id="stock">
        
        
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
                    
                    <form id="stockForm" method="post" action="order_stock.php">
                        <fieldset>
                            <legend>Current Stock Items</legend>
                            <table id='currentOrder'>
                                <tr>
                                    <th scope='col' class='table_button'>Name</th>
                                    <th scope='col' class='table_button'>Quantity</th>
                                </tr>
                                <?php
                                    require_once ("db_settings.php");
                                    $conn = new PDO($host, $user, $pwd);

                                    $sfsi = $conn->query('SELECT * FROM StockItem ORDER BY SI_ID');
                                    while ($row = $sfsi->fetch()) {
                                        echo "<tr>\n"
                                            ."<td>", $row['Name'], "</td>\n"
                                            ."<td>", $row['Quantity'], "</td>\n"
                                            ."</tr>\n";
                                    }
                                    
                                ?>
                            </table>
                        </fieldset>
                        <fieldset>
                            <legend>Order Stock Item</legend>
                            <p>
                                <label for="itemNameText">Item Name: </label>
                                <input name="StockItemText" id="itemNameText" type="text" maxlength="64" title="Alphabet, Spaces, Hyphens" required="required"/>

                                <select name="StockItemList" id="itemNameList" hidden="hidden">
                                    <option value="Unselected" selected="selected">Please Select</option>
                                    <?php
                                        require_once ("db_settings.php");
                                        $conn = new PDO($host, $user, $pwd);

                                        $sfsi = $conn->query('SELECT * FROM StockItem ORDER BY SI_ID');
                                        while ($row = $sfsi->fetch()) {
                                            echo "<option value=", $row["Name"], ">", $row["Name"], "</option>";
                                        }
                                    ?>
                                </select>

                                <input type="checkbox" name="NewSelected" id="newItem" value="New Item" onclick="ShowHideSelect(this)" />
                                <label for="newItem">Old Item</label>
                                <p class="error" id="itemError"></p>
                            </p>

                            <p>
                                <label for="itemQty">Quantity of Item to Order: </label>
                                <input name="StockItemQty" id="itemQty" type="text" maxlength="3" title="Numbers" size="4"/>
                                <p class="error" id="quantityError"></p>
                            </p>
                            <p>
                                <input type='reset' value='Reset Form' />
                                <input type='submit' value='Order Stock' />
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