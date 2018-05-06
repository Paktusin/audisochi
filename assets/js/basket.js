export class Basket {
    constructor(id) {
        this.el = $(id);
        this.orders = [];
        this.part = {};
        this.service = {};
        this.load();
        this.renderContent();
    }

    load() {
        this.service = $.cookie('service') ? JSON.parse($.cookie('service')) : this.service;
        this.part = $.cookie('part') ? JSON.parse($.cookie('part')) : this.part;
        this.orders = $.cookie('orders') ? JSON.parse($.cookie('orders')) : this.orders;
        this.updateBadge();
    }

    updateBadge() {
        this.el.html(((this.orders.length > 0) ? this.orders.length : ''));
    }

    addPart(id, el) {
        this.orders.push(id);
        this.save();
        if (el) {
            let modal = $('#modal');
            modal.modal('show');
            modal.find('.modal-body').html($(el).parent().find('.part-name').text() + ' добавлена в корзину');
        }
        /*if (el) {
            let card = $(el).parent().find('.a-card');
            let flyel = card.clone();
            console.log(card.innerWidth(), card.innerHeight());
            flyel.css({
                position: 'absolute',
                height: card.innerHeight(),
                width: card.innerWidth(),
                top: card.offset().top,
                left: card.offset().left,
                padding: 0,
                transformOrigin: 'top left'
            });
            $('body').append(flyel);
            flyel.animate({
                scale: 0,
                top: this.el.offset().top,
                left: this.el.offset().left,
                opacity: .5
            }, 500, 'swing', () => {
                flyel.remove();
            });
        }*/
    }

    save() {
        $.cookie('part', JSON.stringify(this.part), {path: '/'});
        $.cookie('service', JSON.stringify(this.service), {path: '/'});
        $.cookie('orders', JSON.stringify(this.orders), {path: '/'});
        this.updateBadge();
        this.renderContent();
    }

    removePart(id) {
        this.orders.splice(this.orders.indexOf(id), 1);
        this.save();
    }

    clearAll() {
        this.orders = [];
        this.save();
    }

    clearPart(id) {
        this.orders = this.orders.filter(el => el !== id);
        this.save();
    }

    renderContent() {
        let el = $('#orderList');
        if (el.length > 0) {
            $.post('/part/order', {ids: this.orders}).done((data) => {
                el.html(data);
            });
        }
    }

    updatePart(part) {
        this.part = part;
        this.save();
    }

    updateService(service) {
        this.service = service;
        this.save();
    }

    getPart() {
        return this.part
    }

    getService() {
        return this.service
    }
}