async function showPayModal(branch) {
    validateFields();

    data.amount =document.getElementById("totalPrice").value;
    data.extra1 = "{!! json_encode($paymentCart)!!}".replace(/"/g, "'");
    data.extra2 = $city;
    data.extra3 = $address;
    data.extra4 = $name;
    data.extra5 = document.getElementById("descriptionOrder").value;
    //Atributos cliente
    data.type_doc_billing = "cc";
    try {
        await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: saveCustomerUrl,
            data: {
                email: $email,
                name: $name,
                address: $address,
                phone: $phone,
            },
            type: "post",
        });
    } catch (error) {
        console.log("Error saving Customer: " + error);
    }

    if (branch.disable_epay === 1) {
        try {
            await $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: checkOutDeliveryURL,
                data: {
                    email: $email,
                    name: $name,
                    address: $address,
                    phone: $phone,
                    description: document.getElementById("descriptionOrder")
                        .value,
                    total: document.getElementById("totalPrice").value,
                },
                type: "post",
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
    //$city = $('#city').val();
    $city = 1;
    $address = $("#address").val();
    $phone = $("#phone").val();
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
