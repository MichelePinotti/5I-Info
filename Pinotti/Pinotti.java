import java.io.BufferedReader;
import java.io.FileWriter;
import java.io.InputStreamReader;
import java.io.FileReader;
import java.io.File;

public class Pinotti {
    public static void main(String[] args){
        try {
            BufferedReader inputReader = new BufferedReader(new InputStreamReader(System.in));  //strumento per leggere da tastiera
            String str;
            str = inputReader.readLine();

            try {       //controllo se la stringa è valida, se è un numero ti da errore
                Integer.parseInt(str);
                System.out.println("Stringa non valida");
            } catch (Exception e) {
                BufferedReader fileReader = new BufferedReader(new FileReader("Vocabolario.txt") );   //strumento per leggere il file
                File myfile = new File("paroleMaggiori.txt");      //creo secondo file
                FileWriter fileWriter = new FileWriter(myfile, true);      //strumento per scrivere il file
                String tmp = fileReader.readLine();
                while(tmp != null){
                    if(tmp.compareTo(str) > 0){
                        fileWriter.write(tmp);
                        fileWriter.write("\n");
                    }
                    tmp = fileReader.readLine();
                }
                fileReader.close();
                fileWriter.close();
            }
        } catch (Exception e) {
            System.out.println(e);
        }
    }
}
