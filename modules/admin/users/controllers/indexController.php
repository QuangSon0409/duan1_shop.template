<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    load('helper','format');
    $list_users = get_list_users();
//    show_array($list_users);
    $data['list_users'] = $list_users;
    load_view('index', $data);
}
function createAction() {
    load_view('create');
}
function addAction() {
    echo "Thêm dữ liệu";
}
function createPostAction() {
    $name = $_POST['name'];
    $description = $_POST['description'];
    if (empty($name)) {
        push_notification('danger', ['Vui lòng nhập vào tên danh mục']);
        header('Location: ?role=admin&mod=category&action=create');
        die();
    }
    create_category($name, $description);
    push_notification('success', ['Tạo mới danh mục sản phẩm thành công']);
    header('Location: ?role=admin&mod=category');
}
function editAction() {
    $id = (int)$_GET['id'];
    $item = get_user_by_id($id);
    show_array($item);
}
