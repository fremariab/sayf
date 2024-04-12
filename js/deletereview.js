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

  document
    .getElementById("deleteAction")
    .addEventListener("click", function () {
      confirmDelete(revid, did);
    });

  function confirmDelete(revid, did) {
    if (confirm("Are you sure you want to delete this review?")) {
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

            alert("Review deleted successfully");
          }
          window.location.href = "../view/driverdetails.php?did=" + did;
        },
        error: (error) => {
          $("#error").html(error.error);
        },
      });
    }
  }
});
