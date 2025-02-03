const cartIcon = document.querySelector(".cart-icon");
const cartContainer = document.querySelector(".cart-container");

cartIcon.addEventListener("click", () => {
    cartContainer.classList.toggle("active");
});
