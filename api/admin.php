<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/admin', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from admin';
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

$app->get('/admin/{id}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from food where aid = ?';
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

$app->get('/admin/name/{name}', function (Request $request, Response $response, $args) {
    $aid = '%'.$args['name'].'%';
    $conn = $GLOBALS['connect'];
    $sql = 'select * from admin where name like ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $aid);
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


$app->post('/admin', function (Request $request, Response $response, $args) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'insert into admin (name) values (?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $jsonData['name']);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    if ($affected > 0) {

        $data = ["affected_rows" => $affected, "last_aid" => $conn->insert_id];
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
});

$app->post('/admin/login', function (Request $request, Response $response, $args){
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $conn = $GLOBALS['connect'];
    $sql = 'select * from admin where username = ? and password = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $jsonData["username"], $jsonData["password"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result -> num_rows >= 1){
        $row = $result->fetch_assoc();
        $response_data = ['success' => true, 'message' => 'Login successful!', 'aid' => $row['aid']];
        $response->getBody()->write(json_encode($response_data));
        $response = $response->withHeader('Content-type', 'application/json')->withStatus(200);

        $user = $row['aid'];

        $sql2 = 'insert into login (lid , uid , status ) values (1 , ? , 2 )';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('i', $user);
        $stmt2->execute();
        $affected2 = $stmt2->affected_rows;
        if ($affected2 > 0) {
            $data = ["affected_rows" => $affected2, "last_aid" => $conn->insert_id];
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

