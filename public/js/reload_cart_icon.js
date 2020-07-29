function completeCartFade() {
    $("#cartIconSmall").fadeOut("slow", function() {
        $("#cartIconSmall").load(location.href + " #cartIconSmall>*", function() {
            $("#cartIconSmall").fadeIn("slow");
        });
    });
    $("#cartIconLarge").fadeOut("slow", function() {
        $("#cartIconLarge").load(location.href + " #cartIconLarge>*", function() {
            $("#cartIconLarge").fadeIn("slow");
        });
    });
}

function cartBadgeFade() {
    $("#cartBadgeSmall").fadeOut("slow", function() {
        $("#cartBadgeSmall").load(location.href + " #cartBadgeSmall>*", function() {
            $("#cartBadgeSmall").fadeIn("slow");
        });
    });
    $("#cartBadgeLarge").fadeOut("slow", function() {
        $("#cartBadgeLarge").load(location.href + " #cartBadgeLarge>*", function() {
            $("#cartBadgeLarge").fadeIn("slow");
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
