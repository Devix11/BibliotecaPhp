<!DOCTYPE html>
<html>
<head>
    <title>Conferma Eliminazione Account</title>
</head>
<body>
    <form action="dashboard_user.php" method="post">
        <h3>Sei sicuro di voler eliminare l'account?</h3>
        <input type="submit" name="confirmDelete" value="Si">
        <input type="submit" name="cancelDelete" value="No">
    </form>
    
    <?php
        include_once("./style/fonts.php");
    ?>
</body>
</html>
