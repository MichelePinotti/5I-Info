import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;


public class client {
    public static void main(String[] args){
        int portNumber = 3000;
        String message = "";
        do{
            try{
                                            //System.out.println("ho cerato il socket d'invio");
                //creazione socket per inviare messaggi 
                Socket ClientSocket = new Socket("localhost", portNumber);
                //oggetto per scrivere su socket
                PrintWriter writer = new PrintWriter(ClientSocket.getOutputStream(), true);
                //oggetto per leggere su socket
                BufferedReader reader = new BufferedReader(new InputStreamReader(ClientSocket.getInputStream()));
                //oggetto per leggere su tastiera
                BufferedReader in = new BufferedReader(new InputStreamReader(System.in));

                //leggere da tastiera
                System.out.println("\ntu: ");
                message = in.readLine();

                //inviare messaggio su socket
                writer.println(message);
                writer.flush();

                //legge messaggio da socket
                String response;
                                        //System.out.println("leggo il messaggio");
                //stampa il messaggio letto
                System.out.println("\nterminale: ");
                response = reader.readLine();
                System.out.println(response);

                ClientSocket.close();
            }catch(IOException a){
                // System.out.println(a);
            };
        }while(message.equals("quit") != true);
    }
}
