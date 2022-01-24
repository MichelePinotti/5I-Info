import java.io.BufferedReader;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.Writer;

public class filewriter{
    public static void main(String args[]){
        InputStreamReader in = new InputStreamReader(System.in);
        BufferedReader inputReader = new BufferedReader(in);
        String inputstr = "";
        String stopstr = "stop";
        
        while( inputstr.equals(stopstr) == false){
            System.out.println("scrivi la parola da scrivere sul file");
            try{
                inputstr = inputReader.readLine();
            }catch(IOException e){
                System.out.println("errore lettura" + e);
            }
            if(inputstr.equals(stopstr) == false){
                try{
                    File myfile = new File("words.txt");
                    FileWriter fw = new FileWriter(myfile, true);
                    fw.write(inputstr);
                    fw.write("\n");
                    fw.close();
                }catch(IOException e){
                    System.out.println("errore scrittura" + e);
                }
            }
        }
    }
}
