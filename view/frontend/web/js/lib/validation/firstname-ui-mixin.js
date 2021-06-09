define([
    'mage/translate'
], function($t) {
    'use strict';

    return function(rules) {
        rules['capitalized'] = {
            handler: function (value) {
                return value.charAt(0) === value.charAt(0).toUpperCase();
            },
            message: $t('Your name must be capitalized.')
        };

        rules['min-length-3'] = {
            handler: function (value) {
                return value.length < 3;
            },
            message: $t('We may need to have a conversion with your parents if your name doesn\'t surpass a character length of 3.')
        }

        return rules;
    };
});
