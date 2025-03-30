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
    <h1>Elenco dei Calciatori delle Squadre con Più di 10.000 Abbonati</h1>

    <?php
    // Codice PHP per connettersi al database e mostrare i risultati
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "calcio_2022";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $sql = "SELECT C.nome AS calciatore, S.nome AS squadra
            FROM Calciatori C
            JOIN Squadre S ON C.id_squadra = S.id_squadra
            WHERE S.num_abbonati > 10000";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Calciatore</th>
                    <th>Squadra</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["calciatore"] . "</td>
                    <td>" . $row["squadra"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 risultati";
    }

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
