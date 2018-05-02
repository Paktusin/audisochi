require('./bootstrap');


$(function () {
    $.mask.definitions['h'] = "[А-Яа-я]";

    $('video').on("timeupdate", (e) => {
        if (e.target.currentTime > 30) {
            e.target.currentTime = 0;
        }
    });

    $('.phone').mask('+7(999)-999-9999');
    $('.reg_number').mask('h999hh 99?9');
});