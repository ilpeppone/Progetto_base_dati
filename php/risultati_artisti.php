<?php
        include_once 'connessione.php'; //includiamo il php per la connessione al database 
        $sql = "SELECT * FROM ARTISTI WHERE 1=1";
        // verifichiamo se le variabili sono nulle 
        if ($id === null &&
            $nome === '' &&
            $genere === '' &&
            $luogo_nascita === '' &&
            $luogo_morte === '' &&
            $anno_nascita === null &&
            $anno_morte === null &&
            $indirizzo_url === '') {
            //se lo sono restituiamo tutte le colonne
            $sql = "SELECT * FROM ARTISTI";
        } else {
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
        }
        //eseguiamo la query
        $risultato = $conn->query($sql);
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
        //chiudiamo la connessione al database
        $conn->close();
        ?>
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