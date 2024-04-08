/**viewrhc.js */
window.addEventListener("load", (event) => {
  $.ajax({
    url: "../actions/viewrhc_action.php",
    method: "get",
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 201) {
        response = data;

        let result = "";

        response.data.forEach((element) => {
          result += "<tr>";
          result += "<td class='rhcname'>" + element.company_name + "</td>";
          result +=
            "<td class='contactnum'>" + element.contact_number + "</td>";
          result += "<td class='email'>" + element.email + "</td>";
          result += "<td class='location'>" + element.location + "</td>";
          result += "</tr>";
        });
        document.getElementById("display_rhc_data").innerHTML += result;
      }
    },
    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
