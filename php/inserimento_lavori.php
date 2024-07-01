<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inserimento_lavori</title>
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
        // percorso del file CSV dei lavori
        $csv_file_lavori = "/home/peppe/Progetto_base_dati/lavori_puliti.csv"; 
        // disabilitiamo il controllo delle chiavi esterne
        $conn->query("SET FOREIGN_KEY_CHECKS = 0");
        // apriamo il file CSV dei lavori
        if (($handle = fopen($csv_file_lavori, "r")) !== FALSE) {
            fgetcsv($handle); // leggiamo e scartiamo la prima riga (header)
            // iteriamo sulle righe del file CSV
            while (($data = fgetcsv($handle)) !== FALSE) {
                $id = $data[0];
                $accession_number = $conn->real_escape_string($data[1]);//usiamo real_escape_string per gestire i caratteri speciali
                $artistRole = $conn->real_escape_string($data[2]);
                $artistId = is_numeric($data[3]) ? $data[3] : 'NULL';
                $title = $conn->real_escape_string($data[4]);
                $dateText = $conn->real_escape_string($data[5]);
                $medium = $conn->real_escape_string($data[6]);
                $creditLine = $conn->real_escape_string($data[7]);
                $year = is_numeric($data[8]) ? $data[8] : 'NULL';
                $acquisitionYear = is_numeric($data[9]) ? $data[9] : 'NULL';
                $dimensions = $conn->real_escape_string($data[10]);
                $inscription = $conn->real_escape_string($data[11]);
                $thumbnailCopyright = $conn->real_escape_string($data[12]);
                $thumbnailUrl = $conn->real_escape_string($data[13]);
                $url = $conn->real_escape_string($data[14]);
                // gestiamo i valori NULL per le stringhe
                $accession_number = empty($accession_number) ? 'NULL' : "'$accession_number'";
                $artistRole = empty($artistRole) ? 'NULL' : "'$artistRole'";
                $title = empty($title) ? 'NULL' : "'$title'";
                $dateText = empty($dateText) ? 'NULL' : "'$dateText'";
                $medium = empty($medium) ? 'NULL' : "'$medium'";
                $creditLine = empty($creditLine) ? 'NULL' : "'$creditLine'";
                $dimensions = empty($dimensions) ? 'NULL' : "'$dimensions'";
                $inscription = empty($inscription) ? 'NULL' : "'$inscription'";
                $thumbnailCopyright = empty($thumbnailCopyright) ? 'NULL' : "'$thumbnailCopyright'";
                $thumbnailUrl = empty($thumbnailUrl) ? 'NULL' : "'$thumbnailUrl'";
                $url = empty($url) ? 'NULL' : "'$url'";
                // scriviamo la query per inserire i valori
                $sql = "INSERT INTO OPERE (id, accession_number, ruoloartista, id_artista, titolo, dataTesto, media, crediti, anno, anno_acquisizione, dimensioni, inscription, thumbnailCopyright, thumbnailUrl, indirizzo_url) 
                        VALUES ($id, $accession_number, $artistRole, $artistId, $title, $dateText, $medium, $creditLine, $year, $acquisitionYear, $dimensions, $inscription, $thumbnailCopyright, $thumbnailUrl, $url)";
                //eseguiamo l'inserimento con la query
                if ($conn->query($sql) === TRUE) {
                    echo "Record dei lavori inserito con successo<br>";
                } else {
                    echo "Errore nell'inserimento del record dei lavori: " . $conn->error . "<br>";
                }
            }
            // chiudiamo il file CSV dei lavori
            fclose($handle);
        } else {
            echo "Errore nell'apertura del file CSV dei lavori";
        }
        // riabilitiamo il controllo delle chiavi esterne
        $conn->query("SET FOREIGN_KEY_CHECKS = 1");
        // chiudiamo la connessione al database
        $conn->close();
    ?>
</body>
</html>
