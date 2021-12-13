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

            case "FormCliente":{
         ?>
               <form action="page2.php" method="get">
                  <div class="mb-3">
                  <label for="txt1" class="form-label">Cognome Nome</label>
                  <input class="form-control" type="text" placeholder="Default input" id="txt1" name="ragioneSociale" aria-label="default input example">
                  
                  <label for="txt2" class="form-label">Indirizzo</label>
                  <input class="form-control" type="text" placeholder="Default input" id="txt2" name="indirizzo" aria-label="default input example">
                  
                  <label for="txt3" class="form-label">Telefono</label>
                  <input class="form-control" type="text" placeholder="Default input" id="txt3" name="numeroTelefono" aria-label="default input example">
                  
                  <label for="txt4" class="form-label">Partita Iva</label>
                  <input class="form-control" type="text" placeholder="Default input" id="txt4" name="partitaIva" aria-label="default input example">
                  
                  <label for="txt5" class="form-label">Id Agente</label>
                  <input class="form-control" type="text" placeholder="Default input" id="txt5" name="idAgente" aria-label="default input example">
                  
                  <label for="txt6" class="form-label">Fido</label>
                  <input class="form-control" type="text" placeholder="Default input" id="txt6" name="fido" aria-label="default input example">
                  
                  <?php
                  //le località disponibili le devo estrarre dal database -->
                  $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
                  $sql = "SELECT * FROM p62e1_Localita ORDER BY nome ASC";
                  $rs = $db->query($sql);
                  $db->close();
                  echo("\n\n");
                  echo("<label for=\"sel1\" class=\"form-label\">Paese</label>\n");
                  echo("\t<select class=\"form-select\" id=\"sel1\" name=\"idLocalita\" aria-label=\"Default select example\">\n");
                     $record = $rs->fetch_assoc();
                     while($record){
                        echo("\t\t<option value=\"".$record['Id']."\">".$record['Nome']." (".$record['Prov'].")</option>\n");
                        $record = $rs->fetch_assoc();
                     }
                  echo("\t</select>\n\n");
                  ?>
                  <input type="hidden" name="scelta" value="AggiungiCliente">
                  <button type="submit" class="btn btn-primary">Inserisci Cliente</button>
               </form>
         <?php
               break;
            }
     
            case "AggiungiCliente":{
               $rsoc = $_REQUEST['ragioneSociale'];
               $ind = $_REQUEST['indirizzo'];
               $num = $_REQUEST['numeroTelefono'];
               $piva = $_REQUEST['partitaIva'];
               $ida = $_REQUEST['idAgente'];
               $fido = $_REQUEST['fido'];
               $idl = $_REQUEST['idLocalita'];
      
               $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
               $sql = "INSERT INTO p62e1_Cliente(RagioneSociale, indirizzo, numTelefono, PartitaIva, idAgente, Fido, idLocalita) 
                       VALUES('$rsoc', '$ind', '$num', '$piva', '$ida', '$fido', '$idl')";
      
               echo($sql);
               if($db->query($sql))
                  echo("Inserimento avvenuto!");
               else
                  echo("Problemi in inserimento record.");
               $db->close();
               break;
            }

         
            case "FormRimuoviCliente": {
               //le località disponibili le devo estrarre dal database -->
               $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
               $sql = "SELECT * FROM p62e1_cliente ORDER BY nome ASC";
               $rs = $db->query($sql);
               $db->close();
               echo("\n\n");
               echo("<label for=\"sel2\" class=\"form-label\">Rimuovi Cliente</label>\n");
               echo("\t<select class=\"form-select\" id=\"sel2\" name=\"ClienteRimosso\" aria-label=\"Default select example\">\n");
                  $record = $rs->fetch_assoc();
                  while($record){
                     echo("\t\t<option value=\"".$record['Id']."\">".$record['RagioneSociale']);   //problemi
                     $record = $rs->fetch_assoc();
                  }
               echo("\t</select>\n\n");
         ?>
               <input type="hidden" name="scelta" value="RimuoviCliente">
               <button type="submit" class="btn btn-primary">Rimuovi Cliente</button>
         <?php
               break;
            }
            
            case "RimuoviCliente":{

               break;
            }

            default:{
               // step 1 - CREARE COLLEGAMENTO TRA PHP E MYSQL
               // UTILIZZANDO UN OGGETTO MYSQLI
               $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
      
               // Step 2 - Creo la sintassi SQL per la Query
               $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
               $sql = "SELECT c.Id, c.RagioneSociale, c.indirizzo, c.numTelefono, c.PartitaIva, c.idAgente, c.Fido, l.Cap, l.Nome  
                        FROM p62e1_Localita AS l, p62e1_Cliente AS c
                        WHERE c.idLocalita=l.Id";
      
               // Step 3 - Eseguo la query utilizzando l'oggeto db
               // $rs -> ResultSet -> Insieme dei record che soddifano la query in caso positivo.
               $rs = $db->query($sql);
      
               // Step 4 - Sfoglio/estrapolazione dei risultati
               $record = $rs->fetch_assoc();
         
               // VISUALIZZO GLI STESSI DATI DI PRIMA IN FORMATO TABELLA BOOTSTRAP
      
               echo("<table class=\"table table-success table-striped table-hover\">
               <thead>
                  <tr>
                     <th scope=\"col\">Id</th>
                     <th scope=\"col\">Ragione Sociale</th>
                     <th scope=\"col\">indirizzo</th>
                     <th scope=\"col\">numTelefono</th>
                     <th scope=\"col\">PartitaIva</th>
                     <th scope=\"col\">idAgente</th>
                     <th scope=\"col\">Fido</th>
                     <th scope=\"col\">Cap</th>
                     <th scope=\"col\">Paese</th>
                  </tr>
               </thead>");
               echo("<tbody>");
                  $record = $rs->fetch_assoc();
                  while($record){
                     echo("<tr>
                        <th scope=\"row\">".$record['Id']."</th>
                        <td>".$record['RagioneSociale']."</td>
                        <td>".$record['indirizzo']."</td>
                        <td>".$record['numTelefono']."</td>
                        <td>".$record['PartitaIva']."</td>
                        <td>".$record['idAgente']."</td>
                        <td>".$record['Fido']."</td>
                        <td>".$record['Cap']."</td>
                        <td>".$record['Nome']."</td>
      
                     </tr>");
                     $record = $rs->fetch_assoc();
                  }      
               echo("</tbody>");
               echo("</table>");
               // Step 5 - Chiusura del collegamento con il db.
               $db->close();
      
               echo("<a class=\"Bottone\" href=\"page2.php?scelta=FormCliente\" role=\"button\">Aggiungi Cliente</a> <br/> 
                <a class=\"Bottone\" href=\"page2.php?scelta=FormRimuoviCliente\" role=\"button\">Rimuovi Cliente</a>");
               break;
            }
      
         }
        ?>
      </div>

   <!-- chiusura del body con inserimento richiami BootStrap Boundle JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   </body>
</html>