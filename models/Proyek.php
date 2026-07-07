<?php

class Proyek
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Menampilkan proyek milik user yang login
    public function tampil($user_id)
    {
        return $this->conn->query(
            "SELECT * FROM proyek
             WHERE user_id='$user_id'
             ORDER BY id DESC"
        );
    }

    // Menambah proyek
    public function tambah($user_id,$nama,$matkul,$tahun,$deskripsi,$github)
    {
        $sql = "INSERT INTO proyek
        (
            user_id,
            nama_proyek,
            mata_kuliah,
            tahun,
            deskripsi,
            github
        )
        VALUES
        (
            '$user_id',
            '$nama',
            '$matkul',
            '$tahun',
            '$deskripsi',
            '$github'
        )";

        return $this->conn->query($sql);
    }

    // Mengambil proyek berdasarkan id + user
    public function getById($id,$user_id)
    {
        return $this->conn->query(
            "SELECT * FROM proyek
             WHERE id='$id'
             AND user_id='$user_id'"
        );
    }

    // Update proyek
    public function update($id,$user_id,$nama,$matkul,$tahun,$deskripsi,$github)
    {
        $sql = "UPDATE proyek SET
                nama_proyek='$nama',
                mata_kuliah='$matkul',
                tahun='$tahun',
                deskripsi='$deskripsi',
                github='$github'
                WHERE id='$id'
                AND user_id='$user_id'";

        return $this->conn->query($sql);
    }

    // Hapus proyek
    public function hapus($id,$user_id)
    {
        return $this->conn->query(
            "DELETE FROM proyek
             WHERE id='$id'
             AND user_id='$user_id'"
        );
    }

}