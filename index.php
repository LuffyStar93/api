<?php
$con = new MongoClient("mongodb+srv://Max:azertyuiop@nsk-jirog.gcp.mongodb.net/test?retryWrites=true");
$filter = [];
$option = [];
$read = new MongoDB\Driver\Query($filter, $option);

$all_film = $con->executeQuery("Cinema.Cinema.Cinema", $read);

$single_insert = new MongoDB\Driver\BulkWrite();

if(isset($_POST['submit'])){
$createfilm = array(
    'titre' => $_POST['titre'],
    'realisateur' => $_POST['realisateur'],
    'annee' => $_POST['annee']
);

$single_insert->insert($createfilm);
$con->executeBulkWrite("Cinema.Cinema.Cinema",$single_insert);
header("Location: index.php");
};



?>

<html>
<head>
 <style>
    h1{
        text-align:center;
    }
    table,tr,td,th{
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
        margin: auto;
    }
    img{
        height:20%;
        width:;
        repeat:no-repeat;
    }
    th{
        padding:10px;
        background: blue;
        color:white;
    
    }

    .btn{
    
        text-decoration: none;
        color:black;
        
        width: 30px;
        height: 10px;
    }
    #form1, #form2{
        display:flex;
        flex-direction:column;
        width:100%;
        height:100px;
        background:lightblue;
        margin-top:20px;
        text-transform: uppercase;
    }
    #form2 {
        display:none;
    }
    input{
        width:20%;
        height:30px;
    }
 </style>
</head>
    <body>

    <h1>Référencement de films</h1>

        <table class="table table-borderd">
        <tr>
            <th>Affiche</th>
            <th>Titre</th>
            <th>Real</th>
            <th>Année</th>
            <th>Supprimer</th>
        </tr>
            <?php
          foreach ($all_film as $film) {
                echo "<tr>";
                echo "<td><img src='".$film->affiche."'></td>";
                echo "<td>".$film->titre."</td>";
                echo "<td>".$film->realisateur."</td>";
                echo "<td>".$film->annee."</td>";
                echo "<td>";
                    echo "<a href='DELETE.php?id=".$film->_id."' class='btn'>Supprimer</a>";
                    echo "</td>";
                echo "</tr>";
                
            };

            ?>
        </table>
        
     <div id="forms">
      <div id="form1">
        <h2>Ajouter un film</h2>
        <form id="form_create" method="POST">
            <label for="titre">Titre :</label>
            <input id="input_titre" name="titre" type="text">
            <label for="realisateur">Réalisateur :</label>
            <input id="input_real" name="realisateur" type="text">
            <label for="annee">Année :</label>
            <input id="input_annee" name="annee" type="number">
            <button type="submit" name="submit">Ajouter</button>
        </form>
      </div>
      <div id="form2">
        <h2>Modifier un film</h2>
        <form id="form_update" method="UPDATE">
            <label for="titre">Titre :</label>
            <input id="input_titre_upd" type="text">
            <label for="realisateur">Réalisateur :</label>
            <input id="input_real_upd" type="text">
            <label for="annee">Année :</label>
            <input id="input_annee_upd" type="number">
            <button>Modifier</button>
        </form>
      </div>
     </div>
    </body>
</html>