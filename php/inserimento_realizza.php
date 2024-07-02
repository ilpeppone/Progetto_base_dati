<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">      
    <title>Inserimento_realizza</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        body {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <?php
    include_once 'connessione.php';

    // percorso del file CSV per REALIZZA
    $csv_file_realizza = "/home/peppe/Progetto_base_dati/realizza.csv";

    // disabilitiamo il controllo delle chiavi esterne per evitare errori di riferimento durante l'inserimento
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");

    // Apriamo il file CSV per REALIZZA
    if (($handle = fopen($csv_file_realizza, "r")) !== FALSE) {
        fgetcsv($handle); // leggiamo e scartiamo la prima riga (header)

        // iteriamo sulle righe del file CSV
        while (($data = fgetcsv($handle)) !== FALSE) {
            $artistId = $data[0];
            $artworkId = $data[1];
            $accession_number = $data[2];
            $artistRole = $conn->real_escape_string($data[3]);

            // costruiamo la query per l'inserimento dei valori in REALIZZA
            $sql = "INSERT INTO REALIZZA (id_artista, ruolo_artista, id_opera, accession_number_opera) 
                    VALUES ('$artistId', '$artistRole', '$artworkId', '$accession_number')";

            // eseguiamo l'inserimento dei dati
            if ($conn->query($sql) === TRUE) {
                echo "Record per REALIZZA inserito con successo<br>";
            } else {
                echo "Errore nell'inserimento del record per REALIZZA: " . $conn->error . "<br>";
            }
        }

        // chiudiamo il file CSV per REALIZZA
        fclose($handle);
    } else {
        echo "Errore nell'apertura del file CSV per REALIZZA";
    }

    // riabilitiamo il controllo delle chiavi esterne
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");

    // chiudiamo la connessione al database
    $conn->close();
    ?>
</body>
</html>
