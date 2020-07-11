$(document).ready(function () {

    var places = require('places.js');
    var placesAutocomplete = places({
    appId: 'plZON97PJS4T',
    apiKey: '485e6334a610b0b3d89ac65d5c4ca0a4',
    container: document.querySelector('#address-input')
    });

});