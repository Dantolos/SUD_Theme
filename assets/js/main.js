

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