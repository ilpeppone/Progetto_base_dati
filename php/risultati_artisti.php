<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">     
		<title>Risultati artisti</title>
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
        include_once 'connessione.php'; //includiamo il php per la connessione al database 
        // recuperiamo i parametri
        $id = isset($_POST['id']) && $_POST['id'] ? $_POST['id'] : null;
        // isset($_POST['id']) verifica se $_POST['id'] è impostato, cioè se esiste e non è null.
        // $_POST['id'] è valutato come vero se il suo valore non è vuoto, null 
        $nome = isset($_POST['nome']) ? $conn->real_escape_string($_POST['nome']) : '';
        $genere = isset($_POST['genere']) ? $conn->real_escape_string($_POST['genere']) : '';
        $luogo_nascita = isset($_POST['luogo_nascita']) ? $conn->real_escape_string($_POST['luogo_nascita']) : '';
        $luogo_morte = isset($_POST['luogo_morte']) ? $conn->real_escape_string($_POST['luogo_morte']) : '';
        $anno_nascita = isset($_POST['anno_nascita']) && $_POST['anno_nascita']? $_POST['anno_nascita'] : null;
        $anno_morte = isset($_POST['anno_morte']) && $_POST['anno_morte']  ? $_POST['anno_morte'] : null;
        $indirizzo_url = isset($_POST['indirizzo_url']) ? $conn->real_escape_string($_POST['indirizzo_url']) : '';
            // costruzione della query 
            $sql = "SELECT * FROM ARTISTI WHERE 1=1";
            // se invece abbiamo specificato dei parametri procediamo ad aggiungere condizioni alla query
            if ($id !== null) {
                $sql .= " AND id = $id";
            }
            if ($nome !== '') {
                $sql .= " AND nome LIKE '%$nome%'";
            }
            if ($genere !== '') {
                $sql .= " AND genere LIKE '%$genere%'";
            }
            if ($luogo_nascita !== '') {
                $sql .= " AND luogo_nascita LIKE '%$luogo_nascita%'";
            }
            if ($luogo_morte !== '') {
                $sql .= " AND luogo_morte LIKE '%$luogo_morte%'";
            }
            if ($anno_nascita !== null) {
                $sql .= " AND anno_nascita = $anno_nascita";
            }
            if ($anno_morte !== null) {
                $sql .= " AND anno_morte = $anno_morte";
            }
            if ($indirizzo_url !== '') {
                $sql .= " AND indirizzo_url LIKE '%$indirizzo_url%'";
            }
        //eseguiamo la query
        $risultato = $conn->query($sql);
        if ($risultato === false) {
            echo "Errore nella query: " . $conn->error;
        } elseif ($risultato->num_rows > 0) {
        // debug query echo "Query SQL: " . $sql . "<br>";
            echo "<h2>Risultati della ricerca:</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Genere</th><th>Anno di Nascita</th><th>Anno di Morte</th><th>Luogo di Nascita</th><th>Luogo di Morte</th><th>URL</th></tr>";
            while ($riga = $risultato->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $riga['id'] . "</td>";
                echo "<td>" . $riga['nome'] . "</td>";
                echo "<td>" . $riga['genere'] . "</td>";
                echo "<td>" . $riga['anno_nascita'] . "</td>";
                echo "<td>" . $riga['anno_morte'] . "</td>";
                echo "<td>" . $riga['luogo_nascita'] . "</td>";
                echo "<td>" . $riga['luogo_morte'] . "</td>";
                echo "<td><a href='" . $riga['indirizzo_url'] . "'>" . $riga['indirizzo_url'] . "</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nessun risultato trovato.</p>";
        }
        //chiudiamo la connessione al database
        $conn->close();
        ?>
