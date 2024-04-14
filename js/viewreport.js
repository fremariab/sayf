/**viewrhc.js */
document.addEventListener("DOMContentLoaded", function () {
  // $("#getcompanies").click(function () {
  $.ajax({
    url: "../actions/viewreport_action.php",
    method: "get",
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);

      if (data.status == 200) {
        response = data;
 
        let result = "";

        if (response.user_role == 1) {
          response.data.forEach((element) => {
            result += "<tr>";
            result += "<td>" + element.username + "</td>";
            result +=
              "<td class='rhcname'>" +
              element.fname +
              " " +
              element.lname +
              "</td>";
            result +=
              "<td class='contactnum'>" + element.company_name + "</td>";
            result += "<td class='email'>" + element.incident_date + "</td>";
            result +=
              "<td class='location'>" + element.report_description + "</td>";
            result += "</tr>";
          });
        } else {
          if(element.uid == response.user_id){
          response.data.forEach((element) => {
            result += "<tr>";
            result +=
              "<td class='rhcname'>" +
              element.fname +
              " " +
              element.lname +
              "</td>";
            result +=
              "<td class='contactnum'>" + element.company_name + "</td>";
            result += "<td class='email'>" + element.incident_date + "</td>";
            result +=
              "<td class='location'>" + element.report_description + "</td>";
            result += "</tr>";
          });
        }

        document.getElementById("display_report_data").innerHTML += result;
      }
    },
    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
