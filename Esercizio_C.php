<?php
echo "<h1>Schemi di Triangoli</h1>";

// Primo triangolo: stampa un triangolo con lato crescente verso destra
echo "<h2>Triangolo 1</h2>";
for ($i = 1; $i <= 5; $i++) { // Numero di righe
    for ($j = 1; $j <= $i; $j++) { // Stampa asterischi per riga
        echo '*';
    }
    echo '<br>'; // Passa alla nuova riga
}

// Secondo triangolo: stampa un triangolo con lato decrescente verso destra
echo "<h2>Triangolo 2</h2>";
for ($i = 5; $i >= 1; $i--) { // Numero di righe decrescente
    for ($j = 1; $j <= $i; $j++) { // Stampa asterischi per riga
        echo '*';
    }
    echo '<br>'; // Passa alla nuova riga
}

// Terzo triangolo: stampa un triangolo con lato crescente verso sinistra
echo "<h2>Triangolo 3</h2>";
for ($i = 1; $i <= 5; $i++) { // Numero di righe
    for ($j = 1; $j <= (5 - $i); $j++) { // Stampa spazi per allineamento a sinistra
        echo '&nbsp;';
    }
    for ($j = 1; $j <= $i; $j++) { // Stampa asterischi
        echo '*';
    }
    echo '<br>'; // Passa alla nuova riga
}

// Quarto triangolo: stampa un triangolo con lato decrescente verso sinistra
echo "<h2>Triangolo 4</h2>";
for ($i = 5; $i >= 1; $i--) { // Numero di righe decrescente
    for ($j = 1; $j <= (5 - $i); $j++) { // Stampa spazi per allineamento a sinistra
        echo '&nbsp;';
    }
    for ($j = 1; $j <= $i; $j++) { // Stampa asterischi
        echo '*';
    }
    echo '<br>'; // Passa alla nuova riga
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

// Questo codice PHP visualizza diversi schemi di triangoli usando cicli for annidati per generare forme geometriche con asterischi. Inoltre, fornisce link per la navigazione e informazioni di footer relative al progetto.
?>
