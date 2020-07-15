<?php
include('templates/config/db_connect.php');

if(isset($_POST['delete'])){

  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
  $sql = "DELETE FROM books WHERE id = $id_to_delete";

  if(mysqli_query($conn, $sql)){
    //success
    header('location: index.php');
  }else {
    // fail code...
    echo "query error" . mysql_error($conn);
  }
}



//check get request id parameter
if(isset($_GET['id'])){

  $id = mysqli_real_escape_string($conn, $_GET['id']);

  //make sql
  $sql = "SELECT * FROM books WHERE id=$id";

  //gets query results
  $result = mysqli_query($conn, $sql);

  //fetch results in array.
  $book = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($conn);

  //print_r($book);

}
 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">

 <?php include('templates/header.php'); ?>
 <h4 class="center">The Details of <?php echo htmlspecialchars($book['bname']); ?></h4>

 <div class="center container ">
  <img src="img/book.jpg" style="height: 400px;">
   <?php if($book):?>
    <h5 class="pink-text">Book Name: </h5>
     <h6><?php echo htmlspecialchars($book['bname']);  ?></h6>
     <h5 class="pink-text">created by:</h5>
     <p><?php echo htmlspecialchars($book['email']); ?></p>
     <h5 class="pink-text">created_at:</h5>
     <p><?php echo date($book['created_at']); ?></p>
     <h5 class="pink-text">author/s:</h5>
     <p><?php echo htmlspecialchars($book['author']); ?></p>

     <!-- DELETE FORM -->
     <form class="" action="details.php" method="POST">
       <input type="hidden" name="id_to_delete" value="<?php echo $book['id']; ?>">
       <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
     </form>

   <?php else: ?>
     <h5>No Such book exists!</h5>
   <?php endif; ?>
 </div>
 <?php include('templates/footer.php'); ?>

 </html>
