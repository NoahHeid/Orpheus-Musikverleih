var img = new Image();
img.src = 'img/roomtour.png';
var canvasResp = document.getElementById('canvas-resp');
var speed = 50; //Je niedriger, desto schneller!
var scale = canvasResp.height/616;
var y = -4.5;

// Hauptprogramm
var CanvasXSize = canvasResp.width;
var CanvasYSize = canvasResp.height;
var dx = 0.5;
var imgW;
var imgH;
var x = 0;
var clearX;
var clearY;
var ctx;

img.onload = function() {
    imgW = img.width * scale;
    imgH = img.height * scale;

    if (imgW > CanvasXSize) {
        x = CanvasXSize - imgW;
    }
    if (imgW > CanvasXSize) {
        clearX = imgW;
    } else {
        clearX = CanvasXSize;
    }
    if (imgH > CanvasYSize) {
        clearY = imgH;
    } else {
        clearY = CanvasYSize;
    }

    ctx = document.getElementById('canvas-resp').getContext('2d');

    return setInterval(draw, speed);
}

function draw() {
    ctx.clearRect(0, 0, clearX, clearY);
    if (imgW <= CanvasXSize) {
        if (x > CanvasXSize) {
            x = -imgW + x;
        }
        if (x > 0) {
            ctx.drawImage(img, -imgW + x, y, imgW, imgH);
        }
        if (x - imgW > 0) {
            ctx.drawImage(img, -imgW * 2 + x, y, imgW, imgH);
        }
    }
    else {
        if (x > (CanvasXSize)) {
            x = CanvasXSize - imgW;
        }
        if (x > (CanvasXSize-imgW)) {
            ctx.drawImage(img, x - imgW + 1, y, imgW, imgH);
        }
    }
    ctx.drawImage(img, x, y,imgW, imgH);
    x += dx;
}