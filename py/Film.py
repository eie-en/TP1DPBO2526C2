class Film:
    def __init__(self, kode:str, judul:str, director:str, genre:str, tahun:int):
        self.__kode = str(kode) #kode unik
        self.__judul =  str(judul)
        self.__director = str(director)
        self.__genre = str(genre) #genrenya satu genre utama aja
        self.__tahun = int(tahun)

    daftarfilm = [] #buat array

    #ini getter haha
    def getcode(self) -> str:
        return self.__kode
    
    def getJewdul(self) -> str: #judul
        return self.__judul

    def getDirector(self) -> str: #direktor
        return self.__director

    def getGenre(self) -> str: #genre
        return self.__genre

    def getYear(self) -> int: #tahun
        return self.__tahun

    #setter, urutannya sama dah kayak getter
    def setcode(self, kode:str) -> None:
        self.__kode = str(kode)
    
    def setJew(self, judul:str) -> None:
        self.__judul = str(judul)

    def setDir(self, director:str) -> None:
        self.__director = str(director)

    def setGenre(self, genre:str) -> None:
        self.__genre = str(genre)

    def setYr(self, tahun:int) -> None:
        self.__tahun = int(tahun)

    #CRUD
    #display
    @classmethod
    def displayArr(cls):
        if not cls.daftarfilm:
            print("Daftar film kosong.")
            return

        for film in cls.daftarfilm:
            print("---------------------------")
            print(f"{film.getcode()}")
            print(f"Judul    : {film.getJewdul()}")
            print(f"Sutradara: {film.getDirector()}")
            print(f"Genre    : {film.getGenre()}")
            print(f"Tahun    : {film.getYear()}")
        print("---------------------------")

    #ini search berdasarkan kode  
    @classmethod  
    def searchKode(cls):
        print("--- Search Bar ---")
        code = input("Cari kode film(ex -> F001): ").upper()

        found = False
        for film in cls.daftarfilm:
            if code == film.getcode():
                print(f"{film.getcode()}")
                print(f"Judul    : {film.getJewdul()}")
                print(f"Sutradara: {film.getDirector()}")
                print(f"Genre    : {film.getGenre()}")
                print(f"Tahun    : {film.getYear()}")
                found = True
                break #kalo ketemu, loop langsung berenti, karena kode sifatnya unique
        if not found :
            print("gaada mas")

    @classmethod
    def searchF(cls):
        flm = input("Cari judul film: ")

        found = False
        for film in cls.daftarfilm:
            if flm == film.getJewdul:
                print(f"{film.getcode()}")
                print(f"Judul    : {film.getJewdul()}")
                print(f"Sutradara: {film.getDirector()}")
                print(f"Genre    : {film.getGenre()}")
                print(f"Tahun    : {film.getYear()}")
                found = True #gaada break, bisa aja sama judul tapi remake atau apa gitu
        if not found :
            print("gaada mas")

    # Tambah Data (Create)
    @classmethod
    def addFilm(cls):
        print("--- Tambah Film Baru ---")
        kode = input("Masukkan Kode (ex: F001): ").strip().upper()

        #biar kode gaada sama
        for film in cls.daftarfilm:
            if film.getcode() == kode:
                print("Error: Kode film sudah terdaftar!")
                return

        #input
        judul = input("Masukkan Judul Film: ").strip()
        director = input("Masukkan Sutradara: ").strip()
        genre = input("Masukkan Genre: ").strip()

        try:
            tahun = int(input("Masukkan Tahun Rilis: "))
        except ValueError: #error handling biar tahun sesuai format intejer
            print("Error: Tahunnya angka mas")
            return

        #tambah ke array
        film_baru = cls(kode, judul, director, genre, tahun)
        cls.daftarfilm.append(film_baru)
        print("!! Homre. Film udah ditambah yah !!")

    # Hapus Data (Delete)
    @classmethod
    def deleteFilm(cls):
        print("--- Hapus Film ---")
        kode = input("Masukkan Kode film yang ingin dihapus: ").strip().upper()

        for i, film in enumerate(cls.daftarfilm):
            if film.getcode() == kode:
                cls.daftarfilm.pop(i)
                print(f"!! Oke, Film dengan kode {kode} udah dihapus !!")
                return
        print("gaada mas")

    # Update Data
    @classmethod
    def updateFilm(cls):
        print("--- Update Data Film ---")
        kode = input("Masukkan Kode film yang ingin diupdate: ").strip().upper()

        for film in cls.daftarfilm:
            if film.getcode() == kode:
                #search
                print("Data lama ditemukan:")
                print(f"Judul    : {film.getJewdul()}")
                print(f"Sutradara: {film.getDirector()}")
                print(f"Genre    : {film.getGenre()}")
                print(f"Tahun    : {film.getYear()}")
                print("---------------------------")
                print("Masukkan data baru (kosongkan / tekan Enter jika tidak ingin diubah):")

                judul_baru = input(f"Judul baru [{film.getJewdul()}]: ").strip()
                if judul_baru:
                    film.setJew(judul_baru)

                director_baru = input(f"Sutradara baru [{film.getDirector()}]: ").strip()
                if director_baru:
                    film.setDir(director_baru)

                genre_baru = input(f"Genre baru [{film.getGenre()}]: ").strip()
                if genre_baru:
                    film.setGenre(genre_baru)

                tahun_baru = input(f"Tahun baru [{film.getYear()}]: ").strip()
                if tahun_baru:
                    film.setYr(tahun_baru)

                print("!! Homre. Data film berhasil diupdate !!")
                return
        print("gaada mas")
