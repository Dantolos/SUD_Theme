const PeopleDetailButtons = document.querySelectorAll(
  ".sud__people_highlight_person_more_button",
);

PeopleDetailButtons.forEach((PeopleDetailButton) => {
  PeopleDetailButton.addEventListener("click", () => {
    let PersonID = PeopleDetailButton.getAttribute("data-person");
    sudLightbox(PersonID);
  });
});
