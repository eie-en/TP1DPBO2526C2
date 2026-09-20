#include <iostream>
#include <vector>
#include <string>

using namespace std;

class Film {
private:
    string kode; //kode unik
    string judul;
    string director;
    string genre; //genrenya satu genre utama aja
    int tahun;

public:
    static vector<Film> daftarfilm; //buat array

    // constructor & destructor
    Film() {
        this->kode = "";
        this->judul = "";
        this->director = "";
        this->genre = "";
        this->tahun = 0;
    }

    Film(string kode, string judul, string director, string genre, int tahun) {
        this->kode = kode;
        this->judul = judul;
        this->director = director;
        this->genre = genre;
        this->tahun = tahun;
    }

    ~Film() {}

    //ini getter haha
    string getcode() {
        return this->kode;
    }

    string getJewdul() { //judul
        return this->judul;
    }

    string getDirector() { //direktor
        return this->director;
    }

    string getGenre() { //genre
        return this->genre;
    }

    int getYear() { //tahun
        return this->tahun;
    }

    //setter, urutannya sama dah kayak getter
    void setcode(string kode) {
        this->kode = kode;
    }

    void setJew(string judul) {
        this->judul = judul;
    }

    void setDir(string director) {
        this->director = director;
    }

    void setGenre(string genre) {
        this->genre = genre;
    }

    void setYr(int tahun) {
        this->tahun = tahun;
    }

    //CRUD
    //display
    static void displayArr() {
        if (daftarfilm.empty()) {
            cout << "Daftar film kosong." << endl;
            return;
        }

        for (int i = 0; i < daftarfilm.size(); i++) {
            cout << "---------------------------" << endl;
            cout << daftarfilm[i].getcode() << endl;
            cout << "Judul    : " << daftarfilm[i].getJewdul() << endl;
            cout << "Sutradara: " << daftarfilm[i].getDirector() << endl;
            cout << "Genre    : " << daftarfilm[i].getGenre() << endl;
            cout << "Tahun    : " << daftarfilm[i].getYear() << endl;
        }
        cout << "---------------------------" << endl;
    }

    //ini search berdasarkan kode  
    static void searchKode() {
        cout << "--- Search Bar ---" << endl;
        cout << "Cari kode film(ex -> F001): ";
        string code;
        getline(cin, code);
        for (int i = 0; i < code.length(); i++) {
            code[i] = toupper(code[i]);
        }

        bool found = false;
        for (int i = 0; i < daftarfilm.size(); i++) {
            if (code == daftarfilm[i].getcode()) {
                cout << daftarfilm[i].getcode() << endl;
                cout << "Judul    : " << daftarfilm[i].getJewdul() << endl;
                cout << "Sutradara: " << daftarfilm[i].getDirector() << endl;
                cout << "Genre    : " << daftarfilm[i].getGenre() << endl;
                cout << "Tahun    : " << daftarfilm[i].getYear() << endl;
                found = true;
                break; //kalo ketemu, loop langsung berenti, karena kode sifatnya unique
            }
        }
        if (!found) {
            cout << "gaada mas" << endl;
        }
    }

    static void searchF() {
        cout << "Cari judul film: ";
        string flm;
        getline(cin, flm);

        bool found = false;
        for (int i = 0; i < daftarfilm.size(); i++) {
            if (flm == daftarfilm[i].getJewdul()) {
                cout << daftarfilm[i].getcode() << endl;
                cout << "Judul    : " << daftarfilm[i].getJewdul() << endl;
                cout << "Sutradara: " << daftarfilm[i].getDirector() << endl;
                cout << "Genre    : " << daftarfilm[i].getGenre() << endl;
                cout << "Tahun    : " << daftarfilm[i].getYear() << endl;
                found = true; //gaada break, bisa aja sama judul tapi remake atau apa gitu
            }
        }
        if (!found) {
            cout << "gaada mas" << endl;
        }
    }

    // Tambah Data (Create)
    static void addFilm() {
        cout << "--- Tambah Film Baru ---" << endl;
        cout << "Masukkan Kode (ex: F001): ";
        string kode;
        getline(cin, kode);
        for (int i = 0; i < kode.length(); i++) {
            kode[i] = toupper(kode[i]);
        }

        //biar kode gaada sama
        for (int i = 0; i < daftarfilm.size(); i++) {
            if (daftarfilm[i].getcode() == kode) {
                cout << "Error: Kode film sudah terdaftar!" << endl;
                return;
            }
        }

        //input
        cout << "Masukkan Judul Film: ";
        string judul;
        getline(cin, judul);

        cout << "Masukkan Sutradara: ";
        string director;
        getline(cin, director);

        cout << "Masukkan Genre: ";
        string genre;
        getline(cin, genre);

        int tahun;
        cout << "Masukkan Tahun Rilis: ";
        if (!(cin >> tahun)) { //error handling biar tahun sesuai format intejer
            cout << "Error: Tahunnya angka mas" << endl;
            cin.clear();
            cin.ignore(1000, '\n');
            return;
        }
        cin.ignore();

        //tambah ke array
        Film film_baru(kode, judul, director, genre, tahun);
        daftarfilm.push_back(film_baru);
        cout << "!! Homre. Film udah ditambah yah !!" << endl;
    }

    // Hapus Data (Delete)
    static void deleteFilm() {
        cout << "--- Hapus Film ---" << endl;
        cout << "Masukkan Kode film yang ingin dihapus: ";
        string kode;
        getline(cin, kode);
        for (int i = 0; i < kode.length(); i++) {
            kode[i] = toupper(kode[i]);
        }

        for (int i = 0; i < daftarfilm.size(); i++) {
            if (daftarfilm[i].getcode() == kode) {
                daftarfilm.erase(daftarfilm.begin() + i);
                cout << "!! Oke, Film dengan kode " << kode << " udah dihapus !!" << endl;
                return;
            }
        }
        cout << "gaada mas" << endl;
    }

    // Update Data
    static void updateFilm() {
        cout << "--- Update Data Film ---" << endl;
        cout << "Masukkan Kode film yang ingin diupdate: ";
        string kode;
        getline(cin, kode);
        for (int i = 0; i < kode.length(); i++) {
            kode[i] = toupper(kode[i]);
        }

        for (int i = 0; i < daftarfilm.size(); i++) {
            if (daftarfilm[i].getcode() == kode) {
                //search
                cout << "Data lama ditemukan:" << endl;
                cout << "Judul    : " << daftarfilm[i].getJewdul() << endl;
                cout << "Sutradara: " << daftarfilm[i].getDirector() << endl;
                cout << "Genre    : " << daftarfilm[i].getGenre() << endl;
                cout << "Tahun    : " << daftarfilm[i].getYear() << endl;
                cout << "---------------------------" << endl;
                cout << "Masukkan data baru (kosongkan / tekan Enter jika tidak ingin diubah):" << endl;

                cout << "Judul baru [" << daftarfilm[i].getJewdul() << "]: ";
                string judul_baru;
                getline(cin, judul_baru);
                if (!judul_baru.empty()) {
                    daftarfilm[i].setJew(judul_baru);
                }

                cout << "Sutradara baru [" << daftarfilm[i].getDirector() << "]: ";
                string director_baru;
                getline(cin, director_baru);
                if (!director_baru.empty()) {
                    daftarfilm[i].setDir(director_baru);
                }

                cout << "Genre baru [" << daftarfilm[i].getGenre() << "]: ";
                string genre_baru;
                getline(cin, genre_baru);
                if (!genre_baru.empty()) {
                    daftarfilm[i].setGenre(genre_baru);
                }

                cout << "Tahun baru [" << daftarfilm[i].getYear() << "]: ";
                string tahun_baru;
                getline(cin, tahun_baru);
                if (!tahun_baru.empty()) {
                    daftarfilm[i].setYr(stoi(tahun_baru));
                }

                cout << "!! Homre. Data film berhasil diupdate !!" << endl;
                return;
            }
        }
        cout << "gaada mas" << endl;
    }
};

// inisialisasi array static
vector<Film> Film::daftarfilm;