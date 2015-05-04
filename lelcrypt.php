<?php

    require_once 'aes/AESCryptFileLib.php';
    require_once 'aes/aes256/MCryptAES256Implementation.php';
    include 'config.php';
    include 'backend.php';

    $backend = new Backend();

    $catid = (int) $_POST['catid'];
    $name = $_POST['name'];
    $pass = $_POST["pass"];
    $upload = $_POST["upload"];
    $decrypt = $_POST["decrypt"];

    if(isset($decrypt)) {
        try {
            $sql = "SELECT * FROM `crypt` WHERE `id` = :id";
            $query = $backend->dbh->prepare($sql);
            $identifier = (int) $_POST["file"];
            $query->bindParam(":id", $identifier);
            $query->execute();

            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $original = $row['originalfile'];
                $encrypted = $row['encryptedfile'];
            }
                
            $cryptpass = md5($pass);
            $crypt = new MCryptAES256Implementation();
            $lib = new AESCryptFileLib($crypt);
            $lib->decryptFile($encrypted,$cryptpass,$original);
            
            if (file_exists($original)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($original));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($original));
                readfile($original);
                exit;
            }
        }
        catch (Exception $e) {
            header('Location: http://wesh.gift/crypt/?error');
        }
    }


    if(isset($upload)) {
        $dir = "uploads/";

        /*** cycle through all files in the directory ***/
        foreach (glob($dir."*") as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            /*** if file is 24 hours (86400 seconds) old then delete it ***/
            if ($ext != "aes") { 
                if (filemtime($file) < time() - 300) {
                    unlink($file);
                }
            }
        }


        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $uploadOk = 1;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 500000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } 
        else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $filename = $target_dir . $_FILES["file"]["name"];
                $rootfile = $filename;
                $cryptloc = $filename . ".aes";

                //MCrypt Initialization
                $crypt = new MCryptAES256Implementation();
                $lib = new AESCryptFileLib($crypt);


                $cryptpass = md5($pass);
                if(!isset($cryptpass)) {
            		die("No password specified.");
            	}
                
                echo ('<br/>root: ' . $rootfile . " - cryptloc: " . $cryptloc . " - pass: " . $cryptpass);

                $lib->encryptFile($rootfile, $cryptpass, $cryptloc);
                $id = rand(0,2147483647);

                try {
                    $sql = "INSERT INTO `" . DB_NAME . "`.`crypt` (`id` ,`originalfile` ,`encryptedfile`) VALUES (:id, :file, :crypt);";
                    $query = $backend->dbh->prepare($sql);
                    $query->bindParam(":id", $id);
                    $query->bindParam(":file", $rootfile);
                    $query->bindParam(":crypt", $cryptloc);
                    $query->execute();

                    echo $count;
                	echo "your id is " . $id;
                    unlink($rootfile);
   
                    header('Location: http://wesh.gift/crypt/?id=' . $id);
                    $backend->dbh = null;
                }
                catch (PDOException $e) {
                    echo $e->getMessage();
                }
        	} 
        }
    }
