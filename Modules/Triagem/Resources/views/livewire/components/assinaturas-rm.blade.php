<div>
    <div id="parent" class="parent p-2">
        <p> assine </p>
        <x-triagem::signature-pad> </x-triagem::signature-pad>
    </div>
    <div class="modal-action">
        <a type="button" class="btn btn-warning" onclick="clearCanvas()">Limpar</a>
        <label for="my-modal-6" id="fechar1" class="btn btn-error">Cancelar</label>
        <label for="my-modal-6" id="clone" class="btn btn-primary">Enviar</label>
    </div>

</div>
<script>
    /*
    var canvas = document.getElementById("sig-canvas");
    var ctx = canvas.getContext("2d");

    // Set up mouse events for drawing
    var drawing = false;
    var mousePos = {
        x: 0,
        y: 0
    };
    var lastPos = mousePos;
    canvas.addEventListener("mousedown", function(e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);
    canvas.addEventListener("mouseup", function(e) {
        drawing = false;
    }, false);
    canvas.addEventListener("mousemove", function(e) {
        mousePos = getMousePos(canvas, e);
    }, false);

    // Get the position of the mouse relative to the canvas
    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        };
    }

    // Get a regular interval for drawing to the screen
    
    window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimaitonFrame ||
            function(callback) {
                window.setTimeout(callback, 1000 / 60);
            };
    })();

    

    // Draw to the canvas
    function renderCanvas() {
        if (drawing) {
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            ctx.strokeStyle = 'blue';
            ctx.lineWidth = 10;
            ctx.lineCap = "round";
            lastPos = mousePos;
        }
    }

    // Allow for animation
    (function drawLoop() {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();

    // Set up touch events for mobile, etc
    canvas.addEventListener("touchstart", function(e) {
        mousePos = getTouchPos(canvas, e);
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousedown", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);
    canvas.addEventListener("touchend", function(e) {
        var mouseEvent = new MouseEvent("mouseup", {});
        canvas.dispatchEvent(mouseEvent);
    }, false);
    canvas.addEventListener("touchmove", function(e) {
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);

    // Get the position of a touch relative to the canvas
    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
        };
    }

    function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    redraw();
  }

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchend", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchmove", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    function clearCanvas() {
        canvas.width = canvas.width;
    }
*/

    $("#clone").click(function() {
        var dataUrl = canvas.toDataURL();
        $("#imgclone").attr("src", dataUrl);

        $("body").toggleClass("overflow-hidden");

        //tira print da div
        html2canvas(document.querySelector("#termo-rm")).then(canvas => {
            //document.body.appendChild(canvas);
            var dataUrl2 = canvas.toDataURL();
            $("#dataurl").val(dataUrl2);
        });

    });

    $("#fechar1").click(function() {
        $("body").toggleClass("overflow-hidden");
    });
</script>
