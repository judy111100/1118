<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<?php
//https://data.gov.tw/dataset/40448
//用file_get_contents指令將JSON資料抓下來 存入變數中
$抓到的資料=file_get_contents("https://data.epa.gov.tw/api/v2/aqx_p_432?api_key=e8dd42e6-9b8b-43f8-991e-b3dee723a52d&limit=1000&sort=ImportDate%20desc&format=JSON");

//echo $抓到的資料 只是寫程式過程中確認資料有抓回 可以不用寫

//將抓回的資料轉回成陣列 存到$o內
$o=json_decode($抓到的資料,true);
//print_r($o["records"]);
//die();

foreach($o["records"] as $v){
    if($v["sitename"]=="中山"){
    echo "縣市=$v[county]<br/>";    
    echo "監理站名稱=$v[sitename]<br/>";
    echo "AQI=$v[aqi]<br/>";
    echo "PM2.5".$v["pm2.5"]."<br/>";
    echo "狀態=$v[status]<br/>";
    }
    
}
die();
//顯示JSON資料 顯示第0筆"作物名稱"欄的資料
//echo $o[1]['作物名稱'];

//連接資料庫 準備將資料寫入資料庫內
$link=mysqli_connect('localhost','root','','opendata');
//設定連線編碼
mysqli_set_charset($link,'utf8');

//用for each 將陣列每一筆資料處理一次
//foreach ($陣列名稱 as 項目){}
foreach($o as $v){
    echo "作物名稱=$v[作物名稱]<br/>";
    //寫入資料庫
    mysqli_query($link,"INSERT INTO `花果` (`流水號`,`日期`,`名稱`,`平均價格`,`交易量`) VALUES (NULL,'$v[交易日期]','$v[作物名稱]','$v[平均價]','$v[交易量]');") or die(mysqli_error($link));
}
?>
</body>
</html>