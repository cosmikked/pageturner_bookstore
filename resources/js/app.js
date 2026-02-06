import $ from 'jquery';
window.$ = window.jQuery = $;

import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Import our custom CSS
import '../scss/app.scss'

// Import all of Bootstrap’s JS
import * as bootstrap from 'bootstrap'
