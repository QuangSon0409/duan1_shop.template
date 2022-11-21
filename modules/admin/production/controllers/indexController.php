<?php

function construct() {
    request_auth();
    load_model('index');
}

function indexAction() {
    $data['productions'] = get_list_productions();
    load_view('index', $data);
}

function createAction() {
    
    load_view('create');
}

function createPostAction() {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $status = $_POST['status'];

    if (empty($name)) {
        push_notification('danger', ['Vui lòng nhập vào tên sản phẩm']);
        header('Location: ?role=admin&mod=production&action=create');
        die();
    }
    create_production($name,$price, $description,$category_id,$count,$status);
    push_notification('success', ['Tạo mới danh mục sản phẩm thành công']);
    header('Location: ?role=admin&mod=production');
}

function deleteAction() {
    $id = $_GET['id_prod'];
    delete_production($id);
    push_notification('success', ['Xoá danh mục sản phẩm thành công']);
    header('Location: ?role=admin&mod=production');
}

function updateAction()
{
    $id = $_GET['id_prod'];
    $prod = get_one_production($id);
    $data['production'] = $prod;
    if ($prod) {
        load_view('update', $data);
    } else {
        header('Location: ?role=admin&mod=production');
    }
}

function updatePostAction() {

    $id = $_GET['id_prod'];
    $prod = get_one_production($id);
    if (!$prod) {
        header('Location: ?role=admin&mod=production');
        die();
    }
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $status = $_POST['status'];
   
    if (empty($name)) {
        push_notification('errors', [
            'name' => 'Vui lòng nhập vào tên danh mục'
        ]);
        header('Location: ?role=admin&mod=production&action=update&id_prod='.$id);
    }
    update_production($id,$name,$price,$description,$category_id,$count,$status);
    push_notification('success', ['Chỉnh sửa danh mục sản phẩm thành công']);
    header('Location: ?role=admin&mod=production');
}