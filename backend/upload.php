<?php
session_start();

if(!isset($_SESSION['email'])) {
  // Redirect to the login
  header("Location: login.php");
  exit();
}

// CKEditor upload operation
if(isset($_FILES['upload']['name']))
{
  $file = $_FILES['upload']['tmp_name'];
  $file_name = $_FILES['upload']['name'];
  $file_name_array = explode(".", $file_name); 
  $extension = end($file_name_array);
  $new_image_name = rand() . '.' . $extension; 

  // Check if the file extension is allowed
  $allowed_extensions = array("jpg", "jpeg", "png", "gif");
  if (!in_array(strtolower($extension), $allowed_extensions)) {
    echo "<script type='text/javascript'>alert('Sorry, only JPG, JPEG, PNG, and GIF files are allowed. Close the image properties window and try again.');</script>";
  }
  // Check if the file size is within the limit (10MB)
  elseif($_FILES["upload"]["size"] > 10000000) {
    echo "<script type='text/javascript'>alert('Image is too large. Please upload an image under 10 MB. Close the image properties window and try again.');</script>";
  }
  else {
    move_uploaded_file($file, '../uploads/' . $new_image_name);
    $function_number = $_GET['CKEditorFuncNum'];
    $url = '../uploads/' . $new_image_name; // Set path
    $message = '';
    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";   
  } 
}
?>
