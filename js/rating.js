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

  let selectedStar = 0; // Default selected star rating

  stars.forEach((star, index1) => {
      star.addEventListener("click", () => {
          selectedStar = index1 + 1; // Update selected star rating
          stars.forEach((star, index2) => {
              index1 >= index2
                  ? star.classList.add("active")
                  : star.classList.remove("active");
          });
      });
  });

  submitButton.addEventListener("click", (event) => {
      event.preventDefault(); // Prevent form submission
      // You can now use the selectedStar variable to submit the rating along with the review description
      const reviewDescription = reviewDescriptionInput.value;
      console.log("Selected Star Rating:", selectedStar);
      console.log("Review Description:", reviewDescription);
      // Here you can add code to submit the form with the selected star rating and review description
  });
});