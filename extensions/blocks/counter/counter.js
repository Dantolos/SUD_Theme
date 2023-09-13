gsap.registerPlugin(ScrollTrigger);

const counters = document.querySelectorAll('.counter-wrapper');

function customFuntion(){console.log('ahaslkdf')}

// Wait for the DOM to be ready
document.addEventListener("DOMContentLoaded", function () {
     // Select the element you want to animate
     const element = document.querySelector(".counter-wrapper");
   
     // Create a timeline for the animation
     const tl = gsap.timeline({
       scrollTrigger: {
         trigger: element,
         start: "top 80%", // Adjust this value as needed
         end: "bottom 20%", // Adjust this value as needed
         onEnter: customFuntion, // Call customFunction when the element enters the specified range
         markers: false, // Optional: Adds visual markers for debugging
       },
     });
   
     // Define your animation inside the timeline
     tl.fromTo(
       element,
       { opacity: 0, scale: .8, y: 20 },
       { opacity: 1, scale: 1, y: 0, duration: .4 }
     );
   });