'use strict';

require('ckeditor');

$(() => {
    $('.cke-editor').each((key, el) => {
        CKEDITOR.replace($(el).attr('id'), {
            toolbar: [
                {name: 'document', items: ['Source']},
                {name: 'clipboard', items: ['Undo', 'Redo']},
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl',]
                },
                {name: 'links', items: ['Link', 'Unlink']},
                {name: 'insert', items: ['Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']},
                '/',
                {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['ShowBlocks']}
            ]
        })
    })
});