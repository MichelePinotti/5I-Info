import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;

public class server{
    public static void main(String[] args){
        int portNumber = 3000;
        while(true){
            try{
                
                ServerSocket serverSocket = new ServerSocket(portNumber);
                Socket clientSocket = serverSocket.accept();
                BufferedReader in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
                String acaso;
                while((acaso = in.readLine()).length() > 0 ){
                    System.out.println(acaso);
                }
                PrintWriter out = new PrintWriter(clientSocket.getOutputStream(), true);
                //leggere file html
                BufferedReader br = new BufferedReader(new FileReader("response.html"));
                String res = "", tmp = "";      //xk se qui non metto " = "" " mi da errore?"
                tmp = br.readLine();
                while (tmp != null) {
                    res = res + tmp;
                    tmp = br.readLine();
                }
                br.close();
                //inviare risposta
                out.println("HTTP/1.1 200 OK");
                out.println("Content-Type: text/html");
                out.println("Content-Lenght: " + res.length());
                out.println("");
                out.print(res);
                out.flush();
                out.close();
            }catch(IOException a){
                // System.out.println(a);
            };
        }
    }
}