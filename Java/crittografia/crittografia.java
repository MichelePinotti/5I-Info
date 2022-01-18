import java.io.BufferedReader;
import java.io.InputStreamReader;

public class crittografia{
    public static void main(String[] args){
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str; 
        char arr[];
        int ascii;  // da 97 a 122
        String tmp; //stringa di quanto vuoi shiftare
        int shift;  //stringa convertita in int di quanto vuoi shiftare
        try{
            str = br.readLine();
            tmp = br.readLine();
            shift = Integer.parseInt(tmp);
            tmp = str;
            arr = str.toCharArray();
            int i = 0;
            while(i<tmp.length()){
                ascii = (int) arr[i];
                ascii = ascii + shift;
                
                if(ascii+shift > 122){
                    ascii = (ascii - 122) + 97 - 1;
                }
                arr[i] = (char) ascii;
                i = i + 1;
            }
            String str2 = String.valueOf(arr);
            System.out.println(str2);
        }catch(Exception e){
            System.out.println(e);
        }
    }
}