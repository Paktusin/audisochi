require('./bootstrap');

$(function () {
    $('video').on("timeupdate", (e) => {
        if (e.target.currentTime > 30) {
            e.target.currentTime = 0;
        }
    })

    $('.phone').mask('+7(999)-999-9999');
});