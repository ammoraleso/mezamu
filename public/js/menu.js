let dish;

function showDetails(dishToDetail) {
    dish = dishToDetail;

    document.getElementById("header-tittle").innerHTML = dish.name;
    document.getElementById("productDescription").innerHTML =
        "<strong>Descripción: </strong>" + dish.description;
    let = divImage = document.getElementById("product-image");
    imageUrl =
        "https://mezamublobstorage.blob.core.windows.net/images/" + dish.photo;
    divImage.innerHTML = "<img src=" + imageUrl + ' width="85%">';

    $("#modalDetails").modal("show");
}
