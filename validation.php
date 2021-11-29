<?php

include 'upload_file.php';
$goodnews = "Schema is Valid!!!";
$uploadname = basename($_FILES['filename1']['name']);
$srt = ' on line- ';
$srt2 = ' column- ';

//$servername = 'localhost';
//$username = 'root';
//$password = '';
//$dbname = 'crud';
$servername = "database-1.c0dllanbljgc.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "12345678";
$dbname = "crud";
$port = "3306";

$conn = new mysqli($servername, $username,$password,$dbname,$port);

libxml_use_internal_errors(true);     
if ($xml->schemaValidate($schema)) {
    print "$par is valid.\n".'<br>';
    $sql = "INSERT INTO validation(xmlFileName, validationResult, 	validatinDate) VALUES ('$uploadname', '$goodnews', NOW())";
    if($conn->query($sql)){
        echo "Данные успешно добавлены".'<br>';
    } 
    $conn->close();
    return;
} else {
    print "$par is invalid.".'<br>';
    $errors = libxml_get_errors();
    foreach ($errors as $error) {  
        printf('XML error "%s" [%d] (Code %d) in %s on line %d column %d' . "\n",
            $error->message, $error->level, $error->code, $error->file,
            $error->line, $error->column);
    }        
    $line = mysqli_real_escape_string($conn, $error->line);
    $message = mysqli_real_escape_string($conn, $error->message);  
    $column = mysqli_real_escape_string($conn, $error->column); 
    
    $sql = "INSERT INTO validation(xmlFileName, validationResult, 	validatinDate) VALUES ('$uploadname','".$message."''$srt''".$line."''$srt2''".$column."', NOW())";
    if($conn->query($sql)){
        echo '<br>'."Данные успешно добавлены".'<br>';
    } 
    $conn->close();           

    libxml_clear_errors();
}
libxml_use_internal_errors(false); 

?>    
