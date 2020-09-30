let dish;

function showDetails(dishToDetail, restaurant) {
    dish = dishToDetail;

    document.getElementById("header-tittle").innerHTML = dish.name;
    document.getElementById("productDescription").innerHTML =
        "<strong>Descripción: </strong>" + dish.description;
    let divImage = document.getElementById("product-image");
    imageUrl =
        "https://mezamublobstorage.blob.core.windows.net/" +
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
