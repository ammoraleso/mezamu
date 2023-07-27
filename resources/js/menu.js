let dish;

function showDetails(dishToDetail, restaurant) {
    dish = dishToDetail;

    document.getElementById("header-tittle").innerHTML = dish.name;
    document.getElementById("productDescription").innerHTML =
        "<strong>Descripción: </strong>" + dish.description;
    let divImage = document.getElementById("product-image");
    imageUrl =
        "http://127.0.0.1:5173/resources/images/" +
        restaurant.slug +
        "/" +
        dish.photo;
    divImage.innerHTML = "<img src=" + imageUrl + ' width="85%">';

    $("#modalDetails").modal("show");
}

async function changeStatusDish(dishBranchId, dishStatus) {
    try {
        await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: udpateDishStatusUrl,
            method: "POST",
            data: {
                dishStatus,
                dishBranchId
            }
        });
    } catch (error) {
        console.log("Error removeItem " + error);
        return;
    }
    window.location.replace("menuAdmin");
}

function showDetailsDishAdmin(dishToUpdate) {
    dish = dishToUpdate;
    document.getElementById("header-tittle").innerHTML = dishToUpdate.name;

    $("#name").val(dishToUpdate.name);
    $("#description").val(dishToUpdate.description);
    $("#price").val(dishToUpdate.price);
    $("#modalDetailsAdminMenu").modal("show");
}

async function updateDish() {
    try {
        dish.name = $("#name").val();
        dish.description = $("#description").val();
        dish.price = $("#price").val();
        await $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: udpateDishUrl,
            method: "POST",
            data: {
                dish
            }
        });
    } catch (error) {
        console.log("Error udpateDish " + error);
        return;
    }
    window.location.replace("menuAdmin");
}
