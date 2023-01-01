<?php

require_once "koneksi.php";
require_once "fungsiapi.php";

$response = array("error" => FALSE);


if (isset($_POST['txt_nama']) && isset($_POST['txt pass']) && isset($_POST['txt_email'])) {

    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (cek_nama($name) == 0) {
        $user = register_user($name, $password, $email);
        if ($user) {
            // simpan user berhasil
            $response["error"] = FALSE;
            $response["user"]["name"] = $user["user_username"];
            $response["user"]["key"] = $user["unique_id"];
            echo json_encode($response);
        } else {
            // gagal menyimpan user
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
            echo json_encode($response);
        }
    } else {
        // user telah ada
        $response["error"] = TRUE;
        $response["error_msg"] = "User telah ada ";
        echo json_encode($response);
    }
}
?>