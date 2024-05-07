<?php
// Activer l'affichage des erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Connexion à MySQL
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'instagram';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Vérifier la connexion
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);}
//else
//die("connection done");


// Gestion de l'envoi des fichiers
if(isset($_POST['submit'])) {
    // Chemin temporaire du fichier téléchargé
    $file_tmp = $_FILES['file']['tmp_name'];
    // Nom du fichier téléchargé
    $file_name = $_FILES['file']['name'];
    // Type de fichier
    // $type = $_POST['type'];
    $type = $_FILES['file'] ['type'];
    // Dossier de destination permanent
    $destination_folder = 'uploads/';
    
    if ($file_tmp && $file_name && $type) {
    // Chemin de destination permanent pour le fichier
    $file_path = $destination_folder . $file_name;
    
    // Déplacer le fichier téléchargé vers le dossier permanent
    if (move_uploaded_file($file_tmp, $file_path)) {
    // Lire le contenu du fichier
    $file_content = file_get_contents($file_path);
    // Échapper le contenu pour la base de données
    $file_content = $conn->real_escape_string($file_content);
    
    // Insérer les informations dans la base de données
    $sql = "INSERT INTO `files`(`file_id`, `file_name`, `file_path`, `file`)VALUES ('2', '$file_name', '$file_path', '$file_content')";
    if ($conn->query($sql) === TRUE) {
    header("Location: home1.html");
    } 
    else 
    {
    echo "Error inserting into database: " . $conn->error;
    } }
    else
     {
    echo "Error moving uploaded file: " . $_FILES['file']['error'];
     } }
     else {
    echo "Please select a file and specify its type.";}
     }
    $conn-> close();
?>