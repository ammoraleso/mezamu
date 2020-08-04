async function addItem(dish, branchDish) {
    let itemsCounter;
    try {
        itemsCounter = await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: addItemUrl,
            method: "POST",
            data: {
                itemID: dish.id,
                quantity: document.getElementById("quantity" + dish.id).value,
                branchID: branchDish.branch_id
            }
        });
    } catch (error) {
        console.log("Error adding item " + error);
        return;
    }
    await reloadCartIcon(itemsCounter, true); //always has to reload only the badge
}

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
        reloadSummary();
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

var phone;
var message;
async function checkout(phone, message) {
    //we will send data and recive data fom our AjaxController
    if (typeof $("input[name='toWhere']:checked").val() === "undefined") {
        return;
    }
    this.phone = phone;
    this.message = message;

    const ele = document.getElementsByName("toWhere");
    var selectedPlace = null;
    for (let i = 0; i < ele.length; i++) {
        if (ele[i].checked) {
            selectedPlace = ele[i].value;
            break;
        }
    }
    switch (selectedPlace) {
        case "table":
            $("#modalTableToken").modal("show");
            break;
        case "delivery":
            $("#modalDelivery").modal("show");
            break;
    }
}

async function successfullCodeRead(token) {
    try {
        await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: checkOutUrl,
            data: { token: token },
            type: "post"
        });
    } catch (error) {
        console.log("Error goCheckout put headers" + error);
        alert("Invalid code");
        return;
    }
    document.getElementById("whatsapp-link").click();
    window.location.replace("successfulPurchase");
}
