<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>

    <title>履歴</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'history.css'); ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>


    <div class="container">
        <h1>履歴</h1>
        <?php include VIEW_PATH . 'templates/messages.php'; ?>
        <?php if (count($historys) > 0) { ?>
            <div class="history">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>注文番号</th>
                            <th>購入日時</th>
                            <th>合計金額</th>
                            <th>明細</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historys as $history) { ?>
                            <tr>
                                <td><?php print(h($history['order_id'])); ?></td>
                                <td><?php print(h($history['created'])); ?></td>
                                <td><?php print(h($history['total'])); ?>円</td>
                                <td>
                                    <form method="post" action="detail.php">
                                        <input type="submit" value="明細" class="get_detail">
                                        <input type="hidden" name="token" value="<?php print $token; ?>">
                                        <input type="hidden" name="order_id" value="<?php print(h($history['order_id'])); ?>">
                                        <input type="hidden" name="created" value="<?php print(h($history['created'])); ?>">
                                        <input type="hidden" name="total" value="<?php print(h($history['total'])); ?>">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>購入履歴はありません。</p>
        <?php } ?>
</body>

</html>