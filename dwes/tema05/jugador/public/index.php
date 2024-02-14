<?php 
    // autoload de archivos
    spl_autoload_register(function ($class){
        require "../src/" . $class . ".php";
    });

    $jugador1 = new Jugador();
    $jugador1->setId(1);
    $jugador1->setNombre("Benito");
    $jugador1->setApellidos("Boniato");
    $jugador1->setDorsal(1);
    $jugador1->setPoscion("Portero");
    $jugador1->setBarcode("1234567890123");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores</title>
</head>
<body>
    <h1>JUGADORES</h1>

    <p>
        Portero: <?=$jugador1?>
    </p>

</body>
</html>