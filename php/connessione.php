<?php
// Connessione al database
$conn = new mysqli("localhost", "peppe", "panecotto07@", "Musei_Tate");

// Verifica la connessione
if ($conn->connect_error) {
    echo "Connessione fallita: " . $conn->connect_error;
    exit;
} 
?>
