function addItem(dish) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: addItemUrl,
        method: "POST",
        data: {
            itemID: dish.id,
            quantity: document.getElementById("quantity" + dish.id).value
        },
        success: function() {
            reloadCartIcon(1, false); //always has to reload only the badge
        }
    });
}
