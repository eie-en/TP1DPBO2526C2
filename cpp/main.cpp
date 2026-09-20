#include "Film.cpp"

int main() {
    // show menu
    cout << "\n====================================================" << endl;
    cout << "              Bukan RGP tapi tp1 DPBO" << endl;
    cout << "  Semoga mbg bubar, lantai kamar mandi do ur magic" << endl;
    cout << "====================================================" << endl;
    cout << "1. Show\n2. Search\n3. Add\n4. Delete\n5. Update" << endl;
    cout << "ketik 'malas' untuk keluar program" << endl;
    cout << "---------------------------------------" << endl;

    //data dummy biar ga kosong banget
    Film::daftarfilm.push_back(Film("F001", "What is Wrong with Secretary Teddy", "Londo Ireng", "Romance", 2026));
    Film::daftarfilm.push_back(Film("F002", "Charlie Kirk Adalah Kita", "Kirk", "Biography", 2025));

    // input string saja
    while (true) {
        cout << "Select: ";
        string select;
        getline(cin, select);
        for (int i = 0; i < select.length(); i++) {
            select[i] = tolower(select[i]);
        }

        // buat nentuin apa yang dipake
        if (select == "malas") {
            cout << "oke dadah" << endl;
            break;
        } else if (select == "show") {
            Film::displayArr();
        } else if (select == "search") {
            cout << "Search code/film: ";
            string search;
            getline(cin, search);
            for (int i = 0; i < search.length(); i++) {
                search[i] = tolower(search[i]);
            }

            if (search == "code") {
                Film::searchKode();
            } else if (search == "film") {
                Film::searchF();
            } else {
                cout << "??? gaada pilihan begitu" << endl;
            }
            cout << "---------------------------------------\n" << endl;
        } else if (select == "add") {
            Film::addFilm();
            cout << "---------------------------------------\n" << endl;
        } else if (select == "delete") {
            Film::deleteFilm();
            cout << "---------------------------------------\n" << endl;
        } else if (select == "update") {
            Film::updateFilm();
            cout << "---------------------------------------\n" << endl;
        } else {
            cout << "kamu goy, itu pilihan apa\n" << endl;
        }
    }

    return 0;
}