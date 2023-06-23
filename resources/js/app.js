import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'
import ApexCharts from 'apexcharts'
import mask from '@alpinejs/mask'

import 'flowbite';

//import domtoimage from 'dom-to-image';


window.Alpine = Alpine;

Alpine.start();
Alpine.plugin(focus);
Alpine.plugin(mask);

if (navigator.userAgent.match(/Android/i)) {
  window.scrollTo(0, 1);
}