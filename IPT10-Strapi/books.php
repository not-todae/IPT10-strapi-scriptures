<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;

function getBooks() {
    $token = '55f5dd479e4919d6ec42892f21e4dac5ffe12b81858e71e57543921c13d91bd9ca039865ba4d240e54eab4b36c24401c9378fa47b0f9d634e2cd4fffd66fed288181b75d232df2c084045af1ac41f7eeb0960a4e46f89e80207fa0ae3641135985eb5cfd6edb4cfb3fdc14987f5552db56aa7e07662bf8e1e41418a65125c6a8';

    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/',
    ]);
    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];
    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;
}
$books = getBooks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <style>
        thead{
            background: black;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-9"><h1>Scriptures Books List</h1></div>
        </div>
    </div>
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($books->data as $bookData){ 
                    $book = $bookData->attributes;?>
                <tr>
                <th scope="row"><?php echo $bookData->id ?></th>
                <td><?php echo $book->name ?></td>
                <td><?php echo $book->author ?></td>
                <td><?php echo $book->category ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>