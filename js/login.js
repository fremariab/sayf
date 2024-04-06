/**login.js */
$("#submit").click(function (event) {
  event.preventDefault();

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
      //   var response = this.responseText;
      //   window.location.href = "../view/userdash.php";
    },
    error: (error) => {
      console.log(data.error);
    },
  });
});
