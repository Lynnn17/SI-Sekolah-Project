package view;
class Pembagian {
    //mendefinisikan method dengan dua parameter bernilai int
        int bagi (int a, int b) {
        return a/b;
        }
        //mendefinisikan method dengan dua parameter bertipe double
        double bagi (double a, double b){
        return a/b;
        }
    }
    
    class DemoOverLoad1 {
        public static void main(String[] args) {
            Pembagian b = new Pembagian();
            int x = b.bagi(10,4);
            double y = b.bagi(10.0, 4.0);
            System.out.println("Hasil bagi tipe int = " + x);
            System.out.println("Hasil bagi tipe double = " + y);
        }
    }
    