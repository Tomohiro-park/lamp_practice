<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_csrf_token();
$sort = get_get('sort');

if ($sort === ''){
  $items = get_open_items($db);
} else if ($sort === 'new'){
  $items = get_open_items_new($db);
} else if ($sort === 'low_price'){
  $items = get_open_items_low($db);
} else if ($sort === 'high_price'){
  $items = get_open_items_high($db);
}


include_once VIEW_PATH . 'index_view.php';