<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calciatori 2022</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Database Calcio 2022</h1>

    <?php
    // Connessione al database
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "calcio_2022";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // a. Elenco di tutti i calciatori che militano in squadre con più di 10.000 abbonati
    echo "<h2>Calciatori delle squadre con più di 10.000 abbonati</h2>";
    $sql = "SELECT C.nome AS calciatore, S.nome AS squadra
            FROM Calciatori C
            JOIN Squadre S ON C.id_squadra = S.id_squadra
            WHERE S.num_abbonati > 10000";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table>
                <tr><th>Calciatore</th><th>Squadra</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["calciatore"] . "</td><td>" . $row["squadra"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun risultato trovato.</p>";
    }

    // b. Elenco di tutti i procuratori di giocatori di serie B e C
    echo "<h2>Procuratori dei giocatori di Serie B e C</h2>";
    $sql = "SELECT DISTINCT P.nome AS procuratore
            FROM Procuratori P
            JOIN Calciatori C ON P.id_procuratore = C.id_procuratore
            JOIN Squadre S ON C.id_squadra = S.id_squadra
            WHERE S.serie IN ('B', 'C')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr><th>Procuratore</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["procuratore"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun procuratore trovato.</p>";
    }

    // c. Elenco di tutti i calciatori, anche senza procuratore, e elenco dei soli giocatori di serie A
    echo "<h2>Elenco di tutti i calciatori e solo quelli di Serie A</h2>";
    $sql = "SELECT C.nome AS calciatore, P.nome AS procuratore
            FROM Calciatori C
            LEFT JOIN Procuratori P ON C.id_procuratore = P.id_procuratore";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Tutti i calciatori</h3>";
        echo "<table>
                <tr><th>Calciatore</th><th>Procuratore</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["calciatore"] . "</td><td>" . ($row["procuratore"] ? $row["procuratore"] : "Nessun procuratore") . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun calciatore trovato.</p>";
    }

    // d. Elenco di tutte le squadre con i relativi procuratori (evita ripetizioni)
    echo "<h2>Squadre con i relativi procuratori</h2>";
    $sql = "SELECT S.nome AS squadra, P.nome AS procuratore
            FROM Squadre S
            JOIN Calciatori C ON S.id_squadra = C.id_squadra
            JOIN Procuratori P ON C.id_procuratore = P.id_procuratore
            GROUP BY S.nome, P.nome";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr><th>Squadra</th><th>Procuratore</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["squadra"] . "</td><td>" . $row["procuratore"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessuna squadra trovata.</p>";
    }

    // e. Elenco dei procuratori senza ripetere il nome
    echo "<h2>Elenco dei procuratori senza ripetere il nome</h2>";
    $sql = "SELECT DISTINCT P.nome AS procuratore
            FROM Procuratori P";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr><th>Procuratore</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["procuratore"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun procuratore trovato.</p>";
    }

    // f. Elenco di tutti i procuratori disoccupati
    echo "<h2>Procuratori disoccupati</h2>";
    $sql = "SELECT P.nome AS procuratore
            FROM Procuratori P
            LEFT JOIN Calciatori C ON P.id_procuratore = C.id_procuratore
            WHERE C.id_calciatore IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr><th>Procuratore</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["procuratore"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun procuratore disoccupato trovato.</p>";
    }

    // g. Elenco di tutti i calciatori disoccupati che valgono più di € 10.000
    echo "<h2>Calciatori disoccupati che valgono più di € 10.000</h2>";
    $sql = "SELECT C.nome AS calciatore, C.valore_mercato
            FROM Calciatori C
            LEFT JOIN Squadre S ON C.id_squadra = S.id_squadra
            WHERE S.id_squadra IS NULL AND C.valore_mercato > 10000";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr><th>Calciatore</th><th>Valore di Mercato</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["calciatore"] . "</td><td>" . $row["valore_mercato"] . " €</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun calciatore disoccupato trovato con valore maggiore di € 10.000.</p>";
    }

    // Chiudi la connessione al database
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
