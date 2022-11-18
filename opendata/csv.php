<!DOCTYPE html>
<html>
<head>
<title>csv資料</title>
</head>
<body>
<?php
 //https://data.gov.tw/dataset/6283
$資料網址="https://www.k12ea.gov.tw/files/common_unit/c8552d07-2d61-456c-addc-3949198984e1/doc/%E5%AD%B8%E7%94%9F%E8%BA%AB%E9%AB%98%E5%B9%B3%E5%9D%87%E5%80%BC(6%E6%AD%B2-15%E6%AD%B2).csv";
$抓到的資料=file_get_contents($資料網址);
//只是寫程式過程中確認資料有抓回來，可以不用寫
//echo $抓到的資料;

//將抓回來的資料轉換成陣列，存到 $o裡面
$行陣列=explode("\n",$抓到的資料);

//echo "第0行 $行陣列[0]<br/>";
//echo "第1行$行陣列[1]<br/>";
//die();

//顯示陣列資料
//print_r($o);

$結果=array();
//顯示JSON的資料
//顯示第0筆資料的"作物名稱"欄的資料
//echo $o[0]['作物名稱'];

foreach ($行陣列 as $行){
    //處理空行 如果這一行資料不是空的 才進行資料剖析
    if(strlen($行)>0){
        $結果[]=str_getcsv($行);
    }
}
//print_r($結果);
//die();

//連接資料庫，準備把資料寫到資料庫內
$link=mysqli_connect('localhost','root','','opendata');
mysqli_set_charset($link,'utf8');
foreach ($結果 as $v){
    if($v[1]!=="年齡"){
        echo "學年度:$v[0] 年齡:$v[1] 總計:$v[2] 男生:$v[3]  女生:$v[4]<br/>";
     //用for each 指令把陣列每筆資料處理一遍
//foreach ($陣列名稱 as 項目) {}
mysqli_query($link,"INSERT INTO `平均身高` (`學年度`,`年齡`,`總計`,`男生`,`女生`)VALUES('$v[0]', '$v[1]','$v[2]', '$v[3]','$v[4]');");
    }
}
die();
?>
</body>
</html>