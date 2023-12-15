const parser = new DOMParser();

function decodeString(inputStr) {
return parser.parseFromString(`
<!doctype html>

<body>${inputStr}`, 'text/html').body.textContent
    }

    var cart = {};
    $(document).on('click', '.pos-product-card', function() {
    var product = JSON.parse(decodeString($(this).data('info')));
    var price = product.sellingPrice;
    var id = product.id;

    if (cart.hasOwnProperty(id)) {
    cart[id].quantity++;
    cart[id].subtotal = price * cart[id].quantity;
    } else {
    cart[id] = {
    name: product.name,
    image: product.image,
    price: price,
    quantity: 1,
    subtotal: price
    };
    }
    // Update cart table
    updateCartTable();
    //let do the AJAX here
    // Make a POST request using fetch
    // $.ajax({
    //     type: "POST",
    //     url: '/sales',
    //     data: cart,
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     success: function() {
    //       console.log("Value added " + cart);
    //     }
    // });


    });

    $(document).on('keyup', '#discount', function() {
    updateCartTable();
    });

    function removeCartItem(id) {
    delete cart[id];
    updateCartTable();
    }

    function cleartCart() {
    if (confirm('Are you sure to clear cart?')) {
    cart = {};
    $('#discount').val(0)
    updateCartTable();
    }
    }

    function getItemImg(imgString) {

    if (imgString == null) {
    return "img/defaultImages/product_image.jpg";
    } else {
    return "storage/"+imgString;
    }

    }
    // Function to update the cart table
    function updateCartTable() {
    var $cartTable = $('#product-cart'),
    $cartTotal = $('#subtotal-products'),
    $totalText = $('#total-bill');

    var cartTotal = 0,
    discount = $('#discount').val();

    // Empty cart table
    $cartTable.empty();

    // Loop through cart items and add them to cart table
    for (var id in cart) {
    if (cart.hasOwnProperty(id)) {
    var item = cart[id];
    var $tr = `<div class="d-flex justify-content-between position-relative">
        <i class="text-red ik ik-x-circle cart-remove cursor-pointer" onclick="removeCartItem(${id})"></i> 
        <div class="cart-image-holder">
            <img src="${getItemImg(item.image)}">
        </div>
        <div class="w-100 p-2">
            <h5 class="mb-2 cart-item-title">${item.name}</h5>
            <div class="d-flex justify-content-between">
                <span class="text-muted">${item.quantity}x</span>
                <span class="text-success font-weight-bold cart-item-price">${item.subtotal.toFixed(2)}</span>
            </div>
        </div>
    </div>`;
    $cartTable.append($tr);
    cartTotal += item.subtotal;
    }
    }

    // Update cart total
    $cartTotal.text(cartTotal.toFixed(2));
    $totalText.text((cartTotal - discount).toFixed(2));
    }
