<!--(MASTURA BT MOHAMAD RIZAL 1918378)-->

<!DOCTYPE html>
<html>
  <head>
    <title> EVENT RESERVATION</title>
  <style media="screen">

  * {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    box-sizing: border-box;
  }

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-ser if;
      background-image: url(bg1.jpg);
  }
  .banner {
    width: 100%;
    height: 100vh;
    background-size: cover;
    background-position: center;
    background-color: beige;
  }

  .navbar {
    width: 85%;
    margin: auto;
    padding: 35px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .logo {
    width: 120px;
    cursor: pointer;
  }

  .navbar ul li {
    list-style: none;
    display: inline-block;
    margin: 0 20px;
    position: relative;
  }

  .navbar ul li a {
    text-decoration: none;
    color: Black;
    text-transform: uppercase;
  }

  .navbar ul li::after {
    content: '';
    height: 3px;
    width: 0;
    background: #009688;
    position: absolute;
    left: 0;
    bottom: -10px;
    transition: 0.5s;
  }

  .navbar ul li:hover::after {
    width: 100%;
  }
  h1{
    padding-bottom: 30px;
  }
  #resForm {
    max-width: 500px;
    background: #D3E4CD;
    border: 1px solid #aaa;
    padding: 30px;


  }
  #resForm label, #resForm input, #resForm select {
    display: block;
    box-sizing: border-box;
    width: 100%;
    padding: 5px;
    margin: 5px 0;
  }
  #resForm input[type="submit"] {
    background: #ffa07a;
    border: 0;
    padding: 15px 0;
    margin-top: 15px;
    cursor: pointer;
    font-weight: bold;
  }

  #ok p{
  font-size: 25px;
  color: #3498DB;
  font-weight: bold;
   width: 50%;
  margin-bottom: 10px;
  }

  #err p{
    font-size: 25px;
    font-weight: bold;
    color:black;
    width: 50%;
    margin-bottom: 10px;
  }

  </style>
  </head>
  <body
  <div class="banner">
        <div class="navbar">
            <img src="logorv.png" class="logo" alt="logo">
              <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="About.html">About Us</a></li>
              </ul>
  </div>


    <?php

    if (isset($_POST["date"])) {//the method is used to GET or POST the information as entered in the form.
      require "reservelib.php"; //When the form is submitted, we use the library to  save  the  reservation process
      if ($_RSV->save(
        $_POST["date"], $_POST["event"], $_POST["name"],
        $_POST["email"], $_POST["tel"], $_POST["notes"])) {
        echo // if all of this input already filled in so the output will be below
          "<div id='ok'> <p> Your reservation is successful.<br> We already sent a confirmation detail to your email.</p></div>";
      } else {// if they choose same date that already reserve
        echo "<div id='err'><p> We are so sorry. The date is already fully booked.</p> </div>"; }
    }
    ?>

    <!--RESERVATION FORM -->
    <h1 style="text-align:center;"> RESERVATION FORM </h1>
    <form id="resForm" method="post" target="_self" style="margin:auto">
      <label for="res_name">Name</label>
      <input type="text" required name="name" placeholder="Your Name"/>

      <label for="res_email">Email</label>
      <input type="email" required name="email" placeholder="Your email"/>

      <label for="res_tel">Telephone Number</label>
      <input type="text" required name="tel" placeholder="Your phone No"/>

      <label for="res_notes">Notes</label>
      <input type="text" name="notes" placeholder="If any"/>

      <?php
      // Declare MINIMUM DATE  before we can make a reservation
      //USer need to make reservation 3 day before the event
      $mindate = date("Y-m-d", strtotime("+3 days"));
      ?>

      <label>Reservation Date</label>
      <input type="date" required id="res_date" name="date"
             min="<?=$mindate?>">

      <label>Type of Event</label>
      <select name="event">
        <option value="Wedding">Wedding</option>
        <option value="Birthday">Birthday Party</option>
        <option value="Reunion">Reunion Party</option>
        <option value="Seminar">Seminar</option>
        <option value="Meeting">Meeting</option>
        <option value="Corporate">Corporate Event</option>
        <option value="Others">Others</option>
      </select>

      <input type="submit" value="Submit" style="color: Black"/>
    </form>
  </body>
</html>
