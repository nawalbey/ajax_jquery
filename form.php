<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX avec Json</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
        }

        select {
            width: 100%;
            height: 30px;
            border: 1px solid #333;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div style="width: 1000px; margin: 0 auto; padding: 20px;">
        <!-- form>label{Choisir une personne}+select#personne[onchange="monAjax()"]>option*7^^hr+div#resultat -->

        <?php
        //  récupérer le contenu du tableau json en utilisant la fonction (file_get_contents) et stocker dans une variable : '$fichier'
        $fichier = file_get_contents('fichier.json', true);
        echo "<pre>";
        var_dump($fichier);
        echo "</pre>";
        // convertir le tableau json en tableau php (json_decode) et stocker dans une variable : $tab
        $tabs = json_decode($fichier, true);

        echo "<pre>";
        var_dump($tabs);
        echo "</pre>";
        ?>

        <form method="post" action="ajax.php" id="form">
            <label for="personne">Choisir une personne</label>
            <select name="choix" id="personne">
                <option>...</option>
                <!-- afficher le contenu de l'indice 'nom' tableau '$tab'dans la liste -->
                <?php
                foreach ($tabs as $tab) {
                    echo '<option value =' . $tab['nom'] . '>' . $tab['nom'] . '</option>';
                }

                ?>
            </select>
            <input type="text" name="prenom">
            <button type="submit" name="submit" value="submit">submit</button>
        </form>
        <hr>
        <div id="resultat"></div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function () {
            $("#personne").on('change', function () {
                var param = $("#form").serialize();
                console.log(param);
                $.ajax({
                    url: 'ajax.php',// le fichier cible, celui qui fera le traitement 
                    type: 'POST',// la méthode utilisée 
                    data: param,// les paramettre à fournir
                    dataType: 'json',// le format des données attendues  
                    success: function (response) {
                        // la fonction qui doit s'exécuter lors de la réussite de la communication ajax 

                    },
                });
            });
        });
    </script>

</html>