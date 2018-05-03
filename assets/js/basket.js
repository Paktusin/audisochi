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
        let flyel = $(el).parent();
    }

    save() {
        $.cookie('part', JSON.stringify(this.part), {path: '/'});
        $.cookie('service', JSON.stringify(this.service), {path: '/'});
        $.cookie('orders', JSON.stringify(this.orders), {path: '/'});
        this.updateBadge();
        this.renderContent();
    }

    removePart(id, el) {
        this.orders.splice(this.orders.indexOf(id), 1);
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