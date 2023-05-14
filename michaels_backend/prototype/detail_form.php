<!-- The user or applicant detail form to be called in the details.php file as part of sign-up process -->
<?php
function detail_form() {
?>
  <form action="/submit_applicant_details" method="post">
    <!-- <label for="applicantID">Applicant ID:</label> -->

    <label for="title">Title:</label>
    <select id="title" name="title" required>
      <option value="">--Please select--</option>
      <option value="Mr">Mr</option>
      <option value="Mrs">Mrs</option>
      <option value="Ms">Ms</option>
    </select><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="255"><br>

    <label for="givenName">Given Name:</label>
    <input type="text" id="givenName" name="givenName" required maxlength="255"><br>

    <label for="familyName">Family Name:</label>
    <input type="text" id="familyName" name="familyName" required maxlength="255"><br>

    <label for="employmentStatus">Employment Status:</label>
    <input type="text" id="employmentStatus" name="employmentStatus" required maxlength="255"><br>

    <!-- <label for="studentNo">Student Number:</label>
    <input type="text" id="studentNo" name="studentNo" required maxlength="10"><br> -->

    <label for="contactNo">Contact Number:</label>
    <input type="tel" id="contactNo" name="contactNo" required maxlength="10"><br>

    <label for="emailAddress">Email Address:</label>
    <input type="email" id="emailAddress" name="emailAddress" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="255"><br>

    <label for="citizenship">Citizenship:</label>
    <input type="text" id="citizenship" name="citizenship" required maxlength="255"><br>

    <label for="indigenousStatus">Indigenous Status:</label>
    <input type="text" id="indigenousStatus" name="indigenousStatus" required maxlength="255"><br>

    <label for="hoursAvailable">Hours Available:</label>
    <input type="number" id="hoursAvailable" name="hoursAvailable" required><br>

    <input type="submit" value="Submit">
  </form>
<?php
}
?>
