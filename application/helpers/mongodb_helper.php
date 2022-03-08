<?php
function mongodb()
{
    $client = new MongoDB\Client(
        'mongodb://admin:Amtmgdaw045@localhost:27017/admin?retryWrites=true&w=majority'
    );
    return $client->database;
}
