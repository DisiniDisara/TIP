<?php
function process_applicant_resume() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $target_dir = "cvs/"; // Specify the directory where the file will be uploaded
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Get the filename
    
      // Check if the file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        exit();
      }
    
      // Check file size - 10 MB maximum
      if ($_FILES["fileToUpload"]["size"] > 10000000) {
        echo "Sorry, your file is too large.";
        exit();
      }
    
      // Allow only certain file formats
      $allowed_types = array("jpg", "jpeg", "png", "gif");
      $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      if (!in_array($file_type, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
      }
    
      // Try to upload the file
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
}

?>
