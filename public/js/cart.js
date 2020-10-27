let email;
let message;

//""
//"success_message"
const success_flash_el = "success_message";
const error_flash_el = "error_message";
const add_item_message = "Producto(s) agregado(s)";
const delete_item_message = "Producto(s) eliminado(s)";
const prodcut_updated = "Producto actualizado";

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
    showFlashMessage(success_flash_el, add_item_message);
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
    showFlashMessage(success_flash_el, prodcut_updated);
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
    showFlashMessage(error_flash_el, delete_item_message);
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
            $("#modalDelivery").modal("show");
            break;
        case "delivery":
            $("#modalDelivery").modal("show");
            break;
    }
}

async function loadPerfil(latitude, longitude) {
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
        codeAddress(customer.direccion, latitude, longitude);
        $("#phone").val(customer.telefono);
        $("#aditional_address").val(customer.direccion_adicional);
    } else {
        $("#name").val("");
        $("#address").val("");
        $("#phone").val("");
        $("#aditional_address").val("");
    }
    $("#perfil-form").removeAttr("style");
    $("perfil-form").show();
}

function codeAddress(address, latitude, longitude) {
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: address }, function(results, status) {
        if (status == "OK") {
            distance = google.maps.geometry.spherical.computeDistanceBetween(
                results[0].geometry.location,
                new google.maps.LatLng(latitude, longitude)
            );
        } else {
            console.log(
                "Geocode was not successful for the following reason: " + status
            );
        }
    });
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

function showFlashMessage(element, message) {
    element = "#" + element;
    $(element)
        .fadeIn()
        .html(message);
    setTimeout(function() {
        $(element).fadeOut("slow");
    }, 2000);
}

function showModalTerms() {
    $("#modalTerms").modal("show");
}
