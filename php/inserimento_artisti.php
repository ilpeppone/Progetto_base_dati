<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="utf-8">
		        
		<title>Inserimento_artisti</title>
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

		<style>
			body {
				max-width: 1200px;
			}
		</style>
    </head>
</html>
<?php
include_once 'connessione.php';

// Percorso del file CSV degli artisti
$csv_file_artisti = "/home/peppe/Progetto_base_dati/artisti_puliti.csv"; // Inserisci il percorso corretto del tuo file CSV

// Apre il file CSV degli artisti
if (($handle = fopen($csv_file_artisti, "r")) !== FALSE) {
    fgetcsv($handle); // legge e scarta la prima riga (header)
    // Itera sulle righe del file CSV
    while (($data = fgetcsv($handle)) !== FALSE) {
        $id = $data[0];
        $name = $conn->real_escape_string($data[1]);
        $gender = $conn->real_escape_string($data[2]);
        $yearOfBirth = is_numeric($data[3]) ? $data[3] : 'NULL';
        $yearOfDeath = is_numeric($data[4]) ? $data[4] : 'NULL';
        $placeOfBirth = $conn->real_escape_string($data[5]);
        $placeOfDeath = $conn->real_escape_string($data[6]);
        $url = $conn->real_escape_string($data[7]);

        // qui abbiamo gestito i valori NULL delle stringhe
        $name = empty($name) ? 'NULL' : "'$name'";
        $gender = empty($gender) ? 'NULL' : "'$gender'";
        $placeOfBirth = empty($placeOfBirth) ? 'NULL' : "'$placeOfBirth'";
        $placeOfDeath = empty($placeOfDeath) ? 'NULL' : "'$placeOfDeath'";
        $url = empty($url) ? 'NULL' : "'$url'";

        // questa è la query per inserire gli artisti
        $sql = "INSERT INTO ARTISTI (id, nome, genere, anno_nascita, anno_morte, luogo_nascita, luogo_morte, indirizzo_url) 
                VALUES ($id, $name, $gender, $yearOfBirth, $yearOfDeath, $placeOfBirth, $placeOfDeath, $url)";

        // questa è la sua esecuzione
        if ($conn->query($sql) === TRUE) {
            echo "Record degli artisti inserito con successo<br>";
        } else {
            echo "Errore nell'inserimento del record degli artisti: " . $conn->error . "<br>";
        }
    }

    // Chiudi il file CSV degli artisti
    fclose($handle);
} else {
    echo "Errore nell'apertura del file CSV degli artisti";
}

// Chiudi la connessione al database
$conn->close();
?>
