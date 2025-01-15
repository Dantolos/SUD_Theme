const canditates = document.querySelectorAll(".sud__canditate_box");

console.log(canditates);

canditates.forEach((candidate) => {
  candidate.addEventListener("click", () => {
    let candidateID = candidate.getAttribute("data-candidate");
    sudLightbox(candidateID);
  });
});
