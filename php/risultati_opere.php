<?php
    include_once 'connessione.php'; // Include la connessione al database

    // Recupero dei parametri di ricerca
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
    $id_artista = isset($_POST['id_artista']) && $_POST['id_artista'] ? intval($_POST['id_artista']) : null;
    $ruoloartista = isset($_POST['ruoloartista']) ? $conn->real_escape_string($_POST['ruoloartista']) : '';

    // costruzione della query 
    $sql = "SELECT * FROM OPERE WHERE 1=1";

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
    if ($id_artista !== null) {
        $sql .= " AND id_artista = $id_artista";
    }
    if ($ruoloartista !== '') {
        $sql .= " AND ruoloartista LIKE '%$ruoloartista%'";
    }

    //esecuzione della query
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        echo "<h2>Risultati della ricerca:</h2>";
        echo "<table>";
        echo "<tr><th>Titolo</th><th>Data</th><th>Media</th><th>Anno</th><th>Anno di Acquisizione</th><th>Dimensioni</th><th>Crediti</th><th>Indirizzo URL</th><th>Thumbnail URL</th><th>Thumbnail Copyright</th><th>Accession Number</th><th>ID Artista</th><th>Ruolo Artista</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['titolo'] . "</td>";
            echo "<td>" . $row['dataTesto'] . "</td>";
            echo "<td>" . $row['media'] . "</td>";
            echo "<td>" . $row['anno'] . "</td>";
            echo "<td>" . $row['anno_acquisizione'] . "</td>";
            echo "<td>" . $row['dimensioni'] . "</td>";
            echo "<td>" . $row['crediti'] . "</td>";
            echo "<td><a href='" . $row['indirizzo_url'] . "'>" . $row['indirizzo_url'] . "</a></td>";
            echo "<td><a href='" . $row['thumbnailUrl'] . "'>" . $row['thumbnailUrl'] . "</a></td>";
            echo "<td>" . $row['thumbnailCopyright'] . "</td>";
            echo "<td>" . $row['accession_number'] . "</td>";
            echo "<td>" . $row['id_artista'] . "</td>";
            echo "<td>" . $row['ruoloartista'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessuna opera trovata.</p>";
    }

    // Chiudi la connessione al database
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
        }
    </style>
    <script>
        function redirectTo(page) {
            location.href = page;
        }
    </script>
</head>
<body>
    <button type="button" onclick="redirectTo('index.html')">Pagina iniziale</button>
</body>
</html>
