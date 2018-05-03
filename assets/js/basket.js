export class Basket {
    constructor(id) {
        this.el = $(id);
        this.orders = [];
        this.car = {};
        this.client = {};
        this.load();
        this.renderContent();
    }

    load() {
        this.car = $.cookie('car') ? JSON.parse($.cookie('car')) : this.car;
        this.client = $.cookie('client') ? JSON.parse($.cookie('client')) : this.client;
        this.orders = $.cookie('orders') ? JSON.parse($.cookie('orders')) : this.orders;
        this._log();
        this.updateBadge();
    }

    updateBadge() {
        this.el.html(((this.orders.length > 0) ? this.orders.length : ''));
    }

    addPart(id, el) {
        this.orders.push(id);
        this.save();
        let flyel = $(el).parent();
    }

    save() {
        $.cookie('car', JSON.stringify(this.car), {path: '/'});
        $.cookie('client', JSON.stringify(this.client), {path: '/'});
        $.cookie('orders', JSON.stringify(this.orders), {path: '/'});
        this.updateBadge();
        this.renderContent();
    }

    removePart(id, el) {
        this.orders.splice(this.orders.indexOf(id), 1);
        this.save();
    }

    _log() {
        console.log(this.car, this.client, this.orders);
    }

    renderContent() {
        let el = $('#orderList');
        if (el.length > 0) {
            $.post('/part/order', {ids: this.orders}).done((data) => {
                el.html(data);
            });
        }
    }
}