/**reportinc.js */
document.addEventListener("DOMContentLoaded", function () {
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }
  var revid = getUrlParameter("revid");
  const stars = document.querySelectorAll(".stars i");
  var did = getUrlParameter("did");

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

  $("#error").html("");
  $("#success").html("");

  $("#submit").click(function (event) {
    event.preventDefault();

    var starrating = selectedStar;
    var reviewDescription = $("#ReviewDescription").val();

    if (reviewDescription == null || reviewDescription.trim() === "") {
      alert("Review Description can't be blank");
      return false;
    }

    $.ajax({
      url: "../actions/editreview_action.php",
      method: "post",
      data: JSON.stringify({
        rating: starrating,
        reviewDescription: reviewDescription,
        revid: revid,
      }),
      dataType: "json",
      success: (data, status) => {
        console.log(data, status);
        if (data.status == 201) {
          response = data;

          var message = data.message;
          var messageElement = '<div class="alert">' + message + "</div>";
          $("#success").append(messageElement);
          setTimeout(function () {
            $(".alert").remove();
          }, 20000);
        }
        window.location.href = "../view/driverdetails.php?did=" + did;
      },
      error: (error) => {
        $("#error").html(error.error);
      },
    });
  });
});
