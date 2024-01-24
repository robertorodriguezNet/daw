<?php 
$path = "http://" . $_SERVER["REMOTE_ADDR"] . "/daw/";
?>
<nav id="navegador-principal">
    <ul>
        <li><a href="<?=$path?>" <?php if($page == "inicio") echo "class=\"active\"" ?>>INICIO</a></li>
        <li><a href="<?=$path?>daw" <?php if($page == "daw") echo "class=\"active\"" ?>>DAW</a></li>
        <li><a href="<?=$path?>diw" <?php if($page == "diw") echo "class=\"active\"" ?>>DIW</a></li>
        <li><a href="<?=$path?>dwec" <?php if($page == "dewc") echo "class=\"active\"" ?>>DWEC</a></li>
        <li><a href="<?=$path?>dwes" <?php if($page == "dwes") echo "class=\"active\"" ?>>DWES</a></li>
    </ul>
</nav>