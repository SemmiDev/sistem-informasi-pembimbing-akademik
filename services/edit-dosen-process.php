<?php

require_once("../config.php");

class editDosenReq
{
    public $db;
    public $id;
    public $nama;
    public $nip;
    public $password;

    public function editDosen()
    {

        // update query
        $sql = "UPDATE pengguna SET nama=:name, nip=:nip, password=:password WHERE id=:id";
        $stmt = $this->db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":id" => $this->id,
            ":name" => $this->nama,
            ":nip" => $this->nip,
            ":password" => $this->password
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if ($saved) header("Location: ../dashboard-jurusan-dosen.php");
    }
}

if (isset($_POST['edit-dosen-button'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $dosen = new editDosenReq();
    $dosen->db = $db;
    $dosen->id = $id;
    $dosen->nama = $nama;
    $dosen->nip = $nip;
    $dosen->password = $password;
    $dosen->editDosen();
}
