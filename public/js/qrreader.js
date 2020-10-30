let continueScanning = true;
async function onScanSuccess(qrMessage) {
    if (continueScanning) {
        continueScanning = false;
        try {
            await $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: checkOutUrl,
                data: {
                    token: qrMessage,
                    total: document.getElementById("totalPrice").value,
                    description: document.getElementById("descriptionOrder")
                        .value
                },
                type: "post"
            });
        } catch (error) {
            console.log("Error goCheckout put headers" + error);
            continueScanning = true;
            return;
        }
        window.location.replace("successfulPurchase");
    }
}

function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 2, qrbox: 250 }, /* verbose= */ true);//2 fps to avoid multiple call onScanSuccess
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

const html5QrCode = new Html5Qrcode("#reader");
const qrCodeSuccessCallback = message => {
    /* handle success */
};
const config = { fps: 10, qrbox: 250 };

// If you want to prefer back camera
html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);

