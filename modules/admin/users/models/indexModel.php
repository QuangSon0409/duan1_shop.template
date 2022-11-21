<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `users` WHERE `user_id` = {$id}");
    return $item;
}
function create_user($name,$email,$numberphone,$password,$role,$created_at) {
    
    $id = db_insert('categories', [
        'full_name' => $name,
        'email' => $email,
        'numberphone' => $numberphone,
        'password' => $password,
        'role' => $role,
        'created_at' => date('Y-m-d H:i:s')
    ]);
    return $id;
}
