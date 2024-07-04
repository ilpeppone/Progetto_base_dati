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
    <button type="button" onclick="location.href = 'index.html' ">Pagina iniziale</button>
</body>
</html>
<?php
    include_once 'connessione.php'; // include il php per la connessione
    // recupero dei parametri di ricerca
    $id = isset($_POST['id']) && $_POST['id'] ? $_POST['id'] : null;
    // isset($_POST['id']) verifica se $_POST['id'] è impostato, cioè se esiste e non è null.
    // $_POST['id'] è valutato come vero se il suo valore non è vuoto, null.
    $titolo = isset($_POST['titolo']) ? $conn->real_escape_string($_POST['titolo']) : '';
    $dataTesto = isset($_POST['dataTesto']) ? $conn->real_escape_string($_POST['dataTesto']) : '';
    $media = isset($_POST['media']) ? $conn->real_escape_string($_POST['media']) : '';
    $anno = isset($_POST['anno']) && $_POST['anno'] ? intval($_POST['anno']) : null;
    $anno_acquisizione = isset($_POST['anno_acquisizione']) && $_POST['anno_acquisizione'] ? intval($_POST['anno_acquisizione']) : null;
    $dimensioni = isset($_POST['dimensioni']) ? $conn->real_escape_string($_POST['dimensioni']) : '';
    $crediti = isset($_POST['crediti']) ? $conn->real_escape_string($_POST['crediti']) : '';
    $indirizzo_url = isset($_POST['indirizzo_url']) ? $conn->real_escape_string($_POST['indirizzo_url']) : '';
    $thumbnailUrl = isset($_POST['thumbnailUrl']) ? $conn->real_escape_string($_POST['thumbnailUrl']) : '';
    $thumbnailCopyright = isset($_POST['thumbnailCopyright']) ? $conn->real_escape_string($_POST['thumbnailCopyright']) : '';
    $accession_number = isset($_POST['accession_number']) ? $conn->real_escape_string($_POST['accession_number']) : '';
    // costruzione della query 
    $sql = "SELECT * FROM OPERE WHERE 1=1";
    if ($id !== null) {
        $sql .= " AND id = $id";
    }
    if ($titolo !== '') {
        $sql .= " AND titolo LIKE '%$titolo%'";
    }
    if ($dataTesto !== '') {
        $sql .= " AND dataTesto LIKE '%$dataTesto%'";
    }
    if ($media !== '') {
        $sql .= " AND media LIKE '%$media%'";
    }
    if ($anno !== null) {
        $sql .= " AND anno = $anno";
    }
    if ($anno_acquisizione !== null) {
        $sql .= " AND anno_acquisizione = $anno_acquisizione";
    }
    if ($dimensioni !== '') {
        $sql .= " AND dimensioni LIKE '%$dimensioni%'";
    }
    if ($crediti !== '') {
        $sql .= " AND crediti LIKE '%$crediti%'";
    }
    if ($indirizzo_url !== '') {
        $sql .= " AND indirizzo_url LIKE '%$indirizzo_url%'";
    }
    if ($thumbnailUrl !== '') {
        $sql .= " AND thumbnailUrl LIKE '%$thumbnailUrl%'";
    }
    if ($thumbnailCopyright !== '') {
        $sql .= " AND thumbnailCopyright LIKE '%$thumbnailCopyright%'";
    }
    if ($accession_number !== '') {
        $sql .= " AND accession_number LIKE '%$accession_number%'";
    }
    //esecuzione della query
    $risultato = $conn->query($sql);
    if ($risultato === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($risultato->num_rows > 0) {
        echo "<h2>Risultati della ricerca:</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Titolo</th><th>Data</th><th>Media</th><th>Anno</th><th>Anno di Acquisizione</th><th>Dimensioni</th><th>Crediti</th><th>Indirizzo URL</th><th>Thumbnail URL</th><th>Thumbnail Copyright</th><th>Accession Number</th></tr>";
        while ($riga = $risultato->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $riga['id'] . "</td>";
            echo "<td>" . $riga['titolo'] . "</td>";
            echo "<td>" . $riga['dataTesto'] . "</td>";
            echo "<td>" . $riga['media'] . "</td>";
            echo "<td>" . $riga['anno'] . "</td>";
            echo "<td>" . $riga['anno_acquisizione'] . "</td>";
            echo "<td>" . $riga['dimensioni'] . "</td>";
            echo "<td>" . $riga['crediti'] . "</td>";
            echo "<td><a href='" . $riga['indirizzo_url'] . "'>" . $riga['indirizzo_url'] . "</a></td>";
            echo "<td><a href='" . $riga['thumbnailUrl'] . "'>" . $riga['thumbnailUrl'] . "</a></td>";
            echo "<td>" . $riga['thumbnailCopyright'] . "</td>";
            echo "<td>" . $riga['accession_number'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessuna opera trovata.</p>";
    }
    // chiudiamo la connessione al database
    $conn->close();
?>
