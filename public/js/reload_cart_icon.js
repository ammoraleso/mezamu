async function completeCartFade() {
    await $("#cartIconSmall").hide();
    await $("#cartIconSmall").load(location.href + " #cartIconSmall>*");
    await $("#cartIconSmall").show();

    await $("#cartIconLarge").hide();
    await $("#cartIconLarge").load(location.href + " #cartIconLarge>*");
    await $("#cartIconLarge").show();
}

async function cartBadgeFade() {
    await $("#cartBadgeSmall").hide();
    await $("#cartBadgeSmall").load(location.href + " #cartBadgeSmall>*");
    await $("#cartBadgeSmall").show();

    await $("#cartBadgeLarge").hide();
    await $("#cartBadgeLarge").load(location.href + " #cartBadgeLarge>*");
    await $("#cartBadgeLarge").show();
}

function reloadCartIcon(quantity, addOrRemove) {
    //true: request comes from add item; false: request comes from remove item
    if (addOrRemove) {
        if (quantity >= 1) {
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
