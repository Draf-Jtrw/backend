<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/statusorder', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from statusorder';
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

$app->get('/statusoder/{id}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from statusorder where sid = ?';
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


$app->post('/statusorder', function (Request $request, Response $response, $args) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'insert into statusorder (name) values (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $jsonData['name']);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    if ($affected > 0) {

        $data = ["affected_rows" => $affected, "last_sid" => $conn->insert_id];
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
});
