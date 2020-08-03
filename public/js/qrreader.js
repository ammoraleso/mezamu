function onScanSuccess(qrMessage) {
    successfullCodeRead(qrMessage);
}

function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 2, qrbox: 250 }, /* verbose= */ true);//2 fps to avoid multiple call onScanSuccess
html5QrcodeScanner.render(onScanSuccess, onScanFailure);
