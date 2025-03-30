<?php
// Avvia la sessione
session_start();

// Connessione al database
$servername = "localhost"; // O l'IP del server
$username = "root"; // Cambia con il tuo username di MySQL
$password_db = ""; // Cambia con la password del database
$dbname = "tuo_database"; // Cambia con il nome del tuo database

$conn = new mysqli($servername, $username, $password_db, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Registrazione utente
if (isset($_POST['signup'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Hasher la password

    if ($email && !empty($_POST['password'])) {
        // Controlla se l'email è già registrata
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            // Salva nel database
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();

            echo "<h1>Registrazione completata</h1>";
        } else {
            echo "<h1>Errore</h1><p>Email già registrata.</p>";
        }
    } else {
        echo "<h1>Errore</h1><p>Email non valida o password vuota.</p>";
    }
    exit;
}

// Login utente
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;
            echo "<h1>Accesso effettuato!</h1>";
        } else {
            echo "<h1>Errore</h1><p>Password errata.</p>";
        }
    } else {
        echo "<h1>Errore</h1><p>Email non trovata.</p>";
    }
    exit;
}

$conn->close();
?>

<h1>Sign In</h1>
<form method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit" name="signup">Sign In</button>
</form>

<hr>

<h1>Login</h1>
<form method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>



// Stampa i link per la navigazione e informazioni del progetto
echo "<a href='quaderno_informatica_SALONGA.html'>Torna all'indice</a>";
echo "<a href='esercitazioni.html'>Esercitazioni PHP</a>";
echo "<footer>";
echo "<p>Info project:";
echo "Nome: Giuliana";
echo "Cognome: Salonga";
echo "</p>";
echo "</footer>";

// Questo script PHP gestisce sia la registrazione degli utenti che il login. Utilizza la sessione per memorizzare temporaneamente le credenziali durante la sessione attiva. Permette agli utenti di registrarsi con una email e password, e successivamente effettuare il login con le credenziali salvate.
?>