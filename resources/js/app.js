// import './bootstrap';
// import * as bootstrap from 'bootstrap';

import AOS from 'aos';
import 'aos/dist/aos.css'; 


document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 50
    });

    if ('loading' in HTMLImageElement.prototype) {
        document.querySelectorAll('img[loading="lazy"]').forEach(img => {
            if (img.src) {
                img.src = img.src;
            }
        });
    }
});