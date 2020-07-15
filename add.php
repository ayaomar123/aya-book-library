<?php
include('templates/config/db_connect.php');
  $title = $email = $bname = '';
  $errors = array('email' => '', 'title'=>'', 'bname'=>''  );
  if(isset($_POST['submit'])){
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['bname']);
    //check Email
    if(empty($_POST['email'])){
      $errors['email'] = "An EMAil is required! <br/>";
    }else {
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email must be valid <br/>";
      }
        }
    //check title
    if(empty($_POST['title'])){
      $errors['title'] = "An title is required! <br/>";
    }else {
      //echo htmlspecialchars($_POST['title']); to prevent typing anyHTML tags or links
      $title = $_POST['title'];
      if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
        $errors['title'] =  'Title must be letters';
      }
    }
    //check ingredients
    if(empty($_POST['bname'])){
      $errors['bname'] = "An bname is required! <br/>";
    }else {
      //echo htmlspecialchars($_POST['bname']);
      $bname = $_POST['bname'];
      if(!preg_match('/^([a-zA-Z\s+)(,\s*[a-zA-Z\s]*)*$/',$bname)){
        $errors['bname'] = 'bname must be Acomma seprated list';
      }
    }

    if(array_filter($errors)){
      //echo 'errors in the form';
    }else {


      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $bname = mysqli_real_escape_string($conn, $_POST['bname']);

      //creat sql
      $sql = "INSERT INTO books(bname,email,author) VALUES('$title', '$email', '$bname' ) ";

      //save to db & check
      if(mysqli_query($conn, $sql)){
         //success
         header('location: index.php');
      }else{
        //errors
        echo 'query error:' . mysqli_error($conn);
      }
      //echo 'form is valid';
    }

  } //end of post check

 ?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

  <?php include('templates/header.php'); ?>
  <section class="container gray-text">
    <h4 class="center">Add A Book</h4>
    <form class="white" action="add.php" method="POST">
       <label for="">Book Title:</label>
      <input type="text" name="title" >
      <div class="red-text">
        <?php echo $errors['title']; ?>
      </div>
      <label for=""> Author/s:</label>
      <input type="text" name="bname" >
      <div class="red-text">
        <?php echo $errors['bname']; ?>
      </div>
      <label for="">Author Email:</label>
      <input type="text" name="email" >
      <div class="red-text">
        <?php echo $errors['email']; ?>
      </div>
     
      
      
      <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0 ">
      </div>
    </form>
    <br> <br>
  </section>
  <section >
    <div>
     <img class="img" src="img/book.jpg" > 
    </div>
     <div>
     <img class="img" src="img/book2.jpg"> 
    </div>


  </section>

  <?php include('templates/footer.php'); ?>


</html>
