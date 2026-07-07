<?php

class Prestasi
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Menampilkan data milik user yang login
    public function tampil($user_id)
    {
        return $this->conn->query(
            "SELECT * FROM prestasi
             WHERE user_id='$user_id'
             ORDER BY id DESC"
        );
    }

    // Menambah data
    public function tambah($user_id, $nama, $tingkat, $deskripsi, $tahun)
    {
        $sql = "INSERT INTO prestasi
        (
            user_id,
            nama_prestasi,
            tingkat,
            deskripsi,
            tahun
        )
        VALUES
        (
            '$user_id',
            '$nama',
            '$tingkat',
            '$deskripsi',
            '$tahun'
        )";

        return $this->conn->query($sql);
    }

    // Mengambil data berdasarkan ID + user
    public function getById($id, $user_id)
    {
        return $this->conn->query(
            "SELECT * FROM prestasi
             WHERE id='$id'
             AND user_id='$user_id'"
        );
    }

    // Update data
    public function update($id, $user_id, $nama, $tingkat, $deskripsi, $tahun)
    {
        $sql = "UPDATE prestasi SET
                nama_prestasi='$nama',
                tingkat='$tingkat',
                deskripsi='$deskripsi',
                tahun='$tahun'
                WHERE id='$id'
                AND user_id='$user_id'";

        return $this->conn->query($sql);
    }

    // Hapus data
    public function hapus($id, $user_id)
    {
        return $this->conn->query(
            "DELETE FROM prestasi
             WHERE id='$id'
             AND user_id='$user_id'"
        );
    }
}