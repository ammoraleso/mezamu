let email;
let message;

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
    showFlashMessage();
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
    $("#radioInSitu").prop("checked", false);
    $("#radioDelivery").prop("checked", false);
}

async function checkout() {
    //we will send data and get data fom our AjaxController
    if (typeof $("input[name='toWhere']:checked").val() === "undefined") {
        return;
    }

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

async function loadPerfil() {
    $email = $("#email").val();
    let customer;
    $("#email").removeClass("is-invalid");
    if (!$email) {
        $("#email").focus();
        $("#email").addClass("is-invalid");
        return;
    }
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test($email)) {
        alert("Por favor ingresa un email válido.");
        return;
    }

    try {
        customer = await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: findEmailUrl,
            data: { email: $email },
            type: "post"
        });
    } catch (error) {
        return console.log("LoadPerfil error: " + error);
    }
    if (customer) {
        $("#name").val(customer.nombre);
        $("#address").val(customer.direccion);
        $("#phone").val(customer.telefono);
    } else {
        $("#name").val("");
        $("#address").val("");
        $("#phone").val("");
    }
    $("#perfil-form").removeAttr("style");
    $("perfil-form").show();
}

function collapseTab(id_target = "Prod") {
    const target = "#collapse" + id_target;
    if ($(target).attr("class") === "collapse") {
        $(target).attr("class", "collapse show");
        return;
    }
    if ($(target).attr("class") === "collapse show") {
        $(target).attr("class", "collapse");
        return;
    }
}

async function updateDelivery(showDelivery, delivery) {
    totalPrice = parseInt($("#totalPriceBase").val());
    console.log(totalPrice);
    let totalPriceDelivery = 0;
    if (showDelivery) {
        totalPriceDelivery = delivery + totalPrice;
        $("#rowDelivery").removeAttr("style");
    } else {
        totalPriceDelivery = totalPrice;
        $("#rowDelivery").attr("style", "display: none");
    }
    //To save
    $("#totalPrice").val(totalPriceDelivery);
    //To Show in the screen we need to format the number.
    totalPriceDelivery =
        "$ " + (totalPriceDelivery / 1000).toFixed(3).replace(".", ",");
    $("#totalPriceTable").val(totalPriceDelivery);
    await $("#totalPriceTable")
        .html("<strong>" + $("#totalPriceTable").val() + "</strong>")
        .fadeIn("slow");
    await $("#totalPriceTable").fadeIn("slow");
}

function showFlashMessage() {
    $("#success_message")
        .fadeIn()
        .html("Producto(s) agregado(s)");
    setTimeout(function() {
        $("#success_message").fadeOut("slow");
    }, 2000);
}
