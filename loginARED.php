<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=membre', 'root', '');

if(isset($_POST['formulaire'])) {
  $name = htmlspecialchars($_POST['name']);
  $pws = htmlspecialchars($_POST['psw']);

  if(!empty($name)&&!empty($pws)) {
    $checkuser = $bdd->prepare("SELECT * FROM ared WHERE prenomnom = ? AND motsdepasse = ?");
    $checkuser->execute(array($name, $pws));
    $lookforuser = $checkuser->rowCount();
    if ($lookforuser == 1) {
      $userinfo = $checkuser->fetch();
      $_SESSION['username'] = $userinfo['prenomnom'];
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['classe'] = "ared";
      header("Location: Ared.php");
    } else {
      $error="utilisateur introuvable";
    }
  } else {
    $error = "Veuillez compléter tout les champs";
  }
}

if(isset($_SESSION['id']) && $_SESSION['classe'] == "ared") {
    sleep(0.5);
    header('Location: Ared.php');
}

?>


<html>

<head>
    
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="loginARED.css?ver=1.1">
    <link rel="shortcut icon"  href="Image/image-haut-de-page/Logo-STJO.ico">
</head>
<body>
    <section>
        <div class="form-container">
            <h1>Page connexion</h1>
            <form method="POST" action="">
                <div class="control">
                <?php 
                if(isset($error)){
                echo '<h5 class="error">' . $error . '</h5>';}?>
                    <label for="name" id="prenom"><div class="text">Prénom Nom</div></label>
                    <input type="text" name="name" id="name" placeholder="Prénom.Nom "> 
                </div>
                <div class="control">
                    <label for="psw" id="mot de passe"><div class="text">Mots de passe </div></label>
                    <input type="password" name="psw" id="psw" placeholder="Mots de passe">
                </div>
                <div class="control">
                 <input type="submit" name="formulaire"  value="connexion" >  

                </div>
            </form>
            <div class="link">
                
            </div>
        </div>
    </section>
    







</body>
</html>
