<!DOCTYPE html>
<html>
  <head>
    <title> EVENT RESERVATION</title>
    <link href="event.css" rel="stylesheet">
    </script>
  </head>
  <body
    <?php
    // (A) PROCESS RESERVATION
    if (isset($_POST["date"])) {
      require "reservelib.php";
      if ($_RSV->save(
        $_POST["date"], $_POST["event"], $_POST["name"],
        $_POST["email"], $_POST["tel"], $_POST["notes"])) {
        echo "<div class='ok'>Your reservation is successfull.</div>";
      } else { echo "<div class='err'>".$_RSV->error."</div>"; }
    }
    ?>

    <!-- (B) RESERVATION FORM -->
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
      // @TODO - MINIMUM DATE (TODAY)
      // $mindate = date("Y-m-d", strtotime("+2 days"));
      $mindate = date("Y-m-d");
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

      <input type="submit" value="Submit" style="color: White"/>
    </form>
  </body>
</html>
