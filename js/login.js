/**login.js */
$("#submit").click(function (event) {
  event.preventDefault();
  var name = $("#username").val();
  var password = $("#password").val();

  if (name == null || name == "") {
    alert("Username can't be blank");
    return false;
  } else if (password.length < 8) {
    alert("Password must be at least 6 characters long.");
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
      console.log(response.data.user_role);
      if (data.status == 200) {
        if (response.data.user_role == 1) {
          window.location.href = "../admin/admindash.php";
        } else {
          window.location.href = "../view/userdash.php";
        }
      }
    },
    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
