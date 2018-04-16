# Database

## Procedures

### `AddStockItem(name VARCHAR(64))`
Add a new item with the given `name`.
Item has an initial quantity of 0.

### `CreateStockOrder(order_time DATETIME, OUT SO_ID INTEGER)`
Prepare a new stock order. Multiple items may be ordered at once. A unique identifier for the order is returned in `SO_ID`.

### `OrderStock(name VARCHAR(64), quantity INTEGER, SO_ID INTEGER)`
Add some stock to an order. `SO_ID` should be the value received from `CreateStockOrder`.

### `CommitStockOrder(SO_ID INTEGER)`
Updates the stored quantities of all items in the given stock order. `SO_ID` should be the value received from `CreateStockOrder`.

### `CreateSale(sale_time DATETIME, OUT sale_ID INTEGER)`
Prepare a new sale order. Multiple items may be sold at once. A unique identifier for the sale is returned in `sale_ID`.

### `SellItem(name VARCHAR(64), quantity INTEGER, sale_ID INTEGER)`
Add some stock to a sale. `sale_ID` should be the value received from `CreateSale`.

### `CommitSale(Sale_ID INTEGER)`
Updates the stored quantities of all items in the given sale. `sale_ID` should be the value received from `CreateSale`.
