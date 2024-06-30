<?php
    include_once 'connessione.php'; // Include la connessione al database

    // Recupero dei parametri di ricerca
    $nome_artista = isset($_GET['nome_artista']) ? $conn->real_escape_string($_GET['nome_artista']) : '';

    // Query per trovare l'artista
    $sql_artista = "SELECT id FROM ARTISTI WHERE nome LIKE '%$nome_artista%'";
    $result_artista = $conn->query($sql_artista);

    if ($result_artista === false || $result_artista->num_rows == 0) {
        echo "Artista non trovato.";
    } else {
        // Prendi il primo risultato trovato
        $row_artista = $result_artista->fetch_assoc();
        $id_artista = $row_artista['id'];

        // Query per trovare le opere dell'artista
        $sql_opere = "SELECT * FROM OPERE WHERE id_artista = $id_artista ORDER BY media, anno";
        $result_opere = $conn->query($sql_opere);

        if ($result_opere === false) {
            echo "Errore nella query: " . $conn->error;
        } elseif ($result_opere->num_rows > 0) {
            echo "<h2>Opere di $nome_artista:</h2>";
            echo "<table>";
            echo "<tr><th>Titolo</th><th>Data</th><th>Media</th><th>Anno</th><th>Anno di Acquisizione</th></tr>";

            while ($row = $result_opere->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['titolo'] . "</td>";
                echo "<td>" . $row['dataTesto'] . "</td>";
                echo "<td>" . $row['media'] . "</td>";
                echo "<td>" . $row['anno'] . "</td>";
                echo "<td>" . $row['anno_acquisizione'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nessuna opera trovata per l'artista $nome_artista.</p>";
        }
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
            margin: auto;
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
