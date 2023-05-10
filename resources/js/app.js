import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'

import 'flowbite';

//import domtoimage from 'dom-to-image';


window.Alpine = Alpine;

Alpine.start();
Alpine.plugin(focus);

if (navigator.userAgent.match(/Android/i)) {
  window.scrollTo(0, 1);
}