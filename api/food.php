<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/food', function (Request $request, Response $response, $args) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'insert into food (name) values (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $jsonData['name']);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    if ($affected > 0) {

        $data = ["affected_rows" => $affected, "last_fid" => $conn->insert_id];
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
});

$app->get('/food', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from food';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    foreach ($result as $row) {
        array_push($data, $row);
    }

    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);
});

$app->get('/food/t', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select food.fid as fid, food.name as name,type.name as type,price,pic from food inner join type on food.type = type.tid';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    foreach ($result as $row) {
        array_push($data, $row);
    }

    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);
});

$app->get('/food/{id}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from food where fid = ?';
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('s', $args['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    foreach ($result as $row) {
        array_push($data, $row);
    }

    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);
});

$app->get('/food/name/{name}', function (Request $request, Response $response, $args) {
    $fid = '%'.$args['name'].'%';
    $conn = $GLOBALS['connect'];
    $sql = 'select * from food where name like ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
    }
    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);
});


$app->get('/food/type/{type}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    
    $sql = 'select food.fid, food.name,food.price,food.pic,
    type.name as type from food inner join type on food.type = type.tid where type.name like ?';
    $stmt = $conn->prepare($sql);
    $name = '%' . $args['type'] . '%';
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    foreach ($result as $row) {
        array_push($data, $row);
    }

    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);
});


// $app->get('/food/show', function (Request $request, Response $response, $args) {
//     $conn = $GLOBALS['connect'];
    
//     $sql = 'select food.fid, food.name,food.price,food.pic
//     as food from basket inner join food on food.fid = basket.fid';
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $data = array();
//     foreach ($result as $row) {
//         array_push($data, $row);
//     }

//     $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
//     return $response
//         ->withHeader('Content-Type', 'application/json; charset=utf-8')
//         ->withStatus(200);
// });

$app->put('/food/{fid}', function (Request $request, Response $response, $args) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $fid = $args['fid'];
    $conn = $GLOBALS['connect'];
    $sql = 'update food set pic = ? , name = ? , price = ? where fid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssii', $jsonData['img'], $jsonData['name'], $jsonData['price'],$fid);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    if ($affected > 0) {
        $data = ["affected_rows" => $affected];
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
});