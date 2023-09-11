

document.addEventListener( 'DOMContentLoaded', function() {
     var splide = new Splide( '#testimonial-slide', {
          width: '1600px',
          perPage: 2,
          arrows: false,
          autoplay: true,
          rewind: true,
          breakpoints: {
               1024: {
                    perPage: 1,
               }
          }
     });
     splide.mount();
} );

