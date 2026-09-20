<?php

class Film {
    private string $kode;      // kode unik[cite: 10]
    private string $judul;
    private string $director;
    private string $genre;     // genrenya satu genre utama aja[cite: 10]
    private int $tahun;
    private string $gambar;    // path file lokal

    public function __construct(string $kode, string $judul, string $director, string $genre, int $tahun, string $gambar = "") {
        $this->kode = (string)$kode;
        $this->judul = (string)$judul;
        $this->director = (string)$director;
        $this->genre = (string)$genre;
        $this->tahun = (int)$tahun;
        $this->gambar = (string)$gambar;
    }

    // ini getter haha[cite: 10]
    public function getcode(): string {
        return $this->kode;
    }

    public function getJewdul(): string { // judul[cite: 10]
        return $this->judul;
    }

    public function getDirector(): string { // direktor[cite: 10]
        return $this->director;
    }

    public function getGenre(): string { // genre[cite: 10]
        return $this->genre;
    }

    public function getYear(): int { // tahun[cite: 10]
        return $this->tahun;
    }

    public function getGambar(): string {
        return $this->gambar;
    }

    // setter, urutannya sama dah kayak getter[cite: 10]
    public function setcode(string $kode): void {
        $this->kode = $kode;
    }

    public function setJew(string $judul): void {
        $this->judul = $judul;
    }

    public function setDir(string $director): void {
        $this->director = $director;
    }

    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    public function setYr(int $tahun): void {
        $this->tahun = (int)$tahun;
    }

    public function setGambar(string $gambar): void {
        $this->gambar = $gambar;
    }
}