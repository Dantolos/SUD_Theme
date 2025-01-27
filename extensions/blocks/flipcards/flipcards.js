document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelector("#flipcards-slide")) {
    console.log("flipcard ---- ");
    var splide = new Splide("#flipcards-slide", {
      width: "1600px",
      perPage: 2,
      arrows: false,
      autoplay: true,
      rewind: true,
      breakpoints: {
        1024: {
          perPage: 1,
        },
      },
    });
    splide.mount();
  }
});
