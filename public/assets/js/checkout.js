let product = [];
function renderCheckoutItems() {
    const cart = window.cartData || [];
    const wrap = document.getElementById("checkoutItems");
    let total = 0;

    wrap.innerHTML = "";

    cart.forEach(item => {
        total += item.price * item.qty;
        
        wrap.innerHTML += `
            <div class="checkout-item">
                <img src="${item.image}">
                <div class="checkout-item-info">
                    <h4>${item.name}</h4>
                    <p>Harga: Rp ${item.price.toLocaleString()}</p>
                    <p>Qty: ${item.qty}</p>
                </div>
            </div>
        `;
        product.push(item)
    });
    
    document.getElementById("checkoutSummaryPrice").value = "Rp " + total.toLocaleString();
    document.getElementById("item").value = JSON.stringify(product);
    // console.log(product)

    return total, product;
}

/* Render*/
if (document.getElementById("checkoutItems")) {
    renderCheckoutItems();
}

/*CONFIRM*/
const confirmBtn = document.getElementById("confirmCheckout");

if (confirmBtn) {
    confirmBtn.addEventListener("click", () => {
        const name = document.getElementById("checkoutName").value.trim();
        const address = document.getElementById("checkoutAddress").value.trim();

        // if (!name || !address) {
        //     alert("Nama dan alamat wajib diisi.");
        //     return;
        // }

        alert("Checkout berhasil (frontend). Backend Laravel akan memproses transaksi.");

        window.location.href = "/";
    });
}
