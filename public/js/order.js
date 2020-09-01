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
