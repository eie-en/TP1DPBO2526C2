import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        // show menu
        System.out.println("\n====================================================");
        System.out.println("              Bukan RGP tapi tp1 DPBO");
        System.out.println("  Semoga mbg bubar, lantai kamar mandi do ur magic");
        System.out.println("====================================================");
        System.out.println("1. Show\n2. Search\n3. Add\n4. Delete\n5. Update");
        System.out.println("ketik 'malas' untuk keluar program");
        System.out.println("---------------------------------------");

        // data dummy biar ga kosong banget
        Film.daftarfilm.add(new Film("F001", "What is Wrong with Secretary Teddy", "Londo Ireng", "Romance", 2026));
        Film.daftarfilm.add(new Film("F002", "Charlie Kirk Adalah Kita", "Kirk", "Biography", 2025));

        // input string saja
        while (true) {
            System.out.print("Select: ");
            String select = scanner.nextLine().toLowerCase();

            // buat nentuin apa yang dipake
            switch (select) {
                case "malas":
                    System.out.println("oke dadah");
                    return;
                case "show":
                    Film.displayArr();
                    break;
                case "search":
                    System.out.print("Search code/film: ");
                    String search = scanner.nextLine().toLowerCase();
                    if (search.equals("code")) {
                        Film.searchKode();
                    } else if (search.equals("film")) {
                        Film.searchF();
                    } else {
                        System.out.println("??? gaada pilihan begitu");
                    }
                    System.out.println("---------------------------------------\n");
                    break;
                case "add":
                    Film.addFilm();
                    System.out.println("---------------------------------------\n");
                    break;
                case "delete":
                    Film.deleteFilm();
                    System.out.println("---------------------------------------\n");
                    break;
                case "update":
                    Film.updateFilm();
                    System.out.println("---------------------------------------\n");
                    break;
                default:
                    System.out.println("kamu goy, itu pilihan apa\n");
                    break;
            }
        }
    }
}