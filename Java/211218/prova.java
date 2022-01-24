import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;


public class prova {
    public static void main(String[] args){
        int portNumber = 3000;
        String message = "";
        do{
            try{
                                            //System.out.println("ho cerato il socket d'invio");
                //creazione socket per inviare messaggi 
                Socket ClientSocket = new Socket("192.168.230.51", portNumber);
                //oggetto per scrivere su socket
                PrintWriter writer = new PrintWriter(ClientSocket.getOutputStream(), true);
                //oggetto per leggere su socket
                BufferedReader reader = new BufferedReader(new InputStreamReader(ClientSocket.getInputStream()));
                //oggetto per leggere su tastiera
                BufferedReader in = new BufferedReader(new InputStreamReader(System.in));

                //legge messaggio da socket
                String response;
                                        //System.out.println("leggo il messaggio");
                //stampa il messaggio letto
                System.out.println("\nterminale: ");
                response = "null";
                while(response.length()> 0){
                    response = reader.readLine();
                    System.out.println(response);
                }

                
                //leggere da tastiera
                System.out.println("\ntu: ");
                message = in.readLine();

                //inviare messaggio su socket
                writer.println(message);
                writer.flush();


                ClientSocket.close();
            }catch(IOException a){
                // System.out.println(a);
            };
        }while(message.equals("quit") != true);
    }
}
