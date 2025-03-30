<?php
// Controlla se la pagina è stata chiamata tramite metodo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera il valore selezionato dall'utente e lo converte in intero
    $n = (int)$_POST['numero'];

    // Controlla se il numero è valido (tra 1 e 10)
    if ($n >= 1 && $n <= 10) {
        // Stampa il titolo della tabella
        echo "<h1>Tabella di Quadrati e Cubi</h1>";
        // Inizia la tabella HTML con bordo, stile di crollo e testo centrato
        echo "<table border='1' style='border-collapse: collapse; text-align: center;'>";
        // Stampa l'intestazione della tabella
        echo "<tr><th>Numero</th><th>Quadrato</th><th>Cubo</th></tr>";

        // Ciclo che genera le righe della tabella per i valori da 1 a n
        for ($i = 1; $i <= $n; $i++) {
            echo "<tr>";
            echo "<td>$i</td>"; // Stampa il numero
            echo "<td>" . ($i ** 2) . "</td>"; // Stampa il quadrato del numero
            echo "<td>" . ($i ** 3) . "</td>"; // Stampa il cubo del numero
            echo "</tr>";
        }

        // Chiude la tabella
        echo "</table>";
    } else {
        // Stampa un messaggio di errore se il numero non è valido
        echo "<p>Numero non valido. Ricarica la pagina per riprovare.</p>";
    }

    // Stampa i link per la navigazione e informazioni del progetto
    echo "<a href='quaderno_informatica_SALONGA.html'>Torna all'indice</a>";
    echo "<a href='esercitazioni.html'>Esercitazioni PHP</a>";
    echo "<footer>";
    echo "<p>Info project:";
    echo "Nome: Giuliana";
    echo "Cognome: Salonga";
    echo "</p>";
    echo "</footer>";
} else {
    // Mostra il form HTML per l'inserimento del numero se la richiesta non è POST
    echo "<h1>Genera Tabella di Quadrati e Cubi</h1>";
    echo "<form method='POST' action='esercizio_E.php'>";
    echo "<label for='numero'>Scegli un numero tra 1 e 10:</label>";
    echo "<select id='numero' name='numero' required>";

    // Ciclo che genera le opzioni del menù a tendina per numeri da 1 a 10
    for ($i = 1; $i <= 10; $i++) {
        echo "<option value='$i'>$i</option>";
    }

    echo "</select>";
    echo "<br><br>";
    echo "<button type='submit'>Crea Tabella</button>";
    echo "</form>";
}

// Questo codice PHP permette all'utente di scegliere un numero da 1 a 10 tramite un form HTML. Se la scelta è valida, genera una tabella che mostra i quadrati e i cubi dei numeri fino al valore scelto. Inoltre, fornisce navigazione e informazioni sul progetto.
?>