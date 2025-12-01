/* 
      MOBILE MENU
 */
const mobileToggle = document.getElementById("mobileToggle");
const mainNav = document.getElementById("mainNav");

if (mobileToggle) {
    mobileToggle.addEventListener("click", () => {
        mainNav.classList.toggle("active");
    });
}


/* 
    SECTION PAGE HANDLER
 */
function openSection(sectionId) {
    document.querySelectorAll(".page-section").forEach(sec => sec.style.display = "none");
    document.getElementById(sectionId).style.display = "block";

    window.scrollTo({ top: 0, behavior: "smooth" });
}

/* 
     PRODUCT DETAIL
 */
function showDetail(title, price, desc, image) {
    openSection("productDetailPage");

    document.getElementById("detailTitle").textContent = title;
    document.getElementById("detailPrice").textContent = "Rp " + Number(price).toLocaleString();
    document.getElementById("detailDescription").textContent = desc;
    document.getElementById("detailImage").src = image;
}

/* 
         CART
 */
let cart = [];
const cartBtn = document.getElementById("cartBtn");

document.querySelectorAll(".add-to-cart").forEach(btn => {
    btn.addEventListener("click", () => {
        const item = {
            id: btn.dataset.id,
            name: btn.dataset.name,
            price: Number(btn.dataset.price),
            image: btn.dataset.image,
            qty: 1
        };

        cart.push(item);
        updateCartCount();
    });
});

function updateCartCount() {
    const countSpan = document.querySelector(".cart-count");
    countSpan.textContent = cart.length;
}

/* Export cart for checkout.js */
window.cartData = cart;
