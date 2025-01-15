var video = document.getElementById('video');
var barraTiempo = document.getElementById('barraTiempo');
var tiempo = document.getElementById('tiempo');
var btnPlay = document.getElementById('btnPlay');
var reproducir = document.getElementById('reproducir');
var parar = document.getElementById('parar');
var restart = document.getElementById('restart');
var volume = document.getElementById('volumen');
var mute = document.getElementById('mute');
var btnMute = document.getElementById('btnMute');

var atras = document.getElementById('atras');
var adelante = document.getElementById('adelante');

var lento = document.getElementById('lento');
var rapido = document.getElementById('rapido');

 
var fullscreen = document.getElementById('fullscreen');
var isPaused = true;


function calcularTiempo(time) {
    var segundos = time;
    var minutos = Math.floor(segundos / 60);
    segundos -= minutos * 60;

    segundos = Math.round(segundos);
    segundos = segundos < 10 ? "0" + segundos : segundos;

    return minutos + ":" + segundos;
}

function reproducirPausar() {
    if (video.currentTime === video.duration)
        video.currentTime = 0;

    tiempo.innerHTML = "0:00/" + calcularTiempo(video.duration);
    if (isPaused) {
        video.play();
        btnPlay.classList.remove("fa-play");
        btnPlay.classList.add("fa-pause");
    } else {
        video.pause();
        btnPlay.classList.remove("fa-pause");
        btnPlay.classList.add("fa-play");
    }

    isPaused = !isPaused;
}

video.ontimeupdate = function (ev) {
    if (video.currentTime === video.duration) {
        btnPlay.classList.remove("fa-pause");
        btnPlay.classList.add("fa-play");
        isPaused = true;
    } else {
        //console.log(video.currentTime);
        tiempo.innerHTML = calcularTiempo(video.currentTime) + "/" + calcularTiempo(video.duration - video.currentTime);
        barraTiempo.value = video.currentTime / video.duration * 100;
    }
};

video.onclick = function (ev) {
    reproducirPausar();
};

barraTiempo.onchange = function (ev) {
    video.currentTime = barraTiempo.value * video.duration / 100;
};

reproducir.onclick = function (ev) {
    reproducirPausar();
};

parar.onclick = function (ev) {
    video.pause();
    video.currentTime = 0;
    btnPlay.classList.remove("fa-pause");
    btnPlay.classList.add("fa-play");
    isPaused = true;
};

restart.onclick = function (ev) {
    video.currentTime = 0;
    video.play();
    btnPlay.classList.remove("fa-play");
    btnPlay.classList.add("fa-pause");
    isPaused = false;
};

volume.onchange = function (ev) {
    video.volume = volume.value;
};

mute.onclick = function (ev) {
    if (video.muted) {
        video.muted = false;
        btnMute.classList.remove("fa-volume-off");
        btnMute.classList.add("fa-deaf");
    } else {
        video.muted = true;
        btnMute.classList.remove("fa-deaf");
        btnMute.classList.add("fa-volume-off");
    }
};

atras.onclick = function (ev) {
    video.currentTime -= 5;
};

adelante.onclick = function (ev) {
    video.currentTime += 5;
};

lento.onclick = function (ev) {
    if (video.playbackRate > 0.5)
        video.playbackRate -= 0.1;
};

rapido.onclick = function (ev) {
    if (video.playbackRate < 2)
        video.playbackRate += 0.1;
};

fullscreen.onclick = function (ev) {
    if (video.requestFullscreen) {
        video.requestFullscreen();
    } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen();
    } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen();
    }
};