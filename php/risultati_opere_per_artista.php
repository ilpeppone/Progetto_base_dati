<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati Opere</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        body {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <button type="button" onclick="location.href = 'index.html'">Pagina iniziale</button>

    <?php
    include_once 'connessione.php';

    // recupera il nome dell'artista dalla form
    $nome_artista = $conn->real_escape_string($_POST['nome_artista']);

    $sql_opere = "
        SELECT o.*
        FROM OPERE o
        JOIN REALIZZA r ON o.id = r.id_opera AND o.accession_number = r.accession_number_opera
        WHERE r.id_artista = (SELECT id FROM ARTISTI WHERE nome LIKE '%$nome_artista%')
        ORDER BY o.media, o.anno
    ";
    
    $risultato_opere = $conn->query($sql_opere);
    
    if ($risultato_opere === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($risultato_opere->num_rows > 0) {
        echo "<h2>Opere di $nome_artista:</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Titolo</th><th>Data</th><th>Media</th><th>Anno</th><th>Anno di Acquisizione</th><th>Dimensioni</th><th>Inscription</th><th>Thumbnail Copyright</th><th>Thumbnail URL</th><th>Accession Number</th><th>Indirizzo URL</th></tr>";
    
        while ($riga = $risultato_opere->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $riga['id'] . "</td>";
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
            echo "<td><a href='" . $riga['indirizzo_url'] . "'>" . $riga['indirizzo_url'] . "</a></td>";
            echo "</tr>";
        }
    
        echo "</table>";
    } else {
        echo "<p>Nessuna opera trovata per l'artista $nome_artista.</p>";
    }
    ?>
</body>
</html>
