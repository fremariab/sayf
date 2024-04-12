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
  var did = getUrlParameter("did");

  $("#error").html("");
  $("#success").html("");

  $("#submit").click(function (event) {
    event.preventDefault();


    $.ajax({
      url: "../actions/reportinc_action.php",
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
