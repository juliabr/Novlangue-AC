<!DOCTYPE html>
<html lang="fr-FR" class="no-js">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>Robot Novlangue “Art contemporain”</title>

<link href='http://fonts.googleapis.com/css?family=Lora:400italic|Armata' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="assets/styles.css">

<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
<![endif]-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="assets/app.js"></script>

</head>
   
<body>
  
   <div id="wrapper">
      
      <header>
         <h1>Robot Novlangue “Art contemporain”</h1>
      </header>

      <div id="newspeak-art" class="list">
         <section class="item current"><?php include('generate_newspeak.php'); ?></section>
      </div>
      
      <form id="newspeak-art-form">
         <input type="submit" value="Générer l'indicible" class="btn" />
      </form>
        
   </div>
         
</body>
</html>