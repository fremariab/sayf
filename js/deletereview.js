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
  function confirmDelete(revid) {
    if (confirm("Are you sure you want to delete this assignment?")) {
      window.location.href =
        "../actions/deletereview_action.php?revid=" + revid + "&did=" + did;
    }
  }
  //   $("#error").html("");
  //   $("#success").html("");

  $("#submit").click(function (event) {
    event.preventDefault();

    $.ajax({
      url: "../actions/deletereview_action.php",
      method: "post",
      data: JSON.stringify({
        revid: revid,
      }),
      dataType: "json",
      success: (data, status) => {
        console.log(data, status);
        if (data.status == 201) {
          response = data;

          //   var message = data.message;
          //   var messageElement = '<div class="alert">' + message + "</div>";
          //   $("#success").append(messageElement);
          //   setTimeout(function () {
          //     $(".alert").remove();
          //   }, 20000);

          alert("Review deleted successfully");
        }
        window.location.href = "../view/driverdetails.php?did=" + did;
      },
      error: (error) => {
        $("#error").html(error.error);
      },
    });
  });
});
