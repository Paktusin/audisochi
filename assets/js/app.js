import {Basket} from "./basket";

require('./bootstrap');


$(function () {
    let basket = new Basket('#basket');

    $.mask.definitions['h'] = "[А-Яа-я]";

    $('video').on("timeupdate", (e) => {
        if (e.target.currentTime > 30) {
            e.target.currentTime = 0;
        }
    });

    $('.phone').mask('+7(999)-999-9999');
    $('.reg_number').mask('h999hh 99?9');

    window.addToBasket = (id, el) => {
        basket.addPart(id, el)
    }

    window.removePart = (id,el) => {
        basket.removePart(id,el)
    }
});