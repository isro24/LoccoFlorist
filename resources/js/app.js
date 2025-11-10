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

    // Navigation
    try {
        const currentUrl = window.location.href.split('?')[0].split('#')[0].replace(/\/$/, "");
        const navLinks = document.querySelectorAll('.desktop-menu .nav-link, .footnavbar .nav-link');
        
        navLinks.forEach(link => {
            const cleanLinkHref = link.href.split('?')[0].split('#')[0].replace(/\/$/, "");
            
            if (cleanLinkHref === currentUrl || (cleanLinkHref + '/public') === currentUrl) {
                link.classList.add('active');
            }
        });
    } catch (e) {
        console.error("Error setting active nav link:", e);
    }
});