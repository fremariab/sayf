/**login.js */
$("#submit").click(function (event) {
  event.preventDefault();
  var name = $("#username").val();
  var password = $("#password").val();

  if (name == null || name == "") {
    $("#error").html("Username can't be blank");
    return false;
  } else if (password.length < 8) {
    $("#error").html("Password must be at least 6 characters long.");
    return false;
  }
  $("#error").html("");
  $("#success").html("");

  $.ajax({
    url: "../actions/login_action.php",
    method: "post",
    data: JSON.stringify({
      username: $("#username").val(),
      password: $("#password").val(),
    }),
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 200) {
        var message =
          data.data && data.data.user_role == 1
            ? "Logged in successfully as admin."
            : "Logged in successfully as user.";
        var messageElement = '<div class="alert">' + message + "</div>";
        $("#success").append(messageElement);
        setTimeout(function () {
          $(".alert").remove();
        }, 7000);
        if (data.data && data.data.user_role == 1) {
          window.location.href = "../admin/admindash.php";
        } else {
          window.location.href = "../view/userdash.php";
        }
      } else {
        $("#error").html(data.error);
      }
    },
    error: (error) => {
      $("#error").html(error.error);
    },
  });
});
