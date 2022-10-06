<?php

//-----------------------------------------------------
// WARNING: this doesn't include sanitization
// and validation
//-----------------------------------------------------
$servername = "localhost";
$username = "charevel_enquete";
$password = "";
$dbname = "charevel_enquete";
$table = "TEST_DATA";
 
// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

if (isset($_POST['name'])) {
  $name = htmlspecialchars($_POST['name']);
  
  if ($_POST['gender']=="Severino"){
	$gender = "um Severino";
    $is_male = 1;
  } else{
    $gender = "uma Severina";
    $is_male = 0;
  }
  
  $query = "SELECT NAME FROM $table";
  $result = mysqli_query($conn, $query);
  if(empty($result)) {
    $query = "CREATE TABLE $table (
    	id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        gender INT,
        comment TEXT(255) NOT NULL,
        primary key (id)
        )";
    $result = mysqli_query($conn, $query);
  }
  
  $query = "INSERT INTO $table
    (NAME, GENDER, COMMENT)
    VALUES ('$name', $is_male, 'comment')";
  $result = mysqli_query($conn, $query);
  
  echo "Olá, $name.<br>";
  echo "Quer dizer que você acha que teremos $gender?<br>";
  echo "Agradecemos a sua participação.<br>";
  
  
  if ($result = mysqli_query($conn, "SELECT COUNT(*) AS 'count', SUM(GENDER) as 'males' FROM $table")) {
    $row = mysqli_fetch_array($result);
    $count = $row['count'];
    $males = $row['males'];
    $females = $count - $males;
  }
  mysqli_close($conn);

} else{
  echo 'Por favor, digite o seu nome antes de votar<br>';
}
?>

<div id="container" style="width: 100%; padding-top: 15px;">
  <script>
    anychart.onDocumentReady(function() {
      // the code to create a chart will be here
    });
    // create the chart
    var chart = anychart.bar();
    // add the data
    var data = [
      {x: "Menina", value: <?php echo $females ?>},
      {x: "Menino", value: <?php echo $males ?>},
    ];
    chart.data(data);
    // set the chart title
    chart.title("Resultado da enquete");

    // draw
    chart.container("container");
    chart.draw();
  </script>
</div>

