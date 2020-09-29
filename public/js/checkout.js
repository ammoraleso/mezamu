async function showPayModal(branch) {
    validateFields();
    data.amount = document.getElementById("totalPrice").value;
    data.extra1 = "{!! json_encode($paymentCart)!!}".replace(/"/g, "'");
    data.extra2 = $city;
    data.extra3 = $address;
    data.extra4 = $name;
    data.extra5 = document.getElementById("descriptionOrder").value;
    //Atributos cliente
    data.type_doc_billing = "cc";

    const ele = document.getElementsByName("toWhere");
    var selectedPlace = null;
    for (let i = 0; i < ele.length; i++) {
        if (ele[i].checked) {
            selectedPlace = ele[i].value;
            break;
        }
    }

    if (distance > branch.coverage && selectedPlace === "delivery") {
        alert("Tu ubicación está fuera del rango del restaurante");
        return;
    }

    try {
        await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: saveCustomerUrl,
            data: {
                email: $email,
                name: $name,
                address: $address,
                aditional_address: $aditional_address,
                phone: $phone
            },
            type: "post"
        });
    } catch (error) {
        console.log("Error saving Customer: " + error);
    }

    $("#modalDelivery").modal("hide");
    if (selectedPlace === "table") {
        $("#modalTableToken").modal("show");
        return;
    }

    if (branch.disable_epay === 1) {
        try {
            await $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: checkOutDeliveryURL,
                data: {
                    email: $email,
                    name: $name,
                    address: $address,
                    aditional_address: $aditional_address,
                    phone: $phone,
                    description: document.getElementById("descriptionOrder")
                        .value,
                    total: document.getElementById("totalPrice").value,
                    disable_epay: branch.disable_epay
                },
                type: "post"
            });
            window.location.replace("successfulPurchase");
        } catch (error) {
            console.log("Error Creating Notification Customer: " + error);
            return;
        }
        return;
    }

    handler.open(data);
}

async function validateFields() {
    $name = $("#name").val();
    $city = 1;
    $address = $("#address").val();
    $phone = $("#phone").val();
    $aditional_address = $("#aditional_address").val();
    if (!$name) {
        $("#name").focus();
        $("#name").addClass("is-invalid");
        return;
    } else {
        $("#name").removeClass("is-invalid");
    }

    if (!$city) {
        $("#city").focus();
        $("#city").addClass("is-invalid");
        return;
    } else {
        $("#city").removeClass("is-invalid");
    }
    if (!$address) {
        $("#address").focus();
        $("#address").addClass("is-invalid");
        return;
    } else {
        $("#address").removeClass("is-invalid");
    }
    if (!$phone) {
        $("#phone").focus();
        $("#phone").addClass("is-invalid");
        return;
    } else {
        $("#phone").removeClass("is-invalid");
    }
}
