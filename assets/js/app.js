require('./bootstrap');

$(function () {
    $('video').on("timeupdate", (e) => {
        if (e.target.currentTime > 30) {
            e.target.currentTime = 0;
        }
    })
});