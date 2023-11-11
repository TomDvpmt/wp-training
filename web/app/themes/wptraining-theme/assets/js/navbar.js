class NavBar {
    static switchImage() {
        const templateUrl = navbar_script.templateUrl;
        const defaultImgSrc =
            templateUrl + "/assets/images/default-products-category.jpg";
        const menu = document.querySelector(".product-categories-menu");
        const menuLinks = Array.from(
            menu.querySelectorAll(".nav-link--product")
        );
        const menuImg = menu.querySelector(".product-categories-menu__image");

        menu.addEventListener("mouseover", (e) => {
            if (menuLinks.includes(e.target)) {
                menuImg.src = e.target.dataset.image
                    ? e.target.dataset.image
                    : defaultImgSrc;
                console.log(menuImg.src);
            }
        });
    }
}

NavBar.switchImage();
