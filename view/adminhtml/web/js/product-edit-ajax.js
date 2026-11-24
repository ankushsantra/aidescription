/**
 * Copyright © 2026 Ankush.
 */
require(['jquery', 'mage/url'], function ($
	, urlBuilder) {
    'use strict';
    $(document).ready(function () {
        container.addEventListener('click', (event) => {
            const item = event.target.closest('[data-index]');
            if (!item) return;
            const index = item.dataset.index;
            if ( index == 'create_ai_description_button' ){
                var ajaxUrl = aiControllerUrl+'?isAjax=true';
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        form_key: FORM_KEY,
                        product_id: productId
                    },
                    showLoader: true,
                    success: function (response) {
                        if (response.success) {
                            let textarea = $('textarea[name="product[ai_description]"]');
                            textarea.val(response.message)
                                .css('height', 'auto')
                                .css('height', textarea[0].scrollHeight + 'px')
                                .trigger('change');
                            console.log('AI controller called successfully');
                        }
                    }
                });
            } 
        });
    });
});
