define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal'
], function (_, uiRegistry, select, modal) {
    'use strict';

    return select.extend({

        /**
         * On value change handler.
         *
         * @param {String} value
         */
        onUpdate: function (value) {
            console.log('Selected Value: ' + value);

            var field1 = uiRegistry.get('index = name');
            if (field1.visibleValue !== value) {
                field1.show();
            } else {
                field1.hide();
            }

            var field2 = uiRegistry.get('index = address');
            if (field2.visibleValue !== value) {
                field2.show();
            } else {
                field2.hide();
            }

            var field3 = uiRegistry.get('index = contact_phone');
            if (field3.visibleValue !== value) {
                field3.show();
            } else {
                field3.hide();
            }

            var field4 = uiRegistry.get('index = contact_name');
            if (field4.visibleValue !== value) {
                field4.show();
            } else {
                field4.hide();
            }

            return this._super();
        },
    });
});