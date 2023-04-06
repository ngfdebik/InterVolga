<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="csv" value="" />
<input type="submit" name="submit" value="Save" /></form>

<?php
if (isset($_FILES['csv'])) {
    if ($_FILES['csv']['error'] > 0) {
        echo "Return Code: " . $_FILES['csv']['error'];

    }
    else {
        $tmpName = $_FILES['csv']['tmp_name'];
        $csvAsArray = array_map('str_getcsv', file($tmpName));
        $numberName = countFiles() + 1;
        foreach($csvAsArray as $line){
            $extension = '.'.pathinfo($line[0], PATHINFO_EXTENSION);
            $fp = fopen('./upload/' . $numberName . $extension, 'w');
            fwrite($fp, $line[1]);
            fclose($fp);
            $numberName++;
        }
    }
}

function countFiles(){
    $dir = opendir('./upload');
    $count = 0;
    while($file = readdir($dir)){
        if($file == '.' || $file == '..' || is_dir('./upload' . $file)){
            continue;
        }
        $count++;
    }
    closedir($dir);
    return $count;
}

?>