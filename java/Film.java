import java.util.ArrayList;
import java.util.Scanner;

public class Film {
    private String kode;      // kode unik
    private String judul;
    private String director;
    private String genre;     // genrenya satu genre utama aja
    private int tahun;

    public static ArrayList<Film> daftarfilm = new ArrayList<>(); // buat array
    private static Scanner scanner = new Scanner(System.in);

    // constructor
    public Film(String kode, String judul, String director, String genre, int tahun) {
        this.kode = kode;
        this.judul = judul;
        this.director = director;
        this.genre = genre;
        this.tahun = tahun;
    }

    // ini getter haha
    public String getcode() { // judul
        return this.kode;
    }

    public String getJewdul() { // judul
        return this.judul;
    }

    public String getDirector() { // direktor
        return this.director;
    }

    public String getGenre() { // genre
        return this.genre;
    }

    public int getYear() { // tahun
        return this.tahun;
    }

    // setter, urutannya sama dah kayak getter
    public void setcode(String kode) {
        this.kode = kode;
    }

    public void setJew(String judul) {
        this.judul = judul;
    }

    public void setDir(String director) {
        this.director = director;
    }

    public void setGenre(String genre) {
        this.genre = genre;
    }

    public void setYr(int tahun) {
        this.tahun = tahun;
    }

    // CRUD
    // display
    public static void displayArr() {
        if (daftarfilm.isEmpty()) {
            System.out.println("Daftar film kosong.");
            return;
        }

        for (Film film : daftarfilm) {
            System.out.println("---------------------------");
            System.out.println(film.getcode());
            System.out.println("Judul    : " + film.getJewdul());
            System.out.println("Sutradara: " + film.getDirector());
            System.out.println("Genre    : " + film.getGenre());
            System.out.println("Tahun    : " + film.getYear());
        }
        System.out.println("---------------------------");
    }

    // ini search berdasarkan kode  
    public static void searchKode() {
        System.out.println("--- Search Bar ---");
        System.out.print("Cari kode film(ex -> F001): ");
        String code = scanner.nextLine().toUpperCase();

        boolean found = false;
        for (Film film : daftarfilm) {
            if (code.equals(film.getcode())) {
                System.out.println(film.getcode());
                System.out.println("Judul    : " + film.getJewdul());
                System.out.println("Sutradara: " + film.getDirector());
                System.out.println("Genre    : " + film.getGenre());
                System.out.println("Tahun    : " + film.getYear());
                found = true;
                break; // kalo ketemu, loop langsung berenti, karena kode sifatnya unique
            }
        }
        if (!found) {
            System.out.println("gaada mas");
        }
    }

    public static void searchF() {
        System.out.print("Cari judul film: ");
        String flm = scanner.nextLine();

        boolean found = false;
        for (Film film : daftarfilm) {
            if (flm.equals(film.getJewdul())) {
                System.out.println(film.getcode());
                System.out.println("Judul    : " + film.getJewdul());
                System.out.println("Sutradara: " + film.getDirector());
                System.out.println("Genre    : " + film.getGenre());
                System.out.println("Tahun    : " + film.getYear());
                found = true; // gaada break, bisa aja sama judul tapi remake atau apa gitu
            }
        }
        if (!found) {
            System.out.println("gaada mas");
        }
    }

    // Tambah Data (Create)
    public static void addFilm() {
        System.out.println("--- Tambah Film Baru ---");
        System.out.print("Masukkan Kode (ex: F001): ");
        String kode = scanner.nextLine().trim().toUpperCase();

        // biar kode gaada sama
        for (Film film : daftarfilm) {
            if (film.getcode().equals(kode)) {
                System.out.println("Error: Kode film sudah terdaftar!");
                return;
            }
        }

        // input
        System.out.print("Masukkan Judul Film: ");
        String judul = scanner.nextLine().trim();
        System.out.print("Masukkan Sutradara: ");
        String director = scanner.nextLine().trim();
        System.out.print("Masukkan Genre: ");
        String genre = scanner.nextLine().trim();

        int tahun = 0;
        try {
            System.out.print("Masukkan Tahun Rilis: ");
            tahun = Integer.parseInt(scanner.nextLine().trim());
        } catch (NumberFormatException e) { // error handling biar tahun sesuai format intejer
            System.out.println("Error: Tahunnya angka mas");
            return;
        }

        // tambah ke array
        Film film_baru = new Film(kode, judul, director, genre, tahun);
        daftarfilm.add(film_baru);
        System.out.println("!! Homre. Film udah ditambah yah !!");
    }

    // Hapus Data (Delete)
    public static void deleteFilm() {
        System.out.println("--- Hapus Film ---");
        System.out.print("Masukkan Kode film yang ingin dihapus: ");
        String kode = scanner.nextLine().trim().toUpperCase();

        for (int i = 0; i < daftarfilm.size(); i++) {
            if (daftarfilm.get(i).getcode().equals(kode)) {
                daftarfilm.remove(i);
                System.out.println("!! Oke, Film dengan kode " + kode + " udah dihapus !!");
                return;
            }
        }
        System.out.println("gaada mas");
    }

    // Update Data
    public static void updateFilm() {
        System.out.println("--- Update Data Film ---");
        System.out.print("Masukkan Kode film yang ingin diupdate: ");
        String kode = scanner.nextLine().trim().toUpperCase();

        for (Film film : daftarfilm) {
            if (film.getcode().equals(kode)) {
                // search
                System.out.println("Data lama ditemukan:");
                System.out.println("Judul    : " + film.getJewdul());
                System.out.println("Sutradara: " + film.getDirector());
                System.out.println("Genre    : " + film.getGenre());
                System.out.println("Tahun    : " + film.getYear());
                System.out.println("---------------------------");
                System.out.println("Masukkan data baru (kosongkan / tekan Enter jika tidak ingin diubah):");

                System.out.print("Judul baru [" + film.getJewdul() + "]: ");
                String judul_baru = scanner.nextLine().trim();
                if (!judul_baru.isEmpty()) {
                    film.setJew(judul_baru);
                }

                System.out.print("Sutradara baru [" + film.getDirector() + "]: ");
                String director_baru = scanner.nextLine().trim();
                if (!director_baru.isEmpty()) {
                    film.setDir(director_baru);
                }

                System.out.print("Genre baru [" + film.getGenre() + "]: ");
                String genre_baru = scanner.nextLine().trim();
                if (!genre_baru.isEmpty()) {
                    film.setGenre(genre_baru);
                }

                System.out.print("Tahun baru [" + film.getYear() + "]: ");
                String tahun_baru = scanner.nextLine().trim();
                if (!tahun_baru.isEmpty()) {
                    try {
                        film.setYr(Integer.parseInt(tahun_baru));
                    } catch (NumberFormatException ignored) {}
                }

                System.out.println("!! Homre. Data film berhasil diupdate !!");
                return;
            }
        }
        System.out.println("gaada mas");
    }
}