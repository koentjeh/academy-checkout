define([
    'jquery',
], function($) {
    'use strict';

    return function() {

        $.validator.addMethod('capitalized',
            function(value, element) {
                return value.charAt(0) === value.charAt(0).toUpperCase();
            },
            $.mage.__('Your name must be capitalized.')
        );

        $.validator.addMethod('min-length-3',
            function(value, element) {
                return value.length < 3;
            },
            $.mage.__('We may need to have a conversion with your parents if your name doesn\'t surpass a character length of 3.')
        );
    }
});
