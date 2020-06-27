import java.util.Scanner;

public class sumNat {
    public static void main(String Str[]){
        Scanner sc = new Scanner(System.in);
        int n = sc.nextInt();
        String bin = Integer.toBinaryString(n);
        String s ="";
        for(int i=0;i<bin.length();i++){
            if(i%2==0){
                if(bin.charAt(i)=='1'){
                    s+='0';
                }
                else
                s+=bin.charAt(i);
            }
            else
            s+=bin.charAt(i);
        }
       // System.out.println(s);
        String binaryNumber = s; 
        System.out.println(Integer.parseInt(binaryNumber, 2)); 

    }
}