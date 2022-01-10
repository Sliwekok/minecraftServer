/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//enable bootstrap tooltips
function enableTooltips() {
    $('[data-toggle="tooltip"]').tooltip()
}enableTooltips();

require('./settings.js');
require('./create.js');
require('./index.js');
require('./console.js');
