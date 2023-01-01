<?php

function register_user($name, $password, $email)
{
    global $link;

    $nama = escape($name);
    $pass = escape($password);

    $query = "INSERT INTO users(user_username, user_password, unique_id, user_email) VALUES ('$nama', '$pass', '$email', '2')";

    $user_new = mysqli_query($koneksi, $query);
    if ($user_new) {
        $usr = "SELECT * FROM users WHERE user_username = '$nama' OR user_email = '$email'";
        $result = mysqli_query($koneksi, $usr);
        $user = mysqli_fetch_assoc($result);
        return $user;
    } else {
        return NULL;
    }
}

function escape($data)
{
    global $link;
    return mysqli_real_escape_string($koneksi, $data);
}

function cek_nama($name)
{
    global $link;
    $query = "SELECT * FROM users WHERE user_email = '$email'";
    if ($result = mysqli_query($koneksi, $query))
        return mysqli_num_rows($result);
}

function cek_data_user($name, $pass)
{
    global $link;

    $nama = escape($name);
    $password = escape($pass);

    $query = "SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    $unique_id = $data['unique_id'];

}
?>