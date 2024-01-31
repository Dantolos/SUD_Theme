

// LIGHTBOX
async function sudLightbox(target) {
     let LIGHTBOX_WRAPPER = await document.querySelector('[lbtarget="' + target + '"]');
     let LIGHTBOX_CONTAINER = await LIGHTBOX_WRAPPER.querySelector('.lightbox-container');
     console.log(LIGHTBOX_WRAPPER);
     LIGHTBOX_WRAPPER.style.visibility = 'visible';
     document.querySelector('body').append(LIGHTBOX_WRAPPER);
     gsap.fromTo( LIGHTBOX_WRAPPER, {  opacity: 0 }, { duration: .2, opacity: 1 })
     gsap.fromTo( LIGHTBOX_CONTAINER, { scale: .8 }, { duration: .3, scale: 1 })
     gsap.fromTo( LIGHTBOX_CONTAINER.querySelectorAll('div'), {  scale: .8 }, { stagger: .025, duration: .3, scale: 1 })

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
                              start: "-200px 100%", 
                              end: "bottom top", 
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


// MENU
// JavaScript to handle the dropdown menu
const parentMenuItems = document.querySelectorAll('.se2-navigation .se2-submenu');

parentMenuItems.forEach((menuItem) => {
     const parentLink = menuItem.querySelector('.parent-menu-item');

     menuItem.addEventListener('mouseover', () => {
          menuItem.querySelector('.se2-sub-menu').style.display = 'block';
     });

     menuItem.addEventListener('mouseout', (event) => {
          const relatedTarget = event.relatedTarget;
          if (!relatedTarget || !menuItem.contains(relatedTarget)) {
               menuItem.querySelector('.se2-sub-menu').style.display = 'none';
          }
     });
});

//MOBILE BURGER MENU
const burgerMenu = document.querySelector('.burger-menu-trigger');
const mobileMenu = document.querySelector('.burger-menu-wrapper');
const closeButton = document.querySelector('.burger-menu-closer');

burgerMenu.addEventListener('click', ()=>{ 
     gsap.fromTo(mobileMenu.querySelectorAll('div,ul'), { duration: .1, stagger: .1,  y: -200 }, { y: 0 })
     gsap.fromTo(mobileMenu, { duration: .05,  y: -400, x: 0, borderRadius: '0', scale: 1.4 }, { y: 0, x: 0, borderRadius: '0', scale: 1, opacity: 1  })
     mobileMenu.classList.add("open"); 
     
})

closeButton.addEventListener('click', ()=> {
     gsap.fromTo(mobileMenu.querySelectorAll('div,ul'), { duration: .1, stagger: .1,  y: 0 }, { y: -200 })
     gsap.fromTo(mobileMenu, { duration: .05, y: 0, opacity: 1 }, { y: -500, opacity: 0 })
     console.log('close')
     setTimeout(()=> {mobileMenu.classList.remove("open")}, 500)  ;
})


// CONTENT HUB

const CONTENTHUB_TABS = document.querySelector('.template-content-hub-tab');

//INITIAL LOAD



const INITLOAD = async () => {
     let firstTab = await document.querySelectorAll('.content-hub-tab-content')[0]
     firstTab.style.display = 'block'
     await firstTab.classList.add('active-tab-content')
     firstTab.dataset.page = 1 
     let searchResult = await handleFetchAPI( firstTab.dataset.content )
     reloadData(firstTab, searchResult) 
}
if( document.querySelectorAll('.content-hub-tab-content').length > 0 ){
     INITLOAD()
}

if(CONTENTHUB_TABS){
     let CONTENTHUB_TAB_BUTTONS = CONTENTHUB_TABS.querySelectorAll('button');
     CONTENTHUB_TAB_BUTTONS.forEach( CONTENTHUB_TAB_BUTTON => { 
           
          CONTENTHUB_TAB_BUTTON.addEventListener('click', async ()=> { 
               await document.querySelectorAll('.content-hub-tab-content').forEach( tabContent => {
                    tabContent.classList.remove('active-tab-content')
                    tabContent.style.display = 'none' 
               })

               await CONTENTHUB_TAB_BUTTONS.forEach( tab => { 
                    tab.classList.remove('active-tab')
               })
               
               let Wrapper = await document.querySelector('[data-content="'+CONTENTHUB_TAB_BUTTON.dataset.contenttype+'"]')
               
               CONTENTHUB_TAB_BUTTON.classList.add('active-tab')
 
               Wrapper.style.display = 'block';
               await Wrapper.classList.add('active-tab-content')
               Wrapper.dataset.page = 1 
               let searchResult = await handleFetchAPI( Wrapper.dataset.content )

               reloadData(Wrapper, searchResult) 
          })
     } )
}

const CONTENT_SEARCH_FORM = document.getElementById('search-form');
const CONTENT_VIDEO_CONTAINER = document.querySelector('[data-content="video"]')
const CONTENT_PODCAST_CONTAINER = document.querySelector('[data-content="podcast"]')

const handleSearch = async (e) => { 
     e.preventDefault(); 
     let searchContent = document.getElementById('search-input').value
     let activeTab = document.querySelector('.active-tab-content')

     // set dom params 
     //reset pagination
     activeTab.dataset.page = 1    
     activeTab.dataset.search = searchContent

     let searchResult = await handleFetchAPI( activeTab.dataset.content )
     
     reloadData(activeTab, searchResult)  
     

     return false;
}
//document.getElementById('search-input').onchange(handleSearch())

const reloadData = (parent, result) => {
     container = parent.querySelector('.contenthub-container')
     console.log(container)
     container.innerHTML = '';
     if(result == false){
          container.innerHTML += '<div class="no-results">No results found</div>'
          
     }
     for (let index = 0; index < result.length; index++) {
          switch (parent.dataset.content) {
               case 'video':
                    container.append( createVideoDIV(result[index])  )
                    break;
               case 'podcast':
                    container.append( createPodcastDIV(result[index])  )
                    break;
               default:
                    break;
          }
     }
}

const handleFetchAPI = async ( posttype ) => {
     let result = [];

     // filter
     let CONTENTWRAPPER = document.querySelector(`.content-hub-tab-content[data-content="${posttype}"]`)
     searchfilter = CONTENTWRAPPER.dataset.search ? `search=${CONTENTWRAPPER.dataset.search}` : '';
     let page = CONTENTWRAPPER.dataset.page ? CONTENTWRAPPER.dataset.page : '1';
     let perPage = '6';

     let resp = await fetch(`${globalURL.baseUrl}/wp-json/wp/v2/${posttype}?${searchfilter}&per_page=${perPage}&page=${page}`)
          .then( response => {
               totalPages = response.headers.get('x-wp-totalpages')
               handlePagination(totalPages)
               console.log('total Pages: '+ totalPages)
               return response.json() 
          })
          .then(posts => {
               posts.forEach(async post => {
                    result.push( post )
               });
          })
          .catch(error => {
               console.log('Error fetching posts:', error);
          });
     return result;
}

const handlePagination = (totalPages, activePage = 1, parent) => {
     let posttype = document.querySelector('.active-tab-content').dataset.content

     let paginationContainer = document.querySelector('.pagination-container');
     if(paginationContainer) {
          paginationContainer.innerHTML = ''
     } else {
          paginationContainer = document.createElement('div'); 
     }
 
     paginationContainer.className = 'pagination-container'
     for(let i=1;i<=totalPages;i++){
          let pagButton = document.createElement('button')
          pagButton.innerText = `${i}` 
          pagButton.dataset.page = i

          if(activePage === i){
               pagButton.classList.add('is-active-pagination')
               pagButton.disabled = true
          } else {
               pagButton.classList.remove('is-active-pagination')
               pagButton.disabled = false
          }
          
          paginationContainer.appendChild(pagButton)
          pagButton.addEventListener("click", async () => { 
               document.querySelector('.active-tab-content').dataset.page = i
               let searchResult = await handleFetchAPI( posttype )
               reloadData(document.querySelector('.active-tab-content'), searchResult)

               paginationContainer.querySelectorAll('button').forEach(pagebtn => {
                    console.log(pagebtn.dataset.page + ' ---- ' + i )
                    if(pagebtn.dataset.page == i){
                         pagebtn.classList.add('is-active-pagination')
                         pagebtn.disabled = true
                    } else {
                         pagebtn.classList.remove('is-active-pagination')
                         pagebtn.disabled = false
                    }
               })
          })
     }
     document.querySelector('.active-tab-content').appendChild(paginationContainer)
}

// -------------------------------
// CREATE CONTENT
// -------------------------------

const createVideoDIV = (content) => {
     console.log(content)
     let dimensions = {
          width: '350',
          height: '198'
     }
     
     let videoWrapper = document.createElement('div');
     let videoDiv = document.createElement('div');
     videoWrapper.className = "video-item";
     videoWrapper.style.width = `${dimensions.width}px`;
     videoDiv.className = 'video-div'; 
     videoDiv.classList.add('skeletton')

     let shareURL = new URL(content.acf.link)
     let videoiframe = '';
     switch (content.acf.type) {
          case 'yt':
               console.log(shareURL)
               let embedYRURL = `https://www.youtube.com/embed${shareURL.pathname}`
               videoiframe = `<iframe width="${dimensions.width}" height="${dimensions.height}" src="${embedYRURL}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`
               break;
          case 'vimeo':
               console.log(shareURL)
               let embedVimeoURL = `https://player.vimeo.com/video${shareURL.pathname}?badge=0&amp;autopause=0&amp;quality_selector=1&amp;player_id=0&amp;app_id=58479`
               videoiframe = `<iframe src="${embedVimeoURL}" width="${dimensions.width}" height="${dimensions.height}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" title="Digital Transformation of Healthcare"></iframe>`
               break;
          default:
               break;
     }
     videoDiv.innerHTML = videoiframe
     let videoTitle = document.createElement('h4')
     videoTitle.className = 'fxs c-blue skeletton';
     
     
     videoWrapper.appendChild(videoDiv)
     videoWrapper.appendChild(videoTitle)
     setTimeout(()=>{
          videoTitle.classList.remove('skeletton')
          videoTitle.innerHTML = content.title.rendered; 
          videoDiv.classList.remove('skeletton')
     }, 200)
     return videoWrapper
}


const createPodcastDIV = (content) => {
     console.log(content)
     let podcastWrapper = document.createElement('div');
     let  podcastDiv = document.createElement('div');
     podcastWrapper.className = "podcast-item"; 
     podcastDiv.className = 'podcast-div'; 
     podcastDiv.classList.add('skeletton')
 
     let podcastTitle = document.createElement('h3')
     podcastTitle.className = 'fxs skeletton'
     podcastTitle.innerHTML = content.title.rendered; 
     let podcastLinks = document.createElement('div')
     podcastLinks.className = 'podcast-links'

     //Spotify Embed
     let shareURL = new URL(content.acf.spotity_link)
     spotifyEmbed = `https://${ shareURL.hostname + shareURL.pathname.replace("episode", "embed/episode") }?utm_source=generator&theme=0`;
     let spotifyIframe = `<iframe src="${spotifyEmbed}" width="70%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>`

     //appleLink 
     let appleLink = `
          <a href="${content.acf.apple_podcast_link}" target="_blank">
          <div class="podcast-button apple-podcast-button bg-blue">
          <img src="${globalURL.templateUrl}/assets/img/utils/sm/apple-neg.svg" alt="apple podcast"/>
          </div>
          </a>
     `
     let swisspreneurLink = `
          <a href="${content.acf.swisspreneur_link}" target="_blank">
          <div class="podcast-button swisspreneur-podcast-button bg-blue">
          <img src="${globalURL.templateUrl}/assets/img/utils/sm/swisspreneur-neg.svg" alt="apple podcast"/>
          </div>
          </a>
     `

     podcastLinks.innerHTML = spotifyIframe + appleLink + swisspreneurLink;
     podcastWrapper.appendChild(podcastTitle)
     podcastWrapper.appendChild(podcastLinks)
     return podcastWrapper 
}