<?php

function getUsers ($connect) {
    $posts = mysqli_query($connect, "SELECT * FROM `comment` ORDER BY `comment`.`date_now` DESC ");
    $postList = [];
    while($post = mysqli_fetch_assoc($posts)) {
        $postList[] = $post;
    }
    echo json_encode($postList);
}

function getUser($connect, $id) {
    $post = mysqli_query($connect, "SELECT * FROM `comment` WHERE `id` ='$id' ");
    if (mysqli_num_rows($post) === 0 ) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => 'Страница не найдена'
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }
}

function addUser($connect, $data) {
    $title = $data['title'];
    $name = $data['name'];
    $date_now = $data['date_now'];
    mysqli_query($connect, "INSERT INTO `comment`(`name`, `title`, `date_now`) VALUES ('$name',' $title','$date_now')");
    http_response_code(201);
    $res = [
        "status" => true,
        "post_id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);

}

function deleteUser ($connect, $id) {
    mysqli_query($connect, "DELETE FROM `comment` WHERE `comment`.`id` = '$id'");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => "Пользователь удален"
    ];
    echo json_encode($res);

}