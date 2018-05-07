'use strict';

$(() => {
    $('[data-admin]').each((key, el) => {
        let name = $(el).data('admin');
        let id = $(el).data('admin-id');
        let template = $('#q-admin-template').clone().attr('id', '');
        template.removeClass('template');
        template.css({top: 0, right: 0});
        template.find('.edit').attr('href', `/admin/app/${name}/${id}/edit`);
        template.find('.remove').attr('href', `/admin/app/${name}/${id}/delete`);
        $(el).append(template);
    })
});