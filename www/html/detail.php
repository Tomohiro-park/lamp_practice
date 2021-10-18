<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'history.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
$token = get_post('token');

if(is_valid_csrf_token($token) === false) {
  set_error('不正な操作が行われました。');
  redirect_to(HOME_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$order_id = get_post('order_id');
$created = get_post('created');
$total = get_post('total');

if (is_admin($user)){
    $details = get_detail($db, $order_id);
} else {
    $details = get_user_detail($db, $order_id, $user['user_id']);
}
include_once VIEW_PATH . 'detail_view.php';