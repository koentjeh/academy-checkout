define([
    'ko',
    'uiComponent',
    'underscore',
    'Magento_Checkout/js/model/step-navigator'
], function (ko, Component, _, stepNavigator) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Academy_Checkout/step/custom-step.html'
        },
        isVisible: ko.observable(true),
        initialize: function () {
            this._super();

            stepNavigator.registerStep(
                'custom_step',
                null,
                'Custom Step',
                this.isVisible,
                _.bind(this.navigate, this),
                15
            );

            return this;
        },
        navigate: function () {
            this.isVisible(true);
        },
        navigateToNextStep: function () {
            stepNavigator.next();
        }
    });
});
