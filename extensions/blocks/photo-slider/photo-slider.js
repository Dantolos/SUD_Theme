document.addEventListener( 'DOMContentLoaded', function() {
     var splide = new Splide( '#photo-slide', {
          padding: { left: '25%', right: '25%' },
          easing: 'ease',
          perPage: 1,
          arrows: false,
          autoplay: true,
          rewind: true,
          breakpoints: {
               1024: {
                    padding: { left: '10%', right: '10%' },
                    perPage: 1,
               },
               600: {
                    padding: { left: '2%', right: '2%' },
               }
          }
     });
     splide.mount();
     const PhotoSlider = document.getElementById('photo-slide');
     PhotoSlider.querySelector('.splide__pagination').classList.add('photo_splide__pagination');
} );

