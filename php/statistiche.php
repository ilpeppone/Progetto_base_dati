<?php
include_once 'connessione.php'; 
$statistica = $_POST['statistica'];
if ($statistica == 'opere_anno') {
    $anno = isset($_POST['anno']) ? intval($_POST['anno']) : 0;
    $sql = "SELECT COUNT(*) AS numero_opere FROM OPERE WHERE anno = $anno";
    $risultato = $conn->query($sql);
    if ($risultato === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($risultato->num_rows > 0) {
        $riga = $risultato->fetch_assoc();
        echo "<h2>Risultati della ricerca:</h2>";
        echo "<p>Numero di opere realizzate nell'anno $anno: " . $riga['numero_opere'] . "</p>";
    } else {
        echo "<p>Nessuna opera trovata per l'anno $anno.</p>";
    }
} elseif ($statistica == 'artisti_nazione') {
    $nazione = $conn->real_escape_string($_POST['nazione']);
    $sql = "SELECT COUNT(*) AS numero_artisti FROM ARTISTI WHERE luogo_nascita = '$nazione' OR luogo_morte = '$nazione'";
    $risultato = $conn->query($sql);

    if ($risultato === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($risultato->num_rows > 0) {
        $riga = $risultato->fetch_assoc();
        echo "<h2>Risultati della ricerca:</h2>";
        echo "<p>Numero di artisti nati e/o morti in $nazione: " . $riga['numero_artisti'] . "</p>";
    } else {
        echo "<p>Nessun artista trovato per la nazione $nazione.</p>";
    }
} elseif ($statistica == 'opere_artista') {
    $artista_id = isset($_POST['artista_id']) ? intval($_POST['artista_id']) : 0;
    $sql = "SELECT COUNT(*) AS numero_opere FROM OPERE WHERE id_artista = $artista_id";
    $risultato = $conn->query($sql);

    if ($risultato === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($risultato->num_rows > 0) {
        $riga = $risultato->fetch_assoc();
        echo "<h2>Risultati della ricerca:</h2>";
        echo "<p>Numero di opere realizzate dall'artista con ID $artista_id: " . $riga['numero_opere'] . "</p>";
    } else {
        echo "<p>Nessuna opera trovata per l'artista con ID $artista_id.</p>";
    }
} elseif ($statistica == 'opere_media') {
    $media = isset($_POST['media']) ? $conn->real_escape_string($_POST['media']) : '';
    $sql = "SELECT COUNT(*) AS numero_opere FROM OPERE WHERE media LIKE '%$media%'";
    $risultato = $conn->query($sql);
    if ($risultato === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($risultato->num_rows > 0) {
        $riga = $risultato->fetch_assoc();
        echo "<h2>Risultati della ricerca:</h2>";
        echo "<p>Numero di opere per il media '$media': " . $riga['numero_opere'] . "</p>";
    } else {
        echo "<p>Nessuna opera trovata per il media '$media'.</p>";
    }
} elseif ($statistica == 'opere_acquisizioni') {
    $anno_inizio = isset($_POST['anno_inizio']) ? intval($_POST['anno_inizio']) : 0;
    $anno_fine = isset($_POST['anno_fine']) ? intval($_POST['anno_fine']) : 0;
    if ($anno_inizio > 0 && $anno_fine > 0) {
        $sql = "SELECT COUNT(*) AS numero_opere FROM OPERE WHERE anno_acquisizione BETWEEN $anno_inizio AND $anno_fine";
        $risultato = $conn->query($sql);
        if ($risultato === false) {
            echo "Errore nella query: " . $conn->error;
        } elseif ($risultato->num_rows > 0) {
            $riga = $risultato->fetch_assoc();
            echo "<h2>Risultati della ricerca:</h2>";
            echo "<p>Numero di opere acquisite tra gli anni $anno_inizio e $anno_fine: " . $riga['numero_opere'] . "</p>";
        } else {
            echo "<p>Nessuna opera acquisita tra gli anni $anno_inizio e $anno_fine.</p>";
        }
    }
} elseif ($statistica == 'nazione_artisti_vivi') {
    // statistica per trovare la nazione con più artisti in vita
    $sql = "SELECT luogo_nascita, COUNT(*) AS num_artisti_vivi
            FROM ARTISTI
            WHERE luogo_nascita IS NOT NULL AND anno_morte IS NULL
            GROUP BY luogo_nascita
            ORDER BY num_artisti_vivi DESC
            LIMIT 1";
    $risultato = $conn->query($sql);
    if ($risultato === false) {
        echo "Errore nella query: " . $conn->error;
    } elseif ($risultato->num_rows > 0) {
        echo "<h2>Risultati della ricerca:</h2>";
        echo "<table>";
        echo "<tr><th>Nazione di Nascita</th><th>Numero di Artisti Ancora in Vita</th></tr>";
        while ($riga = $risultato->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $riga['luogo_nascita'] . "</td>";
            echo "<td>" . $riga['num_artisti_vivi'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessuna nazione trovata con artisti ancora in vita.</p>";
    }
} else {
    echo "<p>Statistica non valida.</p>";
} 
$conn->close();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati statistiche</title>
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
