<html>
   <head>
   <!--
      Riferimento alla guida ufficiale BootStrap versione 5.1 
      https://getbootstrap.com/docs/5.1/getting-started/introduction/
   -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <title>esercizio 1 pagina 62</title>
   </head>
   <body>
      <div class="container">
<?php
require("../../utility/function_library.php");
   
   if(isset($_REQUEST['scelta'])) $sc = $_REQUEST['scelta'];
   else $sc = null;

   echo("<ul class=\"nav\">
      <li class=\"nav-item\"><a class=\"nav-link\" aria-current=\"page\" href=\"page1.php\">Visualizza Lista Località</a></li>
      <li class=\"nav-item\"><a class=\"nav-link\" aria-current=\"page\" href=\"page2.php\">Visualizza Lista Cliente</a></li>
   </ul>");

   switch($sc){

      case "FormLocalita":{
         echo("<form action=\"page1.php\" method=\"post\">

         <label for=\"campo_1\" class=\"form-label\">Cap:</label>
         <input class=\"form-control\" type=\"text\" id=\"campo_1\" name=\"Cap\" placeholder=\"Default input\" aria-label=\"default input example\">

         <label for=\"campo_2\" class=\"form-label\">Nome:</label>
         <input class=\"form-control\" type=\"text\" id=\"campo_2\" name=\"Nome\" placeholder=\"Default input\" aria-label=\"default input example\">

         <label for=\"campo_3\" class=\"form-label\">Prov:</label>
         <input class=\"form-control\" type=\"text\" id=\"campo_3\" name=\"Prov\" placeholder=\"Default input\" aria-label=\"default input example\">

         <input type=\"hidden\" name=\"scelta\" value=\"AggiungiLocalità\">    
         <br />
         <button type=\"submit\" class=\"btn btn-primary\">Aggiungi al Database</button>
         </form>");
         break;
      }

      case "AggiungiLocalità":{
         $cap = $_REQUEST['Cap'];
         $nome = $_REQUEST['Nome'];
         $provincia = $_REQUEST['Prov'];

         $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
         $sql = "INSERT INTO p62e1_Localita(Cap, Nome, Prov) VALUES('$cap', '$nome', '$provincia')";

         //echo($sql);
         if($db->query($sql))
            echo("Inserimento avvenuto!");
         else
            echo("Problemi in inserimento record.");
         $db->close();
         break;
      }

      case "RimuoviLocalità":{
         echo("sinnegheeeee");
         break;
      }

      default:{
         // db località
         $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

         // Step 2 - Creo la sintassi SQL per la Query
         // VISUALIZZO GLI STESSI DATI DI PRIMA IN FORMATO TABELLA BOOTSTRAP
         $sql = "SELECT * FROM p62e1_Localita";
         $rs = $db->query($sql);

         echo("<table class=\"table table-success table-striped table-hover\">
            <thead>
               <tr>
                  <th scope=\"col\">Id</th>
                  <th scope=\"col\">Cap</th>
                  <th scope=\"col\">Nome</th>
                  <th scope=\"col\">Prov</th>
               </tr>
            </thead>");
            echo("<tbody>");
               $record = $rs->fetch_assoc();
               while($record){
                  echo("<tr>
                     <th scope=\"row\">".$record['Id']."</th>
                     <td>".$record['Cap']."</td>
                     <td>".$record['Nome']."</td>
                     <td>".$record['Prov']."</td>

                  </tr>");
                  $record = $rs->fetch_assoc();
               }      
            echo("</tbody>");
         echo("</table>");
         // Step 5 - Chiusura del collegamento con il db.
         $db->close();
         echo("<a class=\"Bottone\" href=\"page1.php?scelta=FormLocalita\" role=\"button\">Aggiungi Località</a> <br/> 
         <a class=\"Bottone\" href=\"page1.php?scelta=RimuoviLocalità\" role=\"button\">Rimuovi Località</a>");
         break;
      }

   }
?>
      </div>
   <!-- chiusura del body con inserimento richiami BootStrap Boundle JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   </body>
</html>