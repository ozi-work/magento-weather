define([
    'uiComponent',
    'ko'
], function (Component, ko) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Kyro_WeatherFrontend/weather_widget'
        },

        locationName: ko.observable(''),
        country: ko.observable(''),
        temperature: ko.observable(''),
        conditionText: ko.observable(''),
        conditionIcon: ko.observable(''),

        initialize: function () {
            this._super();
        }
    });
});
