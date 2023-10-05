document.addEventListener("DOMContentLoaded", function () {
     const video = document.getElementById("hero_video");
 
     function setRandomStartTime() {
         if (!isNaN(video.duration)) {
             const step = 2; // Set the time interval in seconds (e.g., 2 seconds)
             const randomStep = Math.floor(Math.random() * (video.duration / step)) * step;
             video.currentTime = randomStep;
             video.play();
         }
     }
 
    // Ensure the video has loaded metadata before setting a random start time
    if(video){
        video.addEventListener("loadedmetadata", function () {
            setRandomStartTime();
        });
    }
 });