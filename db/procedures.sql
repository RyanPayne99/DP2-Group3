-- DELIMITER command is necessary for the cli to define procedures.
DELIMITER //

DROP PROCEDURE IF EXISTS AddItem; //
CREATE PROCEDURE AddItem(item_name VARCHAR(64))
MODIFIES SQL DATA
BEGIN
	INSERT INTO StockItem(Name, Quantity) VALUES (item_name, 0);
END
//

DROP PROCEDURE IF EXISTS CreateStockOrder; //
CREATE PROCEDURE CreateStockOrder(order_time DATETIME, OUT SO_ID INTEGER)
MODIFIES SQL DATA
BEGIN
	START TRANSACTION;
	INSERT INTO StockOrder(orderdate) VALUE (order_time);
	SET SO_ID = (SELECT MAX(so.SO_ID) FROM StockOrder AS so);
	COMMIT;
END
//

DROP PROCEDURE IF EXISTS OrderStock; //
CREATE PROCEDURE OrderStock(item_name VARCHAR(64), order_quantity INTEGER, SO_ID INTEGER)
MODIFIES SQL DATA
BEGIN
	INSERT INTO StockItemOrder(SI_ID, SO_ID, qty)
	VALUES ( (SELECT SI_ID FROM StockItem WHERE Name = item_name), SO_ID, order_quantity);
END
//

DROP FUNCTION IF EXISTS GetStockOrderItemQty; //
CREATE FUNCTION GetStockOrderItemQty(item_id INTEGER, order_id INTEGER)
RETURNS INTEGER
READS SQL DATA
	RETURN (SELECT SUM(qty) FROM StockItemOrder WHERE SI_ID = item_id && SO_ID = order_id);
//

DROP PROCEDURE IF EXISTS CommitStockOrder; //
CREATE PROCEDURE CommitStockOrder(order_id INTEGER)
MODIFIES SQL DATA
BEGIN
	UPDATE StockItem SET Quantity = Quantity + GetStockOrderItemQty(SI_ID, order_id)
	WHERE SI_ID IN (SELECT SI_ID FROM StockItemOrder WHERE SO_ID = order_id GROUP BY SI_ID);
END
//

DROP PROCEDURE IF EXISTS CreateSale; //
CREATE PROCEDURE CreateSale(t DATETIME, OUT sale_ID INTEGER)
MODIFIES SQL DATA
BEGIN
	START TRANSACTION;
	INSERT INTO Sale(saletime) VALUE (t);
	SET sale_ID = (SELECT MAX(s.Sale_ID) FROM Sale AS s);
	COMMIT;
END
//

DROP PROCEDURE IF EXISTS SellItem; //
CREATE PROCEDURE SellItem(item_name VARCHAR(64), sale_quantity INTEGER, sale_ID INTEGER)
MODIFIES SQL DATA
BEGIN
	INSERT INTO SaleItem(SI_ID, sale_ID, qty)
	VALUES ( (SELECT SI_ID FROM StockItem WHERE Name = item_name), sale_ID, sale_quantity);
END
//

DROP FUNCTION IF EXISTS GetSaleItemQty; //
CREATE FUNCTION GetSaleItemQty(item_id INTEGER, sale_id INTEGER)
RETURNS INTEGER
READS SQL DATA
	RETURN (SELECT SUM(qty) FROM SaleItem WHERE SI_ID = item_id && Sale_ID = sale_id);
//

DROP PROCEDURE IF EXISTS CommitSale; //
CREATE PROCEDURE CommitSale(sale_id INTEGER)
MODIFIES SQL DATA
BEGIN
	UPDATE StockItem SET Quantity = Quantity - GetSaleItemQty(SI_ID, sale_id)
	WHERE SI_ID IN (SELECT SI_ID FROM SaleItem WHERE Sale_ID = sale_id GROUP BY SI_ID);
END
//
