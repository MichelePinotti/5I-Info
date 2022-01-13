import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;

public class server{
    public static void main(String[] args){
        int portNumber = 3000;
        while(true){
            try{
                //creo socket d'ascolto
                ServerSocket serverSocket = new ServerSocket(portNumber);
                Socket ClientSocket = serverSocket.accept();
                //oggetto per leggere su tastiera
                BufferedReader in = new BufferedReader(new InputStreamReader(System.in));
                //oggetto per leggere su socket
                BufferedReader reader = new BufferedReader(new InputStreamReader(ClientSocket.getInputStream()));
                //oggetto per scrivere su socket
                PrintWriter writer = new PrintWriter(ClientSocket.getOutputStream(), true);
                
                
                //leggo messaggio da socket
                String message;
                System.out.println("\nterminale: ");
                message = reader.readLine();
                if(message.equals("quit") != true){
                    System.out.println(message);

                    //leggere da tastiera
                    String response = "";
                    System.out.println("\ntu: ");
                    response = in.readLine();
                    //inviare risposta su socket
                    writer.println(response);
                    writer.flush();
                    writer.close();
                    serverSocket.close();
                }else{
                    System.out.println("connessione chiusa");
                    serverSocket.close();
                    break;
                }
            }catch(IOException a){
                // System.out.println(a);
            };
        }
    }
}       //come chiudere la connessione