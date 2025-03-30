<?php
// Stampa il titolo della tabella
echo "<h1>Tabella Pitagorica</h1>";
// Inizia la tabella, definisce bordo, stile del bordo e allineamento del testo
echo "<table border='1' style='border-collapse: collapse; text-align: center;'>";

// Inizia la riga di intestazione della tabella e aggiunge una cella vuota per l'angolo in alto a sinistra
echo "<tr><th></th>";
// Ciclo che crea le celle dell'intestazione con i numeri da 1 a 10
for ($i = 1; $i <= 10; $i++) {
    echo "<th>$i</th>";
}
// Chiude la riga di intestazione
echo "</tr>";

// Ciclo esterno per creare le righe della tabella
for ($i = 1; $i <= 10; $i++) {
    echo "<tr>"; // Inizia una nuova riga
    echo "<th>$i</th>"; // Cella di intestazione laterale con il numero della riga
    // Ciclo interno per riempire la riga con i prodotti
    for ($j = 1; $j <= 10; $j++) {
        echo "<td>" . ($i * $j) . "</td>"; // Calcola il prodotto e lo stampa in una cella
    }
    echo "</tr>"; // Chiude la riga
}
echo "</table>"; // Chiude la tabella

// Link per tornare all'indice del quaderno di informatica
echo "<a href='quaderno_informatica_SALONGA.html'>Torna all'indice</a>";
// Link per accedere alle esercitazioni di PHP
echo "<a href='esercitazioni.html'>Esercitazioni PHP</a>";
// Inizia il footer
echo "<footer>";
// Informazioni sul progetto
echo "<p>Info project:";
echo "Nome: Giuliana";
echo "Cognome: Salonga";
echo "</p>";
echo "</footer>"; // Chiude il footer

// Questo codice PHP genera una tabella pitagorica 10x10, offre link di navigazione e fornisce informazioni di footer sul progetto.
?>
