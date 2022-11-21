<?php
// function get_list_categories() {
//     $result = db_fetch_array("SELECT c.id, c.name, c.description, c.create_id, c.created_at, u.full_name, u.id as `uid` FROM `categories` c JOIN `users` u ON c.create_id = u.id");
//     return $result;
// }

function get_list_productions() {
    $result = db_fetch_array("SELECT id,category_id,create_id,count,price,title,description,thumb,status,created_at FROM productions");
    return $result;
}

function get_one_production($id) {
    $result = db_fetch_row("SELECT id,category_id,create_id,count,price,title,description,thumb,status,created_at FROM productions WHERE id = $id ");
    return $result;
}

function create_production($name,$price, $description,$category_id,$count,$status) {
    $user = get_auth();
    $id = db_insert('productions', [
        'category_id' => $category_id,
        'create_id' => $user['id'],
        'count' => $count,
        'price' => $price,
        'title' => $name,
        'description' => $description,
        'status' => $status,
        'created_at' => date('Y-m-d H:i:s')
    ]);
    return $id;
}

function update_production($id,$name,$price, $description,$category_id,$count,$status) {
    db_update('productions', [
        'category_id' => $category_id,
        'count' => $count,
        'price' => $price,
        'title' => $name,
        'description' => $description,
        'status' => $status,
    ], "id = $id");
    return true;
}

function delete_production($id) {
    db_delete('productions', "id = $id");
    return true;
}

