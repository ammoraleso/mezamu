const TIME_FADE = "50";

async function changeQuantity(item, quantity) {
    try {
        await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: changeQuantityUrl,
            method: "POST",
            data: { itemID: item["id"], quantity: quantity }
        });
    } catch (error) {
        console.log("Error changeQuantity " + error);
        return;
    }
    reloadSummary();
    reloadCartIcon(1, false);
}

async function removeItem(item) {
    let totalCartQuantity;
    try {
        totalCartQuantity = await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: removeItemUrl,
            method: "POST",
            data: { itemID: item["id"] }
        });
    } catch (error) {
        console.log("Error removeItem " + error);
        return;
    }
    if (totalCartQuantity == 0) {
        await $("#cartContainer").fadeOut("slow");
        await $("#cartContainer").load(location.href + " #cartContainer>*");
        await $("#cartContainer").fadeIn("slow");
    } else {
        await $("#cartItem" + item["id"]).fadeOut();
        await reloadSummary();
    }
    reloadCartIcon(totalCartQuantity, false);
}

function reloadSummary() {
    $("#summary").fadeOut("slow", function() {
        $("#summary").load(location.href + " #summary>*", function() {
            $("#summary").fadeIn("slow");
        });
    });
}
