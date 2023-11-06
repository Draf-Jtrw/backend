<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/orders', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select * from orders';
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
// $app->get('/orderss', function (Request $request, Response $response) {
//     $conn = $GLOBALS['connect'];

//     $sql2 = 'select * from login';
//     $oo = mysqli_query($conn,$sql2);
//     $eoo = mysqli_fetch_assoc($oo);

//     $sql = 'select * from orders where cusid = ?';
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param('i',$eoo['uid']);
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

$app->get('/orderss', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];

    $sql = 'select oid,customer.name as cusid,statusorder.name,address,phone,sumprice,status  from orders,statusorder,customer where orders.status = statusorder.sid and orders.cusid = customer.cusid and orders.cusid = 1';
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

$app->get('/order', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];

    $sql = 'select * from basket';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $sqlIn = 'insert into orders (cusid,status,statuspay,sumprice) values (1,1,1,0)';
    $stmtIn = $conn->prepare($sqlIn);
    $stmtIn->execute();

    $sqlSe = 'select * from orders order by oid desc limit 1';
    $stmtSe = $conn->prepare($sqlSe);
    $stmtSe->execute();
    $resultSe = $stmtSe->get_result();
    foreach ($resultSe as $rowSe){
        foreach($result as $rowIn){
            $sqlInAmount = 'insert into orderamount (oid , fid , amount , price , pic , name) values (?,?,?,?,?,?)';
            $stmtInAmount = $conn->prepare($sqlInAmount);
            $stmtInAmount->bind_param('iiiiss',$rowSe['oid'],$rowIn['fid'],$rowIn['amount'],$rowIn['price'],$rowIn['pic'],$rowIn['name']);
            $stmtInAmount->execute();
            
            $sqlSum = 'update orders set sumprice = sumprice+(?*?) where oid = ?';
            $stmtSum = $conn->prepare($sqlSum);
            $stmtSum->bind_param('iii',$rowIn['amount'],$rowIn['price'],$rowSe['oid']);
            $stmtSum->execute();

            $sqlDe = 'delete from basket where cusid = ? and fid = ?';
            $stmtDe = $conn->prepare($sqlDe);
            $stmtDe->bind_param('ii',$rowIn['cusid'],$rowIn['fid']);
            $stmtDe->execute();
        }
        $sqlDeO = 'delete from orders where oid = ?';
        $stmtDeO = $conn->prepare($sqlDeO);
        $stmtDeO->bind_param('i',$rowSe['oid']);
        $stmtDeO->execute();
    }
    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);

});


$app->get('/statusname', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select oid,customer.name as cusid,address,phone,statusorder.name,sumprice  from orders,statusorder,statuspay,customer where orders.status = statusorder.sid and orders.statuspay = statuspay.pid and orders.cusid = customer.cusid';
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

$app->put('/ordersUp/{oid}', function (Request $request, Response $response, $args) {
    $json = $request->getBody();
    $jsonData = json_decode($json, true);

    $oid = $args['oid'];
    $conn = $GLOBALS['connect'];
    $sql = 'update orders set status = ? where oid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $jsonData['sid'] , $oid);
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

$app->get('/order/{oid}', function (Request $request, Response $response, $args) {
    $conn = $GLOBALS['connect'];
    $sql = 'select oid,pid,namee,status from orders,statuspay where orders.statuspay = statuspay.pid and oid = ?';
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('i', $args['oid']);
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

$app->delete('/orders/{oid}', function (Request $request, Response $response, $args) {
    $oid = $args['oid'];
    $conn = $GLOBALS['connect'];

    $sqlP1 = 'select oid,cusid,status,sumprice from orders where oid = ?';
    $stmtP1 = $conn->prepare($sqlP1);
    $stmtP1->bind_param('i',$oid);
    $stmtP1->execute();
    $result1 = $stmtP1->get_result();

    $sqlP = 'select oid,fid,amount from orderamount where oid = ?';
    $stmtP = $conn->prepare($sqlP);
    $stmtP->bind_param('i',$oid);
    $stmtP->execute();
    $result = $stmtP->get_result();

    foreach ($result1 as $row) {
        $sqlIn = 'insert into history (hid,cusid,status,sumprice) values (?,?,"จัดส่งเสร็จสิ้น",?)';
        $stmtIn = $conn->prepare($sqlIn);
        $stmtIn->bind_param('iii',$row['oid'],$row['cusid'],$row['sumprice']);
        $stmtIn->execute();
    }
    foreach ($result as $row){
        $sqlIn = 'insert into historyamount (hid,fid,amount) values (?,?,?)';
        $stmtIn = $conn->prepare($sqlIn);
        $stmtIn->bind_param('iii',$row['oid'],$row['fid'],$row['amount']);
        $stmtIn->execute();

        $sql = 'delete from orderamount where oid = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i',$row['oid']);
        $stmt->execute();
    
        $sql2 = 'delete from orders where oid = ?';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('i',$row['oid']);
        $stmt2->execute();
    }
    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);
});

$app->get('/history', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];
    $sql = 'select hid,name,address,phone,status,sumprice from history,customer where history.cusid = customer.cusid';
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

$app->get('/historyCus', function (Request $request, Response $response) {
    $conn = $GLOBALS['connect'];

    
    $sql = 'select * from login';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    foreach ($result as $row) {
        $sqlIn = 'select hid,name,address,phone,status,sumprice from history,customer where history.cusid = customer.cusid and history.cusid = ?';
        $stmtIn = $conn->prepare($sqlIn);
        $stmtIn->bind_param('i',$row['uid']);
        $stmtIn->execute();
        $resultIn = $stmtIn->get_result();
        foreach ($resultIn as $rowIn) {
            array_push($data, $rowIn);
        }
    }

    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
    return $response
        ->withHeader('Content-Type', 'application/json; charset=utf-8')
        ->withStatus(200);
});

$app->get('/historyamount/{oid}', function (Request $request, Response $response, $args) {
    $oid = $args['oid'];
    $conn = $GLOBALS['connect'];
    $sql = 'select amount,name,price,pic from historyamount,food where historyamount.fid = food.fid and hid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $oid);
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

$app->get('/hiss/{id}', function (Request $request, Response $response, $args){
    $oid = $args['id'];
    $conn = $GLOBALS['connect'];
    $sql = 'select * from orders where oid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $oid);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    foreach ($result as $row) {
        array_push($data, $row);
    }
    if($result -> num_rows >= 1){
        $sql2 = 'insert into history (hid,cusid,status,sumprice) values (?,?,5,?)';
        $stmt3 = $conn->prepare($sql2);
        $stmt3->bind_param('iii', $oid,$oid,$row['sumprice']);
        $stmt3->execute();
        $affected = $stmt3->affected_rows;

        $sql = 'delete from orderamount where oid = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i',$row['oid']);
        $stmt->execute();
    
        $sql2 = 'delete from orders where oid = ?';
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('i',$row['oid']);
        $stmt2->execute();
        
        if ($affected > 0) {
            $data = ["affected_rows" => $affected];
            $response->getBody()->write(json_encode($data));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    }

});

$app->get('/hisc/{id}', function (Request $request, Response $response, $args){
    $oid = $args['id'];
    $conn = $GLOBALS['connect'];
    $sql = 'select * from orders where oid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $oid);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    foreach ($result as $row) {
        array_push($data, $row);
        $sql2 = 'insert into history (hid,cusid,status,sumprice) values (?,?,6,?)';
        $stmt3 = $conn->prepare($sql2);
        $stmt3->bind_param('iii', $oid,$oid,$row['sumprice']);
        $stmt3->execute();
        
        $sql4 = 'delete from orderamount where oid = ?';
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param('i',$row['oid']);
        $stmt4->execute();
    
        $sql5 = 'delete from orders where oid = ?';
        $stmt5 = $conn->prepare($sql5);
        $stmt5->bind_param('i',$row['oid']);
        $stmt5->execute();
    }
    if($result -> num_rows >= 1){

        $affected = $stmt3->affected_rows;
        if ($affected > 0) {
            $data = ["affected_rows" => $affected];
            $response->getBody()->write(json_encode($data));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    }

});

$app->get('/hs', function (Request $request, Response $response, $args){
    $conn = $GLOBALS['connect'];
    $sql = 'select history.hid as hid,statusorder.name,sumprice from history,statusorder where statusorder.sid = history.status and history.status = 5';
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

$app->get('/hc', function (Request $request, Response $response, $args){
    $conn = $GLOBALS['connect'];
    $sql = 'select history.hid as hid,statusorder.name,sumprice from history,statusorder where statusorder.sid = history.status and history.status = 6';
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