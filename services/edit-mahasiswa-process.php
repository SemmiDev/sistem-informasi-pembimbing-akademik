<?php

require_once("../config.php");

class EditMhsReq
{
    public $db;
    public $id;
    public $dosenId;
    public $nama;
    public $nim;
    public $programStudi;
    public $angkatan;
    public $noHp;
    public $semester;

    public function editMhs()
    {

        // menyiapkan query
        $sql = "UPDATE mahasiswa SET nama=:name, nim=:nim, program_studi=:programStudi, angkatan=:angkatan, nomor_handphone=:noHp, id_dosen_pa=:dosenId, semester=:semester WHERE id=:id";
        $stmt = $this->db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":id" => $this->id,
            ":name" => $this->nama,
            ":nim" => $this->nim,
            ":programStudi" => $this->programStudi,
            ":angkatan" => $this->angkatan,
            ":noHp" => $this->noHp,
            ":dosenId" => $this->dosenId,
            ":semester" => $this->semester
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if ($saved) header("Location: ../dashboard-jurusan-mahasiswa.php");
    }
}

if (isset($_POST['edit-mahasiswa-button'])) {
    $id = $_POST['id'];
    $dosenId = $_POST['idDosen'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $programStudi = $_POST['programStudi'];
    $angkatan = $_POST['angkatan'];
    $noHp = $_POST['noHp'];
    $semester = $_POST['semester'];

    $editMhs = new EditMhsReq();
    $editMhs->db = $db;
    $editMhs->id = $id;
    $editMhs->dosenId = $dosenId;
    $editMhs->nama = $nama;
    $editMhs->nim = $nim;
    $editMhs->programStudi = $programStudi;
    $editMhs->angkatan = $angkatan;
    $editMhs->noHp = $noHp;
    $editMhs->semester = $semester;
    $editMhs->editMhs();
}
