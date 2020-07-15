
 <?php include('templates/header.php'); ?>
 <?php include('templates/config/db_connect.php');

$book = $_GET['search'];
echo $book;

?>

<main>
 <div class="container py-5">
  <h2 class="center mb-5 blue-text">
    You Searched About: <?php echo $book ?>
  </h2>
  </div>

 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aya_books";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM books  WHERE  bname  LIKE '%$book%' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Book Name</th><th>Author</th><th>Email</th><th>Created_at</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["bname"]."</td><td>".$row["author"]."</td><td>".$row["email"]."</td><td>".$row["created_at"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>

<?php include('templates/footer.php'); ?>
</html>