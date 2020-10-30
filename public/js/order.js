async function updateStatus(order) {
    try {
        itemsCounter = await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: updateStatusUrl,
            method: "POST",
            data: {
                order: order
            }
        });
    } catch (error) {
        alert("Error updating  order " + error.message);
        return;
    }
}

async function updateDelivery(orderDish) {
    try {
        itemsCounter = await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: updateDeliveredUrl,
            method: "POST",
            data: {
                orderDish
            }
        });
    } catch (error) {
        alert("Error updating  order " + error.message);
        return;
    }
}

async function loadOrders() {
    $date = $("#dateInput").val();
    $("#dateInput").removeClass("is-invalid");
    if (!$date) {
        $("#dateInput").focus();
        $("#dateInput").addClass("is-invalid");
        showFlashMessage(error_flash_el, "Por favor ingrese una fecha");
        return false;
    }
    return true;
}

function myFunction() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    th = table.getElementsByTagName("th");

    // Loop through all table rows, and hide those who don't match the        search query
    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        for (var j = 0; j < th.length; j++) {
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                if (
                    td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) >
                    -1
                ) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}

function showDetails(customerToDetail) {
    document.getElementById("header-tittle").innerHTML =
        customerToDetail.nombre;

    document.getElementById("email").innerHTML =
        "<strong>Email: </strong>" + customerToDetail.email;

    document.getElementById("phone").innerHTML =
        "<strong>Telefono: </strong>" + customerToDetail.telefono;

    document.getElementById("address").innerHTML =
        "<strong>Dirección: </strong>" + customerToDetail.direccion;
    if (customerToDetail.direccion_adicional) {
        document.getElementById("address_add").innerHTML =
            "<strong>Adicion Dirección: </strong>" +
            customerToDetail.direccion_adicional;
    } else {
        document.getElementById("address_add").innerHTML = "";
    }
    $("#modalDetailsCustomer").modal("show");
}
