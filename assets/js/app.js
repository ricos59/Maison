/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
// <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
//import 'bootstrap/dist/css/bootstrap.min.css';
require('bootstrap');

$(document).ready(function() {
    // you may need to change this code if you are not using Bootstrap Datepicker
    console.log('test');
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
});
