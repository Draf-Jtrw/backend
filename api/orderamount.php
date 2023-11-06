<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/orderamount', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from orderamount';
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

$app->get('/orderamount/{id}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from orderamount where oid = ?';
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

$app->get('/orderpay/{id}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    $sql = 'select statuspay from orders where oid = ?';
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


