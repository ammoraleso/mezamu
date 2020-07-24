async function addItem(dish) {
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
                quantity: document.getElementById("quantity" + dish.id).value
            }
        });
    } catch (error) {
        console.log("Error adding item " + error);
        return;
    }
    reloadCartIcon(itemsCounter, true); //always has to reload only the badge
}
