<?php
  // visualizza errori
  ini_set('display_errors', 1);
  # Includi la connessione
  require_once "./config.php";

  $username_err = $email_err = $password_err = "";
  $username = $email = $password = "";

  # Elabora i dati del modulo quando il modulo viene inviato
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # Valida il nome utente
    if (empty(trim($_POST["username"]))) {
      $username_err = "Inserisci un nome utente.";
    } else {
      $username = trim($_POST["username"]);
      if (!ctype_alnum(str_replace(array("@", "-", "_"), "", $username))) {
        $username_err = "Il nome utente può contenere solo lettere, numeri e simboli come '@', '_', o '-'.";
      } else {
        # Prepara una query di selezione
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
          # Associa le variabili alla query come parametri
          mysqli_stmt_bind_param($stmt, "s", $param_username);

          # Imposta i parametri
          $param_username = $username;

          # Esegui la query preparata
          if (mysqli_stmt_execute($stmt)) {
            # Memorizza il risultato
            mysqli_stmt_store_result($stmt);

            # Verifica se il nome utente è già registrato
            if (mysqli_stmt_num_rows($stmt) == 1) {
              $username_err = "Questo nome utente è già registrato.";
            }
          } else {
            echo "<script>" . "alert('Oops! Si è verificato un errore. Riprova più tardi.')" . "</script>";
          }

          # Chiudi la query
          mysqli_stmt_close($stmt);
        }
      }
    }

    # Valida l'email
    if (empty(trim($_POST["email"]))) {
      $email_err = "Inserisci un indirizzo email.";
    } else {
      $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Inserisci un indirizzo email valido.";
      } else {
        # Prepara una query di selezione
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
          # Associa le variabili alla query come parametri
          mysqli_stmt_bind_param($stmt, "s", $param_email);

          # Imposta i parametri
          $param_email = $email;

          # Esegui la query preparata
          if (mysqli_stmt_execute($stmt)) {
            # Memorizza il risultato
            mysqli_stmt_store_result($stmt);

            # Verifica se l'email è già registrata
            if (mysqli_stmt_num_rows($stmt) == 1) {
              $email_err = "Questa email è già registrata.";
            }
          } else {
            echo "<script>" . "alert('Oops! Si è verificato un errore. Riprova più tardi.');" . "</script>";
          }

          # Chiudi la query
          mysqli_stmt_close($stmt);
        }
      }
    }

    # Valida la password
    if (empty(trim($_POST["password"]))) {
      $password_err = "Inserisci una password.";
    } else {
      $password = trim($_POST["password"]);
      if (strlen($password) < 8) {
        $password_err = "La password deve contenere almeno 8 caratteri.";
      }
    }

    # Verifica gli errori di input prima di inserire i dati nel database
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
      # Prepara una query di inserimento
      $sql = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";

      if ($stmt = mysqli_prepare($link, $sql)) {
        # Associa le variabili alla query preparata come parametri
        mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

        # Imposta i parametri
        $param_username = $username;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        # Esegui la query preparata
        if (mysqli_stmt_execute($stmt)) {
          echo "<script>" . "alert('Registrazione completata con successo. Accedi per continuare.');" . "</script>";
          echo "<script>" . "window.location.href='./login.php';" . "</script>";
          exit;
        } else {
          echo "<script>" . "alert('Oops! Si è verificato un errore. Riprova più tardi.');" . "</script>";
        }

        # Chiudi la query
        mysqli_stmt_close($stmt);
      }
    }

    # Chiudi la connessione
    mysqli_close($link);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema di accesso utente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./main.css">
    <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
    <script defer src="./script.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-lg-5">
          <div class="form-wrap border rounded p-4">
            <h1>Registrati</h1>
            <p>Compila questo modulo per registrarti</p>
            <!-- il modulo inizia qui -->
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
              <div class="mb-3">
                <label for="username" class="form-label">Nome utente</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $username; ?>">
                <small class="text-danger"><?= $username_err; ?></small>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Indirizzo email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>">
                <small class="text-danger"><?= $email_err; ?></small>
              </div>
              <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?= $password; ?>">
                <small class="text-danger"><?= $password_err; ?></small>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="togglePassword">
                <label for="togglePassword" class="form-check-label">Mostra password</label>
              </div>
              <div class="mb-3">
                <input type="submit" class="btn btn-primary form-control" name="submit" value="Registrati">
              </div>
              <p class="mb-0">Hai già un account? <a href="./login.php">Accedi</a></p>
            </form>
            <!-- il modulo finisce qui -->
          </div>
        </div>
      </div>
    </div>
  </body>
</html>