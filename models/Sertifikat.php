<?php

class Sertifikat {

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Menampilkan sertifikat milik user yang login
    public function tampil($user_id)
    {
        return $this->conn->query(
            "SELECT * FROM sertifikat
             WHERE user_id='$user_id'
             ORDER BY id DESC"
        );
    }

    // Menambah sertifikat
    public function tambah($user_id,$nama,$penyelenggara,$tahun,$file_pdf)
    {
        $sql = "INSERT INTO sertifikat
        (
            user_id,
            nama_sertifikat,
            penyelenggara,
            tahun,
            file_pdf
        )
        VALUES
        (
            '$user_id',
            '$nama',
            '$penyelenggara',
            '$tahun',
            '$file_pdf'
        )";

        return $this->conn->query($sql);
    }

    // Mengambil data berdasarkan id + user
    public function getById($id,$user_id)
    {
        return $this->conn->query(
            "SELECT * FROM sertifikat
             WHERE id='$id'
             AND user_id='$user_id'"
        );
    }

    // Update data
    public function update($id,$user_id,$nama,$penyelenggara,$tahun,$file_pdf="")
    {

        if($file_pdf!=""){

            $sql = "UPDATE sertifikat SET
                    nama_sertifikat='$nama',
                    penyelenggara='$penyelenggara',
                    tahun='$tahun',
                    file_pdf='$file_pdf'
                    WHERE id='$id'
                    AND user_id='$user_id'";

        }else{

            $sql = "UPDATE sertifikat SET
                    nama_sertifikat='$nama',
                    penyelenggara='$penyelenggara',
                    tahun='$tahun'
                    WHERE id='$id'
                    AND user_id='$user_id'";

        }

        return $this->conn->query($sql);
    }

    // Hapus data
    public function hapus($id,$user_id)
    {
        return $this->conn->query(
            "DELETE FROM sertifikat
             WHERE id='$id'
             AND user_id='$user_id'"
        );
    }

}