from Film import Film

def main():
        # show menu
        print("\n====================================================")
        print("              Bukan RGP tapi tp1 DPBO")
        print("  Semoga mbg bubar, lantai kamar mandi do ur magic")
        print("====================================================")
        print("1. Show\n2. Search\n3. Add\n4. Delete\n5. Update")
        print("ketik 'malas' untuk keluar program")
        print("---------------------------------------")

        #data dummy biar ga kosong banget
        Film.daftarfilm.append(Film("F001", "What is Wrong with Secretary Teddy", "Londo Ireng", "Romance", 2026))
        Film.daftarfilm.append(Film("F002", "Charlie Kirk Adalah Kita", "Kirk", "Biography", 2025))
        # input string saja
        while True:
            select = input("Select: ").lower()

            # buat nentuin apa yang dipake
            match select:           
                case "malas":
                    print("oke dadah")
                    break
                case "show":
                    Film.displayArr()
                case "search":
                    search = input("Search code/film: ").lower()
                    if search == 'code':
                        Film.searchKode()
                    elif search == 'film':
                        Film.searchF()
                    else: 
                        print("??? gaada pilihan begitu")
                    print("---------------------------------------\n")
                case "add":
                    Film.addFilm()
                    print("---------------------------------------\n")
                case "delete":
                    Film.deleteFilm()
                    print("---------------------------------------\n")
                case "update":
                    Film.updateFilm()
                    print("---------------------------------------\n")
                case _:
                    print("kamu goy, itu pilihan apa\n")

if __name__ == "__main__":
    main()