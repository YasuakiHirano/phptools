<?php
    require_once 'mysqli.lib.php';
    
    $password = 'pasword';
    $dbname = 'dbname';
    $user = 'root';
    $host = 'localhost';

    $mysqli = new DBMysqli($host, $user, $password, $dbname);

    // ## exec query
    $mysqli->queryExec("drop table hoge"); 
    $mysqli->queryExec("create table hoge(id int, name text, date_enterd datetime)"); 

    // ## insert test
    for($i = 0; $i < 10; $i++) {
        $insert_data = array(
               'id' => $i, 
               'name' => 'hoge'.$i,
               'date_enterd' => date('Ymd')
             );
        $mysqli->insert('hoge', $insert_data);
    }

    // ## select test
    // 1. table name only 
    $row = $mysqli->select('hoge');
    print_r($row);

    // 2. table and column name
    $row = $mysqli->select('hoge', array('id', 'name'));
    print_r($row);

    // 3. where
    $row = $mysqli->select('hoge', array('id', 'name'), "id in (1,2,3)");
    print_r($row);


    // ## delete test
    $mysqli->delete('hoge', "id in (0,1,2,3,4,5,6,7)");
    $row = $mysqli->select('hoge');
    print_r($row);

    // ## update test
    $mysqli->update('hoge', array('name' => 'update!!!', 'id' => '999'),"id in (8, 9)");
    $row = $mysqli->select('hoge');
    print_r($row);

