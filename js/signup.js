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
      console.log(data.status);
      if (data.status == 201) {
        window.location.href = "../login/login.php";
      }
    },
    error: (error) => {
      document.getElementById("error").innerHTML = error.responseText;
    },
  });
});
