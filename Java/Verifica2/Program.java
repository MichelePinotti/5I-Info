import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.InputStreamReader;

/*  CONSEGNA:   
    Realizzare un programma Java che richieda da tastiera una parola, successivamente deve accedere al file di
    testo Vocabolario.txt nel quale sono già presenti alcune parole (una su ogni singola riga), quindi deve creare
    un secondo file di testo contenente solo le parole che risultano essere di lunghezza inferiore alla parola
    inserita, specificando anche di quanti caratteri differiscono.
*/


/* PROCEDIMENTO
    1: richiedi parola da tastiera
    2: crea file vocabolario.txt e inserisci delle parole    (metodo)
    3: crea secondo file     (metodo)
    4: controlla lunghezza di ogni parola    (metodo)
    5: se lunghezza è minore la metti nel nuovo file     
    6: stampa differenza di lunghezza della parola selezionata e quella scelta da utente     (metodo)
*/
public class Program{
   public static void main(String[] args){
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        String str = "";
        try {
            str = br.readLine();
            File myFile = Program.createFile("vocabolario.txt");
            File createdFile = Program.createFile("minori.txt");
            
            //riempimento file vocabolario
            Program.writeFile(myFile, "ciao");
            Program.writeFile(myFile, "gino");
            Program.writeFile(myFile, "albero");
            Program.writeFile(myFile, "macaco");
            Program.writeFile(myFile, "zanzara");
            Program.writeFile(myFile, "dugongo");

            //riempimento file minori
            Program.wordCounter(myFile, createdFile, str);
        } catch (Exception e) {
            System.out.println(e);
        }
   }

   static File createFile(String fileName){
       File myFile = new File(fileName);
       return myFile;
   }

   static void writeFile(File fileName, String word){
        try {
            FileWriter fw = new FileWriter(fileName, true);
            fw.write(word);
            fw.write("\n");
            fw.flush();
            fw.close();
        } catch (Exception e) {
            System.out.println(e);
        }
   }

   static void wordCounter(File fileName1 ,File fileName2, String originalWord){
       try {
            BufferedReader br = new BufferedReader(new FileReader(fileName1));
            String str = br.readLine();
            while(str != null){
                if(str.length() < originalWord.length()){
                    Program.writeFile(fileName2, str);
                    
                }
                System.out.println((originalWord.length() - str.length()));
                str = br.readLine();
            }
            br.close();
       } catch (Exception e) {
            System.out.println(e);
       }
   }
}
