<?php
require_once ('conf.php');
global $yhendus;
// tabeli andmete lisamine

if(!empty($_REQUEST["uusnimi"])){

    $kask=$yhendus->prepare("INSERT INTO laulud(laulunimi, lisamisaeg) VALUES(?, NOW())");
    $kask->bind_param('s', $_REQUEST["uusnimi"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
if(!empty($_REQUEST["peitmine"])){

    $kask=$yhendus->prepare("UPDATE laulud SET avalik=0 where id=?");
    $kask->bind_param('s', $_REQUEST["peitmine"]);
    $kask->execute();

}
if(!empty($_REQUEST["naitamine"])){

    $kask=$yhendus->prepare("UPDATE laulud SET avalik=1 where id=?");
    $kask->bind_param('s', $_REQUEST["naitamine"]);
    $kask->execute();

}
if(!empty($_REQUEST["kustuta"])){

    $kask=$yhendus->prepare("DELETE from laulud where id=?");
    $kask->bind_param('s', $_REQUEST["kustuta"]);
    $kask->execute();

}
?>



    <!DOCTYPE html>
    <html lang="et">
    <head>
        <meta charset="UTF-8">
        <title>LUALUDE ADMIN</title>
        <link rel="stylesheet" type="text/css" href="lauludStyle.css">
    </head>
    <body>
    <h1>Laulude ADMIN</h1>
    <h2>Laulu lisamine</h2>
    <form action="?">
        <label for="nimi">Laulunimi</label>
        <input type="text" name="uusnimi" id="nimi" placeholder="laulunimi">
        <input type="submit" value="Ok">

    </form>
     <table>
        <tr>
            <th>Laulunimi</th>
            <th>Punktid</th>
            <th>Lisamisaeg</th>
            <th>Staatus</th>
            <th>Haldus</th>
            <th>Kustuta</th>

        </tr>
        <?php
        //tabeli sisu naitamine
        $kask=$yhendus->prepare('SELECT id, laulunimi, punktid, lisamisaeg, avalik FROM laulud');
        $kask->bind_result($id, $laulunimi, $punktid, $aeg, $avalik);
        $kask->execute();
        while($kask->fetch()){
            $seisund="PEIDETUD";
            $param="naitamine";
            $tekst="NÄITA";
            if($avalik==1){
                $seisund="AVATUD";
                $param="peitmine";
                $tekst="PEIDA";
            }
            echo "<tr>";
            echo "<td>".htmlspecialchars($laulunimi)."</td>";
            echo "<td>$punktid</td>";
            echo "<td>$aeg</td>";
            echo "<td>$seisund</td>";
            echo "<td><a href='?$param=$id'>$tekst</a></td>";
            echo "<td><a href='?kustuta=$id'>kustuta</a></td>";
            echo "</tr>";
        }


        ?>
    </table>



    </body>
    <?php
    $yhendus->close();
    ?>
    </html>


<?php
