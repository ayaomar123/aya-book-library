<?php
include('templates/config/db_connect.php');

//write query for all books
$sql = 'SELECT * FROM books ORDER BY created_at';

// make query & get result
$result = mysqli_query($conn, $sql);

//fetch the result row as an array
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connections
mysqli_close($conn);



//print_r($books);
 ?>

<!DOCTYPE html>

<html>

  <?php include('templates/header.php'); ?>

  <div class="hero mb-5">
      
      <form action="search.php" method="get">
        <h5 class="blue-text">Are you looking for specific book?</h5>
        <input type="text" name="search"  placeholder="Type book name here ...">
      </form>
      </div>

  <div class="container">
    <div class="row">

      <?php foreach ($books as $book){ ?>
        <div class="col s6 md3">
          <div class="center card z-depth-0">
            <img src="img/book.jpg" alt="book img" class="book">
            <div class="center card-content center">
              <h6><?php echo htmlspecialchars($book['bname']); ?></h6>
              <div><ul>
                <?php foreach (explode(',', $book['author']) as $author): ?>
                  <li><?php echo htmlspecialchars($author); ?></li>
                <?php endforeach; ?>
              </ul>
              </div>
            </div>
            <div class="card-action center">
              <a class="center brand-text" href="details.php?id=<?php echo $book['id']?>">more info!</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>


  
  <?php include('templates/footer.php'); ?>

</html>
