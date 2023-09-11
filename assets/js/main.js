

// LIGHTBOX
async function sudLightbox(target) {
     let LIGHTBOX_WRAPPER = await document.querySelector('[lbtarget="' + target + '"]');
     console.log(LIGHTBOX_WRAPPER);
     LIGHTBOX_WRAPPER.style.visibility = 'visible';
     
     const CLOSER = async () => {
          let LIGHTBOX_CLOSER = await LIGHTBOX_WRAPPER.querySelector('[lbcloser="' + target + '"]');
          console.log(LIGHTBOX_CLOSER)
          LIGHTBOX_CLOSER.addEventListener('click', () => {
              LIGHTBOX_WRAPPER.style.visibility = 'hidden';
          });
     }
     await CLOSER();
}

// REVEAL ANIMATIONS
/*
gsap.registerPlugin(ScrollTrigger);
const sudElements = document.querySelectorAll('.sud-element-animation');

for (let i=0;i<sudElements.length;i++) {
    
     gsap.to(sudElements[i], {
          scrollTrigger: {
               trigger: sudElements[i],
               toggleActions: 'play none none pause',
               scrub: true
          },
          rotation: 240, 
          opacity: 1,
          scale: 1.25,
          x: 150,
          y: -150,
          transformOrigin:"75% center",
          duration: 3
     })
}
*/