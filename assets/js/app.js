'use strict';

import {Basket} from "./basket";

require('./bootstrap');

let FormToObject = (form) => {
    let res = {};
    $(form).serializeArray().forEach((e) => {
        if (e.name.indexOf('_token') === -1)
            res[e.name] = e.value;
    });
    return res;
};

let ObjectToForm = (object, form) => {
    Object.keys(object).forEach((key) => {
        $(form).find(`[name="${key}"]`).val(object[key]);
    });
};

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
    };

    window.removePart = (id, el) => {
        basket.removePart(id, el)
    };

    $('form[name="ticket_part"],form[name="ticket_service"]').each((key, el) => {
        if (el.name.indexOf('part') !== -1)ObjectToForm(basket.getPart(), el);
        if (el.name.indexOf('service') !== -1){
            ObjectToForm(basket.getService(), el);
        }
        $(el).submit((event) => {
            if (el.name.indexOf('part') !== -1) basket.updatePart(FormToObject(event.target));
            if (el.name.indexOf('service') !== -1) basket.updateService(FormToObject(event.target));
        })
    })
});