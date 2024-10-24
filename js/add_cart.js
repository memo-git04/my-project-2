var removeCartItemButtons = document.getElementsByClassName("btn-danger");
console.log(removeCartItemButtons);

for (var i = 0; i < removeCartItemButtons.length; i++) {
  var button = removeCartItemButtons[i];
  button.addEventListener("click", function (event) {
    // console.log("clicked");
    var buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove();
    updateCartTotal();
  });
}

function updateCartTotal() {
  var cartItemContainer = document.getElementsByClassName("card-body")[0];
  var cartRows = cartItemContainer.getElementsByClassName("table");
  var total = 0;
  for (var i = 0; i < cartRows.length; i++) {
    var cartRows = cartRows[i];
    var priceElement = cartRows.getElementsByClassName("price")[0];
    var quantityElement = cartRows.getElementsByClassName("quantity_input")[0];
    // console.log(priceElement, quantityElement);
    var price = parseFloat(priceElement.innerText.replace("$", ""));
    var quantity = quantityElement.value;
    // console.log(price);
    // console.log(price * quantity);
    total = total + price * quantity;
  }
  document.getElementsByClassName("total_price")[0].innerText = "$" + total;
}

function addToCartClicked(event) {
  var button = event.target;
  var shop;
}
