<?php
// Stampa il titolo 
echo "<h1>Saluto personalizzato</h1>";
// Assegna il nome dell'utente alla variabile $nome
$nome = "Paolo";

// Determina il messaggio di saluto in base all'ora corrente
$ora = date("H"); // Ora attuale in formato 24 ore
if ($ora >= 8 && $ora < 12) {
    $saluto = "Buongiorno";
} elseif ($ora >= 12 && $ora < 20) {
    $saluto = "Buonasera";
} else {
    $saluto = "Buonanotte";
}

// Identifica il browser dell'utente utilizzando la stringa agente utente
$browser = $_SERVER['HTTP_USER_AGENT'];
if (strpos($browser, 'Firefox') !== false) {
    $browser_tipo = "Firefox";
} elseif (strpos($browser, 'Chrome') !== false) {
    $browser_tipo = "Chrome";
} elseif (strpos($browser, 'Safari') !== false) {
    $browser_tipo = "Safari";
} elseif (strpos($browser, 'Edge') !== false) {
    $browser_tipo = "Edge";
} elseif (strpos($browser, 'Opera') !== false || strpos($browser, 'OPR') !== false) {
    $browser_tipo = "Opera";
} else {
    $browser_tipo = "un browser sconosciuto";
}

// Stampa il messaggio di saluto
echo "<h1>$saluto $nome, benvenuto nella mia prima pagina PHP!</h1>";
echo "<p>Stai usando il browser: $browser_tipo</p>";

// Stampa i link per la navigazione e informazioni del progetto
echo "<a href='quaderno_informatica_SALONGA.html'>Torna all'indice</a>";
echo "<a href='esercitazioni.html'>Esercitazioni PHP</a>";
echo "<footer>";
echo "<p>Info project:";
echo "Nome: Giuliana";
echo "Cognome: Salonga";
echo "</p>";
echo "</footer>";

// Questo codice PHP genera un saluto personalizzato in base all'ora del giorno e informa l'utente su quale browser sta usando. Inoltre, fornisce link utili e informazioni del progetto nel footer.
?>