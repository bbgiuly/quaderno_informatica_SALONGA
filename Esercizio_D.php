<?php
// Definisce username e password corretti per l'accesso
$username_corretta = "admin";
$password_corretta = "1234";

// Controlla se il form è stato inviato con il metodo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Ottiene l'username inviato
    $password = $_POST['password']; // Ottiene la password inviata

    // Verifica se le credenziali corrispondono a quelle predefinite
    if ($username === $username_corretta && $password === $password_corretta) {
        echo "<h1>Login eseguito</h1>"; // Messaggio di login riuscito
    } else {
        echo "<h1>Credenziali errate</h1>"; // Messaggio di errore per credenziali sbagliate
    }

    // Link per tornare alla pagina di login
    echo "<p><a href='esercizio_d.php'>Torna al login</a></p>";
} else {
    // Mostra il form di login se non è stata effettuata una richiesta POST
    echo "
        <h1>Login</h1>
        <form method='POST' action='Esercizio_D.php'>
            <label for='username'>Nome utente:</label>
            <input type='text' id='username' name='username' required><br><br>
            <label for='password'>Password:</label>
            <input type='password' id='password' name='password' required><br><br>
            <button type='submit'>Accedi</button>
        </form>
    ";
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

// Questo codice PHP gestisce un semplice sistema di login. Visualizza un modulo di login e verifica le credenziali inserite. In base al risultato del login, visualizza un messaggio appropriato e fornisce un link per tornare al form di login. Inoltre, include link di navigazione e informazioni sul progetto nel footer.
?>
