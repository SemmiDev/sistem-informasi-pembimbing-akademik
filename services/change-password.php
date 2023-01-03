<?php

require_once("../config.php");

class ChangePasswordReq
{
    public $db;
    public $id;
    public $old;
    public $new;
    public $nama;
    public $image_file;

    public function changePassword()
    {

        $image_name = $this->id . "-" . $this->image_file["name"];
        move_uploaded_file(
            $this->image_file["tmp_name"],
            "../uploads/" . $image_name,
        );

        $query = "SELECT * FROM pengguna WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $this->id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['password'] != $this->old) {
            header("Location: ../dashboard-jurusan-ubah-password.php");
            exit;
        }

        if ($this->image_file) {
            $sql = "UPDATE pengguna SET password=:password, foto_profile=:foto_profile, nama=:nama WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $params = array(
                ":id" => $this->id,
                ":password" => $this->new,
                ":foto_profile" => $image_name,
                ":nama" => $this->nama,
            );
            $saved = $stmt->execute($params);
            header("Location: ../logout.php");
        } else {
            $sql = "UPDATE pengguna SET password=:password, nama=:nama WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $params = array(
                ":id" => $this->id,
                ":password" => $this->new,
                ":nama" => $this->nama,
            );
            $saved = $stmt->execute($params);
            header("Location: ../logout.php");
        }
    }
}

if (isset($_POST['change-password-button'])) {
    $id = $_POST['id'];
    $old = $_POST['password-old'];
    $new = $_POST['password-new'];
    $nama = $_POST['nama'];
    $image_file = $_FILES["image"];

    $changePassword = new ChangePasswordReq();
    $changePassword->db = $db;
    $changePassword->id = $id;
    $changePassword->old = $old;
    $changePassword->new = $new;
    $changePassword->nama = $nama;
    $changePassword->image_file = $image_file;
    $changePassword->changePassword();
}
