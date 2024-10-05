<?php

// Set the path to the text file where you want to save the data
//$file_path = '/home/ggpi/Documents/Debjani/Farmer/';

// Set the path where you want to save the photo
$photo_path = '/home/ggpi/Documents/Debjani/Soil/';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $date_collected = $_POST['date_collected'];
    $survey_no = $_POST['survey_no'];
    $farm_size = $_POST['farm_size'];
    $file_name = $name . '.txt';
    // Save the data to a text file
    $data = "{$name}, {$email}, {$address}, {$location}, {$date_collected}, {$survey_no}, {$farm_size}\n";
    $file_path = '/home/ggpi/Documents/Debjani/Farmer/' . $file_name;
    file_put_contents($file_path, $data, FILE_APPEND);

    // Handle the file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Generate a unique filename for the photo
        $photo_name = "Sample.jpg";

        // Save the photo to the designated folder
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path . $photo_name);
    }

    // Display a confirmation message
    echo '<h1>Thanks for submitting your details!</h1>';
}
else {
    // If the form hasn't been submitted, display the form
    echo '<form method="post" action="" enctype="multipart/form-data">';
    echo 'Name: <input type="text" name="name"><br>';
    echo 'Email: <input type="email" name="email"><br>';
    echo 'Address: <input type="text" name="address"><br>';
    echo 'Location: <input type="text" name="location"><br>';
    echo 'Date of sample collection: <input type="date" name="date_collected"><br>';
    echo 'Survey No: <input type="text" name="survey_no"><br>';
    echo 'Farm Size: <input type="number" name="farm_size"><br>';
    echo 'Upload a JPEG photo: <input type="file" name="photo"><br>';
    echo '<input type="submit" value="Submit">';
    echo '</form>';
}

?>
