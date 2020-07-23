function completeCartFade() {
    $("#cartIcon").fadeOut("slow", function() {
        $("#cartIcon").load(location.href + " #cartIcon>*", function() {
            $("#cartIcon").fadeIn("slow");
        });
    });
}

function cartBadgeFade() {
    $("#cartBadge").fadeOut("slow", function() {
        $("#cartBadge").load(location.href + " #cartBadge>*", function() {
            $("#cartBadge").fadeIn("slow");
        });
    });
}

function reloadCartIcon(quantity, addOrRemove) {
    //true: request comes from add item; false: request comes from remove item
    if (addOrRemove) {
        if (quantity == 1) {
            completeCartFade();
        } else {
            cartBadgeFade();
        }
    } else {
        if (quantity == 0) {
            completeCartFade();
        } else {
            cartBadgeFade();
        }
    }
}
