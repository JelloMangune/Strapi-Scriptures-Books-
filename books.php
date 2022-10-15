<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '90f1d095a0b8e20f9fa134fcceb7d4b9b92b6f56f5398a08a8cc46643ee8ecec5bb6cc99b27db6dcee3f5064ae4a83c31324cb83b0faac71854c9f81acfb3eced5ac4b780b6e44aa948f579597dfe6401744050689fa9afd32a8bac6b51ca730e959fd412b9dcf56297b1a45cee696e1c14657e8cd628619c088abc679cc6ece';

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>Scriptures Books</title>

</head>
<body>
    <div class = "container" style="margin-top: 20px; border-style: solid; border-width:5px;border-radius:10px;"> 
        <h1>Scriptures Books</h1>
        <table class="table table-striped" style="margin-top:20px;">
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
                        <th scope="row"><?php echo $bookData->id?></th>
                        <td><?php echo $book->name ?></td>
                        <td><?php echo $book->author?></td>
                        <td><?php echo $book->category?></td>
                    </tr>
                    <?php }?>
                </tbody>
        </table>
    </div>
</body>
</html>