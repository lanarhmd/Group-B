<?php
class Reservation {
//  (NURHARITH AKMA BT HARISA 1910110)
  //CONNECT TO DATABASE
  private $pdo; // PDO object
  private $stmt; // SQL statement
  public $error; // Error message
  function __construct() {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }

//(NUR AFIQAH BT MOHD ROSLI 1910100)
  // CLOSE DATABASE CONNECTION
  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
  }

  //SAVE RESERVATION
  function save ($date, $event, $name, $email, $tel, $notes="") {

    //DATABASE ENTRY
    try {
      $this->stmt = $this->pdo->prepare(
        "INSERT INTO `reservation` (`res_date`, `res_event`, `res_name`, `res_email`, `res_tel`, `res_notes`) VALUES (?,?,?,?,?,?)"
      );
      $this->stmt->execute([$date, $event, $name, $email, $tel, $notes]);
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }


//(JULYANA BINTI RAHMAD 1912068)
    // EMAIL
    $subject = "Reservation Received";
    $message = "Thank you, we have received your request and will process it shortly.";
    @mail($email, $subject, $message);
    return true;
  }

  //GET RESERVATIONS
  function getDay ($day="") {
    // (D1) DEFAULT TO TODAY
    if ($day=="") { $day = date("Y-m-d"); }

//(NUR AMELIENE LEE 1912216)
    //GET ENTRIES
    $this->stmt = $this->pdo->prepare(
      "SELECT * FROM `reservations` WHERE `res_date`=?"
    );
    $this->stmt->execute([$day]);
    return $this->stmt->fetchAll();
  }
}

// DATABASE SETTINGS 
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

//  NEW RESERVATION OBJECT
$_RSV = new Reservation();
