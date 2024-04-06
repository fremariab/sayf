/**login.js */
$("#submit").click(function (event) {
  event.preventDefault();

  $.ajax({
    url: "../actions/signup_action.php",
    method: "post",
    data: JSON.stringify({
      username: $("#uname").val(),
      gender: $("#gender").val(),
      phone_number: $("#phone_number").val(),
      register_email: $("#register_email").val(),
      register_password: $("#register_password").val(),
      register_password1: $("#register_password1").val(),
    }),
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      //   var response = this.responseText;
      //   window.location.href = "../view/userdash.php";
    },
    error: (error) => {
      console.log(data.error);
    },
  });
});
