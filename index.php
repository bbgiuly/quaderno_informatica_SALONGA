<?php
$servername = "localhost";  // server MySQL, per XAMPP è localhost
$username = "root";         // nome utente MySQL, per XAMPP è root
$password = "";             // password, per XAMPP è vuota di default
$dbname = "vendite_db";     // nome corretto del database

// Crea la connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Funzione per eseguire una query e mostrare i risultati in tabella
function mostraTabella($conn, $query, $intestazioni) {
    $result = $conn->query($query);
    if ($result === false) {
        echo "<p>Errore nella query: " . $conn->error . "</p>";
    } elseif ($result->num_rows > 0) {
        echo "<table><tr>";
        foreach ($intestazioni as $intestazione) {
            echo "<th>$intestazione</th>";
        }
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $valore) {
                echo "<td>" . htmlspecialchars($valore) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nessun risultato trovato.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Vendite</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

<h1>Report Vendite</h1>

<?php
// a) Articoli fatturati nel 2021 in ordine di categoria
$query_a = "SELECT a.descrizione, a.prezzo_unitario, c.descrizione AS nome_categoria 
            FROM articoli a 
            JOIN categoria c ON a.id_categoria = c.ID_categoria
            JOIN dettagli d ON a.ID_articolo = d.id_articolo
            JOIN fatture f ON d.id_fattura = f.ID_fattura
            WHERE YEAR(f.data_fattura) = 2021
            ORDER BY c.descrizione";
echo "<h2>a) Articoli fatturati nel 2021 in ordine di categoria</h2>";
mostraTabella($conn, $query_a, ["Descrizione", "Prezzo Unitario", "Categoria"]);

// b) Fatture per clienti della Lombardia
$query_b = "SELECT f.ID_fattura, f.data_fattura, c.nome, ci.nome AS nome_citta
            FROM fatture f
            JOIN clienti c ON f.id_cliente = c.ID_cliente
            JOIN citta ci ON c.id_citta = ci.ID_citta
            WHERE ci.regione = 'Lombardia'";
echo "<h2>b) Fatture per clienti della Lombardia</h2>";
mostraTabella($conn, $query_b, ["ID Fattura", "Data", "Cliente", "Città"]);

// c) Articoli tra 80 e 350 euro con cliente e data vendita
$query_c = "SELECT a.descrizione, a.prezzo_unitario, c.nome, f.data_fattura
            FROM articoli a
            LEFT JOIN dettagli d ON a.ID_articolo = d.id_articolo
            LEFT JOIN fatture f ON d.id_fattura = f.ID_fattura
            LEFT JOIN clienti c ON f.id_cliente = c.ID_cliente
            WHERE a.prezzo_unitario BETWEEN 80 AND 350";
echo "<h2>c) Articoli tra 80 e 350 euro con cliente e data vendita</h2>";
mostraTabella($conn, $query_c, ["Descrizione", "Prezzo Unitario", "Cliente", "Data Vendita"]);

// d) Prezzi unitari degli articoli venduti in più di 5 pezzi allo stesso cliente
$query_d = "SELECT a.descrizione, a.prezzo_unitario
            FROM dettagli d
            JOIN articoli a ON d.id_articolo = a.ID_articolo
            GROUP BY d.id_articolo, d.id_fattura
            HAVING SUM(d.quantita) > 5";
echo "<h2>d) Prezzi unitari degli articoli venduti in più di 5 pezzi allo stesso cliente</h2>";
mostraTabella($conn, $query_d, ["Descrizione", "Prezzo Unitario"]);

// e) Articoli venduti in prossimità delle feste natalizie (15-31 dicembre)
$query_e = "SELECT COUNT(*) AS totale_articoli_venduti
            FROM dettagli d
            JOIN fatture f ON d.id_fattura = f.ID_fattura
            WHERE MONTH(f.data_fattura) = 12 AND DAY(f.data_fattura) BETWEEN 15 AND 31";
echo "<h2>e) Articoli venduti in prossimità delle feste natalizie</h2>";
mostraTabella($conn, $query_e, ["Totale Articoli Venduti"]);

// f) Conteggio articoli venduti per cliente e totale per città
$query_f = "SELECT c.nome, ci.nome AS nome_citta, COUNT(d.id_articolo) AS articoli_venduti
            FROM clienti c
            JOIN fatture f ON c.ID_cliente = f.id_cliente
            JOIN dettagli d ON f.ID_fattura = d.id_fattura
            JOIN citta ci ON c.id_citta = ci.ID_citta
            GROUP BY c.ID_cliente, ci.ID_citta
            WITH ROLLUP";
echo "<h2>f) Conteggio articoli venduti per cliente e totale per città</h2>";
mostraTabella($conn, $query_f, ["Cliente", "Città", "Articoli Venduti"]);

// g) Media prezzo unitario articoli venduti ai clienti del Lazio
$query_g = "SELECT AVG(a.prezzo_unitario) AS media_prezzo
            FROM articoli a
            JOIN dettagli d ON a.ID_articolo = d.id_articolo
            JOIN fatture f ON d.id_fattura = f.ID_fattura
            JOIN clienti c ON f.id_cliente = c.ID_cliente
            JOIN citta ci ON c.id_citta = ci.ID_citta
            WHERE ci.regione = 'Lazio'";
echo "<h2>g) Media prezzo unitario articoli venduti ai clienti del Lazio</h2>";
mostraTabella($conn, $query_g, ["Media Prezzo Unitario"]);

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


