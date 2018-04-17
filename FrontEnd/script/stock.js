
"use strict";

function saveStockName() {
	var result = true;

	var stockQuantError = document.getElementById("stockQuantityError");
	var stockName = document.getElementById("stockItemName").value;

	if (stockName == "") {
		stockQuantError.innerHTML = "The stock item name cannot be empty.";
		result = false;
	} else if (!stockName.match(/^[a-zA-z -]+$/)) {
		stockQuantError.innerHTML = "The stock item name must only contain alphabetical characters, hyphens or spaces.";
		result = false;
	} else {
		stockQuantError.innerHTML = "";
	}

	if (result) {
		window.location = "stock.php?SearchName=" + stockName;
	}
}

function init() {
	
	var stockForm = document.getElementById("stockForm");
	if (stockForm != null) {
		//Calls cancelBooking when the cancel button is clicked
		var getStockQuantity = document.getElementById("getStockQuantity");
		getStockQuantity.onclick = saveStockName;
	}
}

//Checks when the window loads and runs init when it does
window.addEventListener('load', init);