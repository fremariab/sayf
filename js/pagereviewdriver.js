/**reviewdriver.js */
document.addEventListener("DOMContentLoaded", function () {
  const stars = document.querySelectorAll(".stars i");

  let selectedStar = 0;
  let selectedCompany = "";
  $("#error").html("");
  $("#success").html("");
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

  function getUrlParameter(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }
  var driverId = getUrlParameter("did");

  $("#submit").click(function (event) {
    event.preventDefault();

    var starrating = selectedStar;
    var reviewDescription = $("#ReviewDescription").val();

    if (reviewDescription == null || reviewDescription.trim() === "") {
      $("#error").html("Review Description can't be blank");
      return false;
    }

    $.ajax({
      url: "../actions/pagereviewdriver_action.php",
      method: "post",
      data: JSON.stringify({
        driverId: driverId,
        rating: starrating,
        reviewDescription: reviewDescription,
      }),
      dataType: "json",
      success: (data, status) => {
        console.log(data, status);
        if (data.status == 201) {
          var message = data.message;
          var messageElement = '<div class="alert">' + message + "</div>";
          $("#success").append(messageElement);
          setTimeout(function () {
            $(".alert").remove();
          }, 10000);
          window.location.href = "../view/driverdetails.php?did=" + driverId;
        }
      },
      error: (error) => {
        $("#error").html(error.error);
      },
    });
  });
});
