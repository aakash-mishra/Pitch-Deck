import java.io.*;
import java.util.*;

public class Graph{

  public static void main(String[] args) {
      Scanner sc = new Scanner(System.in);
         int n = sc.nextInt();
         int m = sc.nextInt();
         int source = sc.nextInt();
         int dest = sc.nextInt();
         int a[][] = new int[n][m];
         for(int i=0;i<n;i++){
           for(int j=0;j<m;j++){
             a[i][j] = sc.nextInt();
           }
         }

         for(int i=0;i<n;i++){
           for(int j=0;j<m;j++){
             System.out.print(a[i][j]+" ");
           }
           System.out.println();
         }

         boolean visited[] = new boolean[n];
         int flag=0;
         ArrayDeque<Integer> queue = new ArrayDeque<Integer>();
         queue.offer(source);
         while(!queue.isEmpty()){
           System.out.println("Here");
           int x = queue.poll();

           visited[x]=true;
           if(x==dest)
           {
             flag=1;
             break;
           }

           for(int i=0;i<n;i++){
             if(a[x][i] == 1 && !visited[i])
             {
               queue.offer(i);
               visited[i]=true;
             }
           }
         }

         if(flag==1)
         System.out.println("Found");
         else
         System.out.println("Not found");


  }
}
