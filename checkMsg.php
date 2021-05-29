<?php
include_once 'database.php';

$updateRecord = 0;
$sql = 'SELECT id, phoneNumber, msgText, sendtStatus FROM messages WHERE sendtStatus = "wait" LIMIT 0,1';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $apiReply=array(
            'status' => true,
            'message' => 'ny melding',
            'id' => $row['id'],
            'phoneNumber' => $row['phoneNumber'],
            'msgText' => $row['msgText'],
            'sendtStatus' => $row['sendtStatus']
        );
        $updateRecord = $row['id'];
    }
} else {
    $apiReply=array(
        'status' => true,
        'message' => 'ingen ny melding',
        'id' => '',
        'phoneNumber' => '',
        'msgText' => '',
        'sendtStatus' => ''
    );
}

if ($updateRecord != 0){
    $sql = 'UPDATE messages SET sendtStatus="Pending" WHERE id="'.$updateRecord.'"';
    $result = mysqli_query($conn, $sql);
}

print_r(json_encode($apiReply));