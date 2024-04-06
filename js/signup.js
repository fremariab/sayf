/**signup.js */
$("#submit").click(function (event) {
  event.preventDefault();

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
      username: $("#uname").val(),
      gender: $("input[name='gender']:checked").val(),
      phone_number: $("#phone_number").val(),
      register_email: $("#register_email").val(),
      register_password: $("#register_password").val(),
      register_password1: $("#register_password1").val(),
    }),
    dataType: "json",
    success: (data, status) => {
      console.log(status);
      if (status == 201) {
        window.location.href = "../login/login.php";
      } else {
        console.log(message);

        // document.getElementById("error").innerHTML += data.data.message;
      }
    },
    error: (error) => {
      console.log(data.error);
    },
  });
});
