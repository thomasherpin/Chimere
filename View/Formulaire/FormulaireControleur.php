<!doctype html>
<html>
    <head>
        
        <title>Formulaire Contrôleur</title>
    </head>
    <!-- forumulaire 
    action : page appelée quand on envoie 
    method : methode d'envoi des données
    GET : dans l'url
    POST : dans l'entete HTTP
    -->
    <body>


    <form action=''
          method='post'>
        <h1>Valider les travaux</h1>
        Commentaires : <br>
            <textarea name='message' cols='50' rows='6'>
    </textarea>
        <br>
        <br>
         Artisan : <input type='text'required name='artisan'><br>
    </form>
    </body>
</html>