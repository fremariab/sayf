// const stars = document.querySelectorAll(".stars i");
// stars.forEach((star, index1) => {
//   star.addEventListener("click", () => {
//     stars.forEach((star, index2) => {
//       index1 >= index2
//         ? star.classList.add("active")
//         : star.classList.remove("active");
//     });
//   });
// });

document.addEventListener("DOMContentLoaded", function() {
  const stars = document.querySelectorAll(".stars i");
  const reviewDescriptionInput = document.getElementById("ReviewDescription");
  const submitButton = document.getElementById("submit");

  let selectedStar = 0; 

  stars.forEach((star, index1) => {
      star.addEventListener("click", () => {
          selectedStar = index1 + 1;  
          stars.forEach((star, index2) => {
              index1 >= index2
                  ? star.classList.add("active")
                  : star.classList.remove("active");
          });
      });
  });

  submitButton.addEventListener("click", (event) => {
      event.preventDefault();  
       const reviewDescription = reviewDescriptionInput.value;
      console.log("Selected Star Rating:", selectedStar);
      console.log("Review Description:", reviewDescription);
   });
});