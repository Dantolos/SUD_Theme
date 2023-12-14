

let TimelineList = document.querySelectorAll('.timeline-list');

TimelineList.forEach( async (Timelines) => {
     Timelines.querySelectorAll('.timeline-item').forEach((TimelineItem) => {
 
          let TimelineTitle = TimelineItem.querySelector('.timeline-title');
          let TimelineContent = TimelineItem.querySelector('.timeline-desc');

          TimelineTitle.addEventListener('click', async (event) => {
               console.log(event.currentTarget)
               await TimelineItem.classList.toggle('active')
 
               var TimelineTL = await gsap.timeline( { paused: true, duraction: .1 });
               TimelineTL.from( 
                    TimelineContent,
                    { y: 0, opacity: 1 } 
               );

               if(TimelineItem.classList.contains('active')) {
                    gsap.fromTo( 
                         TimelineContent, 
                         { duration: .1, y: '100px', opacity: 0 },
                         { y: 0, opacity: 1 } 
                    )
               } else {
                    gsap.fromTo( 
                         TimelineContent, 
                         { duration: .5, y: 0, opacity: 1 },
                         { y: '-200px', opacity: 0 } 
                    )
               }
          })

          
     }) 
})