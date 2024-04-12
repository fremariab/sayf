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
        // if (data.data && data.data.user_role == 1) {
        //   window.location.href = "../admin/admindash.php";
        // } else {
        //   window.location.href = "../view/userdash.php";
        // }    var message = (data.data && data.data.user_role == 1) ? "Logged in successfully as admin." : "Logged in successfully as user.";
        var messageElement = '<div class="alert">' + message + "</div>";
        $("#success").append(messageElement); // Append the message to the body of the page
        setTimeout(function () {
          $(".alert").remove(); // Remove the message after a certain duration (e.g., 5 seconds)
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
      // var responseData = JSON.parse(error.responseText);
      $("#error").html(error.error);
    },
  });
});
