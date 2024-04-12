/**reportinc.js */
document.addEventListener("DOMContentLoaded", function () {
  $("#error").html("");
  $("#success").html("");

  $("#submit").click(function (event) {
    event.preventDefault();

    var postText = $("#postText").val();

    if (postText == null || postText.trim() === "") {
      alert("Post Text can't be blank");
      return false;
    }

    $.ajax({
      url: "../actions/addpost_action.php",
      method: "post",
      data: JSON.stringify({
        postText: postText,
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
        window.location.href = "../view/sayfforum.php";
      },
      error: (error) => {
        $("#error").html(error.error);
      },
    });
  });
});
