/**signup.js */
$("#submit").click(function (event) {
  event.preventDefault();

  const characters = "abcdefghijklmnopqrstuvwxyz0123456789";
  const usernameLength = 8;
  const generatedUsernames = []; // Array to store generated usernames

  function generateUsername() {
    let username = "";
    for (let i = 0; i < usernameLength; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      username += characters[randomIndex];
    }
    return username;
  }

  function isUnique(username) {
    return !generatedUsernames.includes(username);
  }

  function generateUniqueUsername() {
    let username = generateUsername();
    while (!isUnique(username)) {
      username = generateUsername();
    }
    generatedUsernames.push(username);
    return username;
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
      username: generateUniqueUsername(),
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
