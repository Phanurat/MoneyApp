<h1>hello</h1>

<?php
    $jsonData = file_get_contents(public_path('transactions.json'));
    $data = json_decode($jsonData, true);

    if ($data && array_key_exists('NameTransaction', $data)) {
        echo $data['NameTransaction']; // แสดงค่า NameTransaction
    } else {
        echo "ไม่พบข้อมูล NameTransaction";}


?>