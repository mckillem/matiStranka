<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 09/06/16
 * Time: 16:59
 */
class UploadManager
{
    public $target_dir = "pictures/";
    public $uploadOk = 1;

    public function targetFile()
    {
        return $this->target_dir . basename($_FILES["fileToUpload"]["name"]);
    }

    public function imageFileType()
    {
        return pathinfo($this->targetFile(),PATHINFO_EXTENSION);
    }

    /*
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    /**if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }*/
    // Check if $uploadOk is set to 0 by an error
    public function upload()
    {
        if ($this->uploadOk == 0) {
            throw new UserError("Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $this->targetFile())) {
                throw new UserError("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
            } else {
                throw new UserError("Sorry, there was an error uploading your file.");
            }
        }
    }
}