

// LIGHTBOX
async function sudLightbox(target) {
     let LIGHTBOX_WRAPPER = await document.querySelector('[lbtarget="' + target + '"]');
     console.log(LIGHTBOX_WRAPPER);
     LIGHTBOX_WRAPPER.style.visibility = 'visible';
     document.querySelector('body').append(LIGHTBOX_WRAPPER);
     
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
document.addEventListener("DOMContentLoaded", function () {
     const ElementAmount = document.querySelectorAll('.sud-element');

     if( ElementAmount.length > 0 ){
          for (let e = 0; e < ElementAmount.length; e++) {
               let element = ElementAmount[e]
               let shapeType = element.getAttribute('sud-shape')
               let path = '';
               if(shapeType){
                    switch (shapeType) {
                         case 'semicircle':
                              path = 'circle(50% at 50% 0%)';
                              break;
                         case 'polycon-01':
                              path = 'polygon(100% 0, 63% 71%, 100% 100%)';
                              break;
                         default:
                              break;
                    }
               }
               
               let shape = document.createElement('div')
               shape.style.clipPath = path;
               
               element.appendChild(shape) 
               const parent = element.parentElement;

               const randomize = Math.random()
               let targetDeg = 180 + (randomize * 10 + e)
               let endDeg = 200 + (randomize * 100 + e)
               const tl = gsap.timeline({
                    scrollTrigger: {
                         trigger: parent,
                         start: "-200px 100%", // Adjust this value as needed
                         end: "bottom top", // Adjust this value as needed
                         scrub: 1,
                         onEnter: countFuntion,
                         markers: false,
                    },
                    });
                    let delay = Math.random();
                    tl.set( element, { scale: .8, rotate: '150deg', y: 2000, ease:"none", display:'block' } )
                    .to( element, { scale: 1, rotate:targetDeg+'deg', y: 0, ease:"none"  } )
                    .to( element, { scale: 1.5, rotate: endDeg+'deg', y: -2000, opacity: 0, ease:"none"  } );

          }

          
     
         
     }
});