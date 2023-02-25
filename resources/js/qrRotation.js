var angle = 0
let timer = null
function check_getqueue() {
    if(!(document.hidden || document.msHidden || document.webkitHidden || document.mozHidden)) {
        document.getElementById('flip-card-inner').style.transform = 'rotateY(' + angle + 'deg)';
        angle += 180;
    }
    $.ajax({
        // ...
        complete: function() {
            timer = setTimeout(check_getqueue, 4000);
        }
    });
}
timer = setTimeout(check_getqueue, 4000);
