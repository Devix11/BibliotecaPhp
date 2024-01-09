<?php
/*Pagina login php
 -Selettore tipo account: Admin/User 
    -Inserimento username e password
    -Controllo correttezza credenziali
        -Se corrette, reindirizzamento alla homepage
        -Se non corrette, messaggio di errore
*/

echo
'<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form>
        <label for="account-type">Selettore tipo account:</label>
        <select id="account-type" name="account-type">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Accedi">
    </form>
</body>
</html>'

//prendo credenziali dal database mysql



//controllo correttezza credenziali
?>