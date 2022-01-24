import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.InputStreamReader;

/*Realizzare un programma Java che all'avvio richiede una stringa 'filename' intesa come nome di un file, ed un numero N.
Il programma deve aprire il file 'filename' e leggendo parola per parola dal file indicato visualizza solo quelle parole che 
hanno lunghezza maggiore o uguale ad N. Inoltre crea un secondo file chiamato minime.txt che contenga solo quelle parole che 
hanno lunghezza minori o uguale ad N.
es:
filename = "elencoparole.txt" -> il programma Java apre un file con questo nome, posto nella stessa cartella del file java.*/

public class program {
    public static void main (String[] args){
        BufferedReader terminalreader = new BufferedReader(new InputStreamReader(System.in) );   //strumento per leggere da tastiera
        
        try {
            String filename = terminalreader.readLine();    //leggo il filename da tastiera
            filename = filename + ".txt";
            Integer n = Integer.parseInt(terminalreader.readLine());
            BufferedReader filereader = new BufferedReader(new FileReader(filename) );   //strumento per leggere da tastiera
            FileWriter fr = new FileWriter("minori.txt", true);
            String line = new String();    //tutta la riga del file di testo
            String[] parola;   //dove andranno messe le parole divise

            System.out.print("parole: ");
            line = filereader.readLine();
            while(line != null){    //legge tutte le linee del documento di testo
                parola = line.split(" ");
                for(Integer i = 0; i < parola.length; i++){
                    if(parola[i].length() >= n){
                        System.out.print(parola[i] + ", ");//stampo parole maggiori uguali a n
                    }else{
                        fr.write(parola[i] + "\n");    //scrive sul file le parole minori di n
                    }
                }
                line = filereader.readLine();
            }
            terminalreader.close();
            filereader.close();
            fr.close();
        } catch (Exception e) {
            System.out.println(e);
        }
    }
}