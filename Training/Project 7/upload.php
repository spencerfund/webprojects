<?php
include_once("database.php");

if (isset($_POST['submit'])) {

    $targetDir = "images/";
    $allowTypes = array('jpg','png','jpeg','gif');

    session_start();
    $username = $_SESSION["username"];

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);
    echo $_FILES;
    if (!empty($fileNames)) {
        foreach ($_FILES['files']['name'] as $key=>$val) {
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    $insertValuesSQL .= "('$fileName', '$username' ),";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key].' | ';
                }
            } else {
                $errorUpload .= $_FILES['files']['name'][$key].' | ';
            }
        }

        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            $insert = $db->query("INSERT INTO photos (FILE_NAME, USERNAME) VALUES $insertValuesSQL");
            if ($insert) {
                $statusMsg = "Files have been uploaded successfully. " . $errorMsg;
                // header("Location: home.php");
            } else {
                $statusMsg = "There was an error uploading your file.";
                // header("Location: home.php");
            }
        } else {
            $statusMsg = "Upload failed! " . $errorMsg;
            // header("Location: home.php");
        }
    } else {
        $statusMsg = "Please select a file to upload.";
        // header("Location: home.php");
    }
} else {
    echo "Random error";
}


$conn->close();
?>