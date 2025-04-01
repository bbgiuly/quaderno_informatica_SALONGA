<?php
// Connessione al database
$servername = "localhost";  // server MySQL, per XAMPP è localhost
$username = "root";         // nome utente MySQL, per XAMPP è root
$password = "";             // password, per XAMPP è vuota di default
$dbname = "atletica_db";    // il nome del tuo database

// Crea la connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campionato di Gare Podistiche</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Elenco delle Gare e dei Partecipanti</h1>

    <?php
    // Query per ottenere tutte le gare e i relativi atleti
    $sql = "
    SELECT g.ID_gara, g.nome AS gara_nome, g.citta, g.data, 
           a.cognome AS atleta_cognome, a.nome AS atleta_nome, 
           a.cod_fiscale, a.data_nascita, c.descrizione AS categoria, 
           s.descrizione AS squadra, 
           CASE 
               WHEN COUNT(am.ID_ammonizione) >= 3 THEN 'Squalificato'
               ELSE 'Non squalificato'
           END AS squalificato
    FROM gare g
    LEFT JOIN atleti_gare ag ON g.ID_gara = ag.ID_gara
    LEFT JOIN atleti a ON ag.ID_atleta = a.ID_atleta
    LEFT JOIN categorie c ON a.ID_categoria = c.ID_categoria
    LEFT JOIN squadre s ON a.ID_squadra = s.ID_squadra
    LEFT JOIN ammonizioni am ON am.ID_atleta = a.ID_atleta AND am.ID_gara = g.ID_gara
    GROUP BY g.ID_gara, a.ID_atleta";
    
    // Esegui la query
    $result = $conn->query($sql);

    // Controlla se ci sono risultati
    if ($result) {
        if ($result->num_rows > 0) {
            // Se ci sono risultati, crea una tabella HTML per mostrarli
            echo "<table>";
            echo "<tr><th>ID Gara</th><th>Nome Gara</th><th>Città</th><th>Data</th><th>Atleta</th><th>Codice Fiscale</th><th>Data di Nascita</th><th>Categoria</th><th>Squadra</th><th>Squalifica</th></tr>";

            // Cicla attraverso i risultati e mostra i dati
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["ID_gara"]) . "</td>
                        <td>" . htmlspecialchars($row["gara_nome"]) . "</td>
                        <td>" . htmlspecialchars($row["citta"]) . "</td>
                        <td>" . date("d-m-Y", strtotime($row["data"])) . "</td>
                        <td>" . htmlspecialchars($row["atleta_nome"]) . " " . htmlspecialchars($row["atleta_cognome"]) . "</td>
                        <td>" . htmlspecialchars($row["cod_fiscale"]) . "</td>
                        <td>" . date("d-m-Y", strtotime($row["data_nascita"])) . "</td>
                        <td>" . htmlspecialchars($row["categoria"]) . "</td>
                        <td>" . htmlspecialchars($row["squadra"]) . "</td>
                        <td>" . htmlspecialchars($row["squalificato"]) . "</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "Nessun risultato trovato.";
        }
    } else {
        // Gestione degli errori SQL
        die("Errore nella query: " . $conn->error);
    }

    // Chiudi la connessione
    $conn->close();
    ?>

<p>🔙 <a href="quaderno_informatica_SALONGA.html">Torna all'indice</a></p>

<footer>
    <hr>
    <p>📌 Info project:</p>
    <p>👤 Nome: Giuliana</p>
    <p>📝 Cognome: Salonga</p>
    <p>© 2025 - Tutti i diritti riservati.</p>
</footer>

</body>
</html>


