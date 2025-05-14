<?php

try {
   
   $pdo = new PDO("mysql:host=localhost;dbname=emassan", "root", "");
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      
} catch (PDOException $e) {

   echo "erreur de la connextion :" .$e->getMessage();
}

