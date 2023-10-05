

const AccordionList = document.querySelectorAll('.accordion-list');

AccordionList.forEach((Accordions) => {
     Accordions.querySelectorAll('.accordion-item').forEach((AccordionItem) => {

         
          let AccordionTitle = AccordionItem.querySelector('.accordion-item-title');
          let AccordionContent = AccordionItem.querySelector('.accordion-item-content');

          AccordionTitle.addEventListener('click', (event) => {
               console.log(event.currentTarget)
               AccordionItem.classList.toggle('active')
               
 
               var AccordionTL = gsap.timeline( { paused: true, duraction: .1 });
               AccordionTL.from( 
                    AccordionContent,
                    { y: 0 ,  opacity: 1 } 
               );

               if(AccordionTitle.classList.contains('active')){
                    gsap.fromTo( 
                         AccordionContent, 
                         { duration: .1, y: '100px' ,  opacity: 0 },
                         { y: 0 ,  opacity: 1 } 
                    )
               } else {
                    gsap.fromTo( 
                         AccordionContent, 
                         { duration: .5, y: 0 ,  opacity: 1 },
                         { y: '-200px' ,  opacity: 0 } 
                    )
               }
          })

          
     }) 
})