<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/customer', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from customer';
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

$app->get('/customer/{id}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from customer where cusid = ?';
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

$app->get('/customer/name/{name}', function (Request $request, Response $response, $args) {
    $cusid = '%'.$args['name'].'%';
    $conn = $GLOBALS['connect'];
    $sql = 'select * from customer where name like ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $cusid);
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


$app->post('/customer', function (Request $request, Response $response, $args) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'insert into customer (name) values (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $jsonData['name']);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    if ($affected > 0) {

        $data = ["affected_rows" => $affected, "last_cuid" => $conn->insert_id];
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
});

$app->post('/customer/login', function (Request $request, Response $response, $args){
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'select * from customer where username = ? and password = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $jsonData['username'], $jsonData['password']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result -> num_rows >= 1){
        $row = $result->fetch_assoc();
        $response_data = ['success' => true, 'message' => 'Login successful!', 'cusid' => $row['cusid']];
        $response->getBody()->write(json_encode($response_data));
        $response = $response->withHeader('Content-type', 'application/json')->withStatus(200);
        
        $user = $row['cusid'];

        $sql2 = 'insert into login (lid , uid , status ) values (1 , ? , 1 )';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('i', $user);
        $stmt2->execute();
        $affected2 = $stmt2->affected_rows;
        if ($affected2 > 0) {
            $data = ["affected_rows" => $affected2, "last_cusid" => $conn->insert_id];
            $response->getBody()->write(json_encode($data));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    }
    else{
        $response_data = ['success' => false, 'message' => 'Username or Password is not found!'];
        $response->getBody()->write(json_encode($response_data));
        $response = $response->withHeader('Content-type', 'application/json')->withStatus(400);
}
 
    return $response->withHeader('Content-Type', 'application/json');

});

$app->put('/pay', function (Request $request, Response $response) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'update pay set money = money+? where pid = 1';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $jsonData['sumprice']);
    $stmt->execute();
    
    $sql2 = 'update orders set statuspay = 2 where oid = ?';
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('i', $jsonData['oid']);
    $stmt2->execute();

    $affected = $stmt->affected_rows;
    if ($affected > 0) {
        $data = ["affected_rows" => $affected];
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
});

$app->get('/pay', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from pay';
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