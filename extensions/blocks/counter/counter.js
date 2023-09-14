gsap.registerPlugin(ScrollTrigger);

const counters = document.querySelectorAll('.counter-wrapper');

function countFuntion(){
     const counters = document.querySelectorAll('.count-value');
     const speed = 150;

     counters.forEach( counter => {
     const animate = () => {
          const value = +counter.getAttribute('count-value');
          const data = +counter.innerText;
          
          const duration = 2000 / value;
          const time = value / speed;
          if(data < value) {
               counter.innerText = Math.ceil(data + time);
               setTimeout(animate, duration);
          }else{
               counter.innerText = value;
          }
          
     }
     
     animate()
     });
}

document.addEventListener("DOMContentLoaded", function () {

     const element = document.querySelector(".counter-wrapper");
   
     const tl = gsap.timeline({
       scrollTrigger: {
         trigger: element,
         start: "top 80%", // Adjust this value as needed
         end: "bottom 20%", // Adjust this value as needed
         onEnter: countFuntion,
         markers: false,
       },
     });
    
     tl.fromTo(
       element.querySelectorAll('.counter'),
       { opacity: 0, scale: .8, y: 20 },
       { opacity: 1, scale: 1, y: 0, duration: .4, stagger: {
          each: .1,
          from: 'random'
        }}
       
     );
});