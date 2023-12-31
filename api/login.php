<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/login', function (Request $request, Response $response, $args) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'insert into login (lid , uid , status ) values (?, ? , ? )';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $jsonData['lid'], $jsonData['name'], $jsonData['status']);
    $stmt->execute();
    $data = ["affected_rows" => $affected , "last_cusid" => $conn->insert_id];
    $response->getBody()->write(json_encode($data));
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});

$app->get('/login', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select lid,uid,name,status from login,customer where login.uid = customer.cusid';
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

$app->delete('/login/{id}', function (Request $request, Response $response, $args) {
    $lid = $args['id'];
    $conn = $GLOBALS['connect'];
    $sql = 'delete from login where lid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i',$lid);
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
