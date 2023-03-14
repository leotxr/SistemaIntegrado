import './bootstrap';

import Alpine from 'alpinejs';

import html2canvas from 'html2canvas';

//import domtoimage from 'dom-to-image';


window.Alpine = Alpine;

Alpine.start();

if(navigator.userAgent.match(/Android/i)){
    window.scrollTo(0,1);
 }
