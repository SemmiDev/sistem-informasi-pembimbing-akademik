<?php

require_once("../config.php");

class UserRegisterReq
{
    public $db;
    public $name;
    public $nip;
    public $phoneNumber;
    public $password;

    public function register()
    {

        // menyiapkan query
        $sql = "INSERT INTO pengguna (nama, nip, password, nomor_handphone)
            VALUES (:name, :nip, :password, :phoneNumber)";
        $stmt = $this->db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":name" => $this->name,
            ":nip" => $this->nip,
            ":password" => $this->password,
            ":phoneNumber" => $this->phoneNumber
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if ($saved) header("Location: ../login.php");
    }
}

if (isset($_POST['register'])) {
    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_SPECIAL_CHARS);
    $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $user = new UserRegisterReq();
    $user->db = $db;
    $user->name = $name;
    $user->nip = $nip;
    $user->phoneNumber = $phoneNumber;
    $user->password = $password;
    $user->register();
}
