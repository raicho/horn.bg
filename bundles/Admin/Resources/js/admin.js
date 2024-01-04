import './bootstrap';

import * as bootstrap from 'bootstrap';
import $ from 'jquery';

import Modal from 'bootstrap/js/dist/modal';
window.$ = $;


// jquery ready //
$(function() {
    // checkbox modals //
    $('.alert-action').click(function() {
        new bootstrap.Modal($('#actionModal')).show();
        $('#saveModalSubmit').attr('data-form', $(this).attr('data-form'));
    });


    $('#saveModalSubmit').click(function() {
        $("#"+$(this).attr('data-form')).submit();
    });


    $("#mobile-menu").click(function() {
        $("#admin-left-bar").toggleClass('d-none');
    })
});
// end jquery //
