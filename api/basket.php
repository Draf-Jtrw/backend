<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/basket/{id}', function (Request $request, Response $response,$args) {
    $fid = $args['id'];
    $conn = $GLOBALS['connect'];
    $sql = 'select * from basket where fid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result -> num_rows >= 1){
        $sql3 = 'update basket set amount = amount + 1 where fid = ?';
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param('i', $fid);
        $stmt3->execute();
        $affected = $stmt->affected_rows;
        if ($affected > 0) {
            $data = ["affected_rows" => $affected];
            $response->getBody()->write(json_encode($data));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }    
    }
    else{
        $sel = "select * from food where fid = ?";
        $se = $conn->prepare($sel);
        $se->bind_param('i', $fid);
        $se->execute();
        $data = $se->get_result();
        $seData = array();
        foreach ($data as $row) {
            array_push($seData, $row);
        }
        $js = $seData[0];
        $sql2 = 'insert into basket (cusid, fid, amount , price , pic , name) values (1,?,1,?,?,?)';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('iiss' ,$fid ,$js['price'],$js['pic'],$js['name']);
        $stmt2->execute();

        $sqlDe = 'delete from basket where amount <= 0';
        $stmtDe = $conn->prepare($sqlDe);
        $stmtDe->execute();

        $affected = $stmt2->affected_rows;
        if ($affected > 0) {
            $data2 = ["affected_rows" => $affected, "last_cusid" => $conn->insert_id];
            $response->getBody()->write(json_encode($data2));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    }
    
});

$app->get('/basket', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from basket';
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

$app->get('/basketp/{id}',function (Request $request, Response $response, $args ){
    $fid = $args['id'];
    $conn = $GLOBALS['connect'];
    $sql = 'select * from basket where fid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result -> num_rows >= 1){
        $sql3 = 'update basket set amount = amount + 1 where fid = ?';
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param('i', $fid);
        $stmt3->execute();

        $sqlDe = 'delete from basket where amount <= 0';
        $stmtDe = $conn->prepare($sqlDe);
        $stmtDe->execute();

        $affected = $stmt->affected_rows;
        if ($affected > 0) {
            $data = ["affected_rows" => $affected];
            $response->getBody()->write(json_encode($data));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }    
    }

});
$app->get('/basketre/{id}',function (Request $request, Response $response,$args){
    $fid = $args['id'];
    $conn = $GLOBALS['connect'];
    $sql = 'select * from basket where fid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result -> num_rows >= 1){
        $sql3 = 'update basket set amount = amount - 1 where fid = ?';
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param('i', $fid);
        $stmt3->execute();

        $sqlDe = 'delete from basket where amount <= 0';
        $stmtDe = $conn->prepare($sqlDe);
        $stmtDe->execute();

        $affected = $stmt->affected_rows;
        if ($affected > 0) {
            $data = ["affected_rows" => $affected];
            $response->getBody()->write(json_encode($data));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }    
    }
    

});






