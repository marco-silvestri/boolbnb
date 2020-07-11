$(document).ready(function () {

    var places = require('places.js');

    //Compile Places instance
    const fixedOptions = {
        appId: 'plZON97PJS4T',
        apiKey: '485e6334a610b0b3d89ac65d5c4ca0a4',
        container: document.querySelector('#address-input'),
    };
    
    //Compile Places Options
    const reconfigurableOptions = {
        language: 'it',
        countries: ['it'],
        type: ['address','city'],
        aroundLatLngViaIP: true,
    };
    
    //Invoke the Places instance and pass it the options
    const placesInstance = places(fixedOptions).configure(reconfigurableOptions);

});