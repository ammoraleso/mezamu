async function updateStatus(order) {
    console.log("La routa que llamarré : " + updateStatusUrl);
    console.log("El nuevo status de la orden es : " + order.status);
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
    // var input, filter, table, tr, td, i, txtValue;
    // input = document.getElementById("myInput");
    // filter = input.value.toUpperCase();
    // table = document.getElementById("myTable");
    // tr = table.getElementsByTagName("tr");
    // for (i = 0; i < tr.length; i++) {
    //     td = tr[i].getElementsByTagName("td")[0];
    //     if (td) {
    //         txtValue = td.textContent || td.innerText;
    //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //             tr[i].style.display = "";
    //         } else {
    //             tr[i].style.display = "none";
    //         }
    //     }
    // }

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
