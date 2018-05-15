<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="PHP-SRePS Solution">
        <meta name="author" content="Group 3">
        <link rel="icon" href="style/images/icon.png">
        <link rel="stylesheet" href="style/css/style.css">

        <title>PHP-SRePS</title>
    </head>

    <body id="sales">


        <!-- HEADER -->


        <header>
            <div id="topBar"></div><!-- Only exists for style points - Magic happens in css -->
            <a href="index.html" title="Home"><img id="logo" src="style/images/placeholder.png" alt="PHP-SRePS Logo"></a>

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
                    <form  id="salesForm">
                        <fieldset>
                            <legend>Customer Details</legend>
                            <p>
                                <label for='salesGivenName'>Given Name: </label>
                                <input name="givenName" id="salesGivenName" class="required" type="text" maxlength="64" required="required" title="Alphabet, Spaces, Hyphens"/>
                                <label for="salesSurname">Surname: </label>
                                <input name="surname" id="salesSurname" class="required" type="text" maxlength="25" required="required" title="Alphabet, Spaces, Hyphens"/>
                            </p>
                        </fieldset>
                        <fieldset>
                            <legend>Product Details</legend>
                            <p>
                                <!-- TODO: Make this not this -->
                                <input name="ItemArray" id="itemText" type="text" hidden="hidden"/>

                                <label for="salesProduct">Product: </label>
                                <select name="product" id='salesProduct' required="required">
                                    <option selected='selected' disabled='disabled'>Product</option>
                                    <?php
                                        require_once ("db_settings.php");
                                        $conn = new PDO($host, $user, $pwd);

                                        $sfsi = $conn->query('SELECT * FROM StockItem ORDER BY SI_ID');
                                        while ($row = $sfsi->fetch()) {
                                            echo "<option value=", $row["Name"], ">", $row["Name"], "</option>";
                                        }
                                    ?>
                                </select>
                                <label for='salesPrice'>Price</label>
                                <input name='price' id='salesPrice' class='required' type='number'  title='Greater than 0' required="required"/>
                                <label for="salesQuantity">Quantity</label>
                                <input name="quantity" id="salesQuantity"  type="number"  title="Greater than 0" required="required"/>
                                <button name="confirmProduct" class="formButton" onclick="addItem(); return false;" >Confirm</button>
                            </p>
                            <p>
                                Running Total: $<span id='runningTotal'></span>
                            </p>
                            <p>
                                <div id="box">        
                                    <!-- JS FILLS IN REST OF TABLE -->        
                                </div>
                        </fieldset>
                        <input type='reset' value='Reset' />
                        <input type='submit' value='Complete' />
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

            <p>&#169; PHP-SRePs Group 3 Tue 6:30pm</p>
            <p>Designed by Jai Lafferty, Stuart Bassett, Shenal Samarasinghe and Ryan Payne</p>
        </footer>
        <script type="text/javascript">
                
            function init() {
                html = '<table id="currentOrder"><tr><th>Product</th><th>Qty</th><th>Price</th></tr></table>';
                document.getElementById("box").innerHTML = html;
            }
            
            window.onload = init;
            
            var bill =[];

            function addItem(){
                var salesProduct = document.getElementById("salesProduct").value;
                var salesPrice = document.getElementById("salesPrice").value;
                var salesQuantity = document.getElementById("salesQuantity").value;
                
                if (salesPrice < 0){}
                else if (salesProduct == "Product"){}
                else if (salesQuantity < 0){}
                else {bill.push({"Product": salesProduct, "Price": salesPrice, "Quantity": salesQuantity});}
                
                
                var html = '<table id="currentOrder"><tr><th>Product</th><th>Qty</th><th>Price</th></tr>';
                
                total = 0;
                
                for (var i = 0; i < bill.length; i++) {
                    //Soft checking
                    if (salesPrice.isNaN){ break;}
                    if (salesProduct == "Product"){break;}
                    if (salesQuantity.isNaN){break;}
                    html+="<tr>";
                    html+="<td>"+bill[i].Product+"</td>";
                    html+="<td>"+bill[i].Quantity+"</td>";
                    html+="<td>"+'$'+bill[i].Price+"</td>";
                    html+="</tr>";
                    
                    total += parseInt(bill[i].Price);
                }
                html+="</table>";
                document.getElementById("box").innerHTML = html;
                    
                //Update running total
                document.getElementById("runningTotal").innerHTML = total;
            }

        </script>
    </body>
</html>


