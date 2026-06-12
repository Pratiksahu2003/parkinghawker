import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

// Register GSAP plugin
gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
Alpine.start();

// Initialize Lenis Smooth Scroll
const lenis = new Lenis({
  duration: 1.2,
  easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
  orientation: 'vertical',
  gestureOrientation: 'vertical',
  smoothWheel: true,
  wheelMultiplier: 1,
  touchMultiplier: 2,
  infinite: false,
});

// Sync Lenis with GSAP ScrollTrigger
lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});

gsap.ticker.lagSmoothing(0);

// Global GSAP Page Reveals
document.addEventListener('DOMContentLoaded', () => {
  // Fade in animation targets
  gsap.from('.reveal-fade', {
    opacity: 0,
    duration: 1,
    stagger: 0.15,
    ease: 'power2.out',
    delay: 0.2
  });

  // Upward entrance animations
  gsap.from('.reveal-up', {
    y: 40,
    opacity: 0,
    duration: 1.2,
    stagger: 0.1,
    ease: 'power4.out',
    delay: 0.1
  });

  // Parallax background items
  gsap.utils.toArray('.parallax-bg').forEach((bg) => {
    gsap.to(bg, {
      yPercent: 20,
      ease: 'none',
      scrollTrigger: {
        trigger: bg,
        start: 'top bottom',
        end: 'bottom top',
        scrub: true
      }
    });
  });

  // Numeric scroll counter reveals
  gsap.utils.toArray('.counter-num').forEach((counter) => {
    const endVal = parseInt(counter.getAttribute('data-target'), 10);
    if (!isNaN(endVal)) {
      gsap.fromTo(counter, 
        { textContent: 0 }, 
        { 
          textContent: endVal, 
          duration: 2.5, 
          ease: 'power2.out',
          snap: { textContent: 1 },
          scrollTrigger: {
            trigger: counter,
            start: 'top 85%',
            once: true
          }
        }
      );
    }
  });

  // Magnetic button effects
  const magneticButtons = document.querySelectorAll('.magnetic-btn');
  magneticButtons.forEach((btn) => {
    btn.addEventListener('mousemove', (e) => {
      const rect = btn.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      gsap.to(btn, {
        x: x * 0.4,
        y: y * 0.4,
        duration: 0.3,
        ease: 'power2.out'
      });
    });

    btn.addEventListener('mouseleave', () => {
      gsap.to(btn, {
        x: 0,
        y: 0,
        duration: 0.5,
        ease: 'elastic.out(1, 0.3)'
      });
    });
  });
});
