/**signup.js */
$("#submit").click(function (event) {
  event.preventDefault();

  const characters = "abcdefghijklmnopqrstuvwxyz0123456789";

  let username = "";

  const usernameLength = 8;

  for (let i = 0; i < usernameLength; i++) {
    const randomIndex = Math.floor(Math.random() * characters.length);
    username += characters[randomIndex];
  }

  var password = $("#register_password").val();
  var confirmPassword = $("#register_password1").val();
  if (password !== confirmPassword) {
    alert("Passwords do not match.");
    return;
  }

  $.ajax({
    url: "../actions/signup_action.php",
    method: "post",
    data: JSON.stringify({
      username: username,
      gender: $("input[name='gender']:checked").val(),
      phone_number: $("#phone_number").val(),
      register_email: $("#register_email").val(),
      register_password: $("#register_password").val(),
      register_password1: $("#register_password1").val(),
    }),
    dataType: "json",
    success: (data, status) => {
      console.log(data.status);
      if (data.status == 201) {
        window.location.href = "../login/login.php";
      }
    },
    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
