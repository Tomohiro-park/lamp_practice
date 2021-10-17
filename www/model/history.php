<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user_history($db, $user_id){
  $sql = "
    SELECT
       history.order_id,
       history.total,
       history.created
    FROM
       history
    WHERE
       history.user_id = ?
    ORDER BY
       order_id DESC
";
 return fetch_all_query($db, $sql, [$user_id]);
}

function get_admin_history($db){
  $sql = "
    SELECT
       history.order_id,
       history.total,
       history.created
    FROM
       history
    ORDER BY
       order_id DESC
";
 return fetch_all_query($db, $sql);
}

function get_detail ($db, $order_id){
  $sql = "
    SELECT
      detail.item_id,
      detail.price,
      detail.amount,
      items.name
    FROM
      detail
    JOIN
      items
    ON
      detail.item_id = items.item_id
    WHERE
      detail.order_id = ?
";
 return fetch_all_query($db, $sql, [$order_id]);
}

function get_user_detail ($db, $order_id, $user_id){
  $sql = "
  SELECT
      detail.item_id,
      detail.price,
      detail.amount,
      items.name
    FROM
      detail
    JOIN
      items
    ON
      detail.item_id = items.item_id
    JOIN
      history
    ON
      detail.order_id = history.order_id
    WHERE
      history.order_id = ?
    AND
      history.user_id = ?
";
  return fetch_all_query($db, $sql, [$order_id, $user_id]);  
}