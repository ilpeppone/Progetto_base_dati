<?php
    include_once 'connessione.php'; // includiamo la connessione al database
    // recuperiamo i parametri di ricerca
    $nome_artista = $conn->real_escape_string($_POST['nome_artista']);
    // query per trovare l'artista
    $sql_artista = "SELECT id FROM ARTISTI WHERE nome LIKE '%$nome_artista%'";
    $risultato_artista = $conn->query($sql_artista);
    if ($risultato_artista === false || $risultato_artista->num_rows == 0) {
        echo "Artista non trovato.";
    } else {
        $riga_artista = $risultato_artista->fetch_assoc();
        $id_artista = $riga_artista['id'];
        // query per trovare le opere per l'artista
        $sql_opere = "SELECT * FROM OPERE WHERE id_artista = $id_artista ORDER BY media, anno";
        $risultato_opere = $conn->query($sql_opere);
        // se non ci sono opere stampo "nessun opera per l'artista", altrimenti se ce n'è almeno una stampo la tabella
        if ($risultato_opere === false) {
            echo "Errore nella query: " . $conn->error;
        } elseif ($risultato_opere->num_rows > 0) {
            echo "<h2>Opere di $nome_artista:</h2>";
            echo "<table>";
            echo "<tr><th>Titolo</th><th>Data</th><th>Media</th><th>Anno</th><th>Anno di Acquisizione</th><th>Dimensioni</th><th>Inscription</th><th>Thumbnail Copyright</th><th>Thumbnail URL</th><th>Accession Number</th><th>Ruolo Artista</th><th>Indirizzo URL</th></tr>";
            // fetch_assoc() estrae ogni riga dei risultati della query come un array associativo, che può poi essere utilizzato per visualizzare i dati
            while ($riga = $risultato_opere->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $riga['titolo'] . "</td>";
                echo "<td>" . $riga['dataTesto'] . "</td>";
                echo "<td>" . $riga['media'] . "</td>";
                echo "<td>" . $riga['anno'] . "</td>";
                echo "<td>" . $riga['anno_acquisizione'] . "</td>";
                echo "<td>" . $riga['dimensioni'] . "</td>";
                echo "<td>" . $riga['inscription'] . "</td>";
                echo "<td>" . $riga['thumbnailCopyright'] . "</td>";
                echo "<td><a href='" . $riga['thumbnailUrl'] . "'>" . $riga['thumbnailUrl'] . "</a></td>";
                echo "<td>" . $riga['accession_number'] . "</td>";
                echo "<td>" . $riga['ruoloartista'] . "</td>";
                echo "<td><a href='" . $riga['indirizzo_url'] . "'>" . $riga['indirizzo_url'] . "</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nessuna opera trovata per l'artista $nome_artista.</p>";
        }
    }
    //chiudiamo la connessione al database
    $conn->close();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati Opere</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        body {
            max-width: 1200px;
            margin: auto;
        }
    </style>
</head>
<body>
    <button type="button" onclick="location.href = 'index.html' ">Pagina iniziale</button>
</body>
</html>
