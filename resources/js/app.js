import './bootstrap';

import * as bootstrap from 'bootstrap';
import $ from 'jquery';

import Modal from 'bootstrap/js/dist/modal';
window.$ = $;



// jquery ready //
$(function() {

    // checkbox modals //
    $('.checkbox-modal').click(function() {
        let elModal = document.getElementById($(this).attr('data-target'));
        if($(this).attr('data-checked') == 0) {
           $(this).attr('data-checked', 1);
           new bootstrap.Modal(elModal).show();
        } else {
           $(this).attr('data-checked', 0);
        }

    });
});
// end jquery //
