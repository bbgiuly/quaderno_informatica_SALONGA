<?php
$servername = "localhost";  // server MySQL, per XAMPP è localhost
$username = "root";         // nome utente MySQL, per XAMPP è root
$password = "";             // password, per XAMPP è vuota di default
$dbname = "vendite";        // il nome del tuo database

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
    <title>Articoli Venduti</title>
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

    <h1>Elenco degli Articoli Venduti</h1>

    <?php
        // Query per ottenere tutti gli articoli
        $sql = "SELECT * FROM articoli";
        $result = $conn->query($sql);

        // Controlla se ci sono risultati
        if ($result->num_rows > 0) {
            // Se ci sono risultati, crea una tabella HTML per mostrarli
            echo "<table>";
            echo "<tr><th>Descrizione</th><th>Prezzo Unitario</th><th>Categoria</th></tr>";

            // Cicla attraverso i risultati e mostra i dati
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row["descrizione"]) . "</td>
                          <td>" . htmlspecialchars($row["prezzo_unitario"]) . "</td>
                          <td>" . htmlspecialchars($row["id_categoria"]) . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "Nessun articolo trovato.";
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

