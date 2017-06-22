<?php
    require_once 'mysqli.lib.php';
    
    function outputResult($test_name,$ary){
        echo $test_name.":\n";
        print_r($ary);
    }
    
    $password = 'password';
    $dbname = 'dbname';
    $user = 'root';
    $host = 'localhost';

    $mysqli = new DBLib\DBMysqli($host, $user, $password, $dbname);

    // ## exec query
    $mysqli->queryExec("drop table hoge"); 
    $mysqli->queryExec("create table hoge(id int, name text, date_enterd datetime)"); 

    // ## insert test
    // 1. insert
    for($i = 0; $i < 10; $i++) {
        $insert_data = array(
               'id' => $i, 
               'name' => 'hoge'.$i,
               'date_enterd' => date('Ymd')
             );
        $mysqli->insert('hoge', $insert_data);
    }
    
    // 2. insert prepare 
    for($i = 10; $i < 15; $i++) {
        $insert_data = array(
               'id' => $i,
               'name' => 'hoge'.$i,
               'date_enterd' => date('Ymd')
             );
        $mysqli->insertPrepare('hoge', $insert_data);
    }

    // ## select test
    // 1. table name only 
    $row = $mysqli->select('hoge');
    outputResult('select test1',$row);

    // 2. table and column name
    $row = $mysqli->select('hoge', array('id', 'name'));
    outputResult('select test2',$row);

    // 3. where
    $row = $mysqli->select('hoge', array('id', 'name'), "id in (1,2,3)");
    outputResult('select test3',$row);

    // 4. select prepare
    $row = $mysqli->selectPrepare('hoge', 'name, id', 'id = ? OR name = ?', array('1', 'hoge5'));
    outputResult('select test4',$row);

    // ## delete test
    $mysqli->delete('hoge', "id in (0,1,2,3,4,5,6,7,10,11,12,13,14,15,16,17,18,19)");
    $row = $mysqli->select('hoge');
    outputResult('delete test',$row);

    // ## update test
    $mysqli->update('hoge', array('name' => 'update!!!', 'id' => '999'),"id in (8, 9)");
    $row = $mysqli->select('hoge');
    outputResult('update test',$row);
    
    // close
    $mysqli->close();

