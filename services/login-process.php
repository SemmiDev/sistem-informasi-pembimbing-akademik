<?php

require_once("../config.php");

class UserLoginReq
{
    public $db;
    public $nip;
    public $password;

    public function __construct($db, $nip, $password)
    {
        $this->db = $db;
        $this->nip = $nip;
        $this->password = $password;
    }

    public function login()
    {
        $sql = "SELECT * FROM pengguna WHERE nip=:nip";
        $stmt = $this->db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":nip" => $this->nip
        );

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // jika user terdaftar
        if ($user) {
            // verifikasi password
            if ($this->password == $user["password"]) {
                // buat Session
                session_start();

                $_SESSION["user"] = $user;

                if ($user['peran'] == 'jurusan') {
                    header("Location: ../dashboard-jurusan.php");
                } else {
                    header("Location: ../dashboard-dosen.php");
                }
            } else {
                session_start();
                $_SESSION['error_login'] = "NIP atau password salah";
                header("Location: ../login.php");
            }
        } else {
            session_start();
            $_SESSION['error_login'] = "NIP atau password salah";
            header("Location: ../login.php");
        }
    }
}

if (isset($_POST['login'])) {
    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];

    $loginReq = new UserLoginReq($db, $nip, $password);
    $loginReq->login();
}
