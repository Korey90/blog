function applyCustomColorFromClass(className) {
    const elements = document.querySelectorAll(`.${className}`);
    
    elements.forEach((element) => {
      element.style.color = getComputedStyle(document.documentElement).getPropertyValue('--custom-color');
    });
  }

import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// resources/js/bootstrap.js

import 'bootstrap/dist/js/bootstrap.bundle.min';


  