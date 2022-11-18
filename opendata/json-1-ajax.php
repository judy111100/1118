<?php
//https://data.gov.tw/dataset/8066
//用file_get_contents指令將JSON資料抓下來 存入變數中
$抓到的資料=file_get_contents("https://data.coa.gov.tw/Service/OpenData/FromM/FarmTransData.aspx");

//echo $抓到的資料 只是寫程式過程中確認資料有抓回 可以不用寫

//將抓回的資料轉回成陣列 存到$o內
$o=json_decode($抓到的資料,true);

//print_r($o) 顯示陣列的資料

//顯示JSON資料 顯示第0筆"作物名稱"欄的資料
//echo $o[1]['作物名稱'];

//連接資料庫 準備將資料寫入資料庫內
$link=mysqli_connect('localhost','root','','opendata');
//設定連線編碼
mysqli_set_charset($link,'utf8');

//用for each 將陣列每一筆資料處理一次
//foreach ($陣列名稱 as 項目){}
foreach($o as $v){
    //echo "作物名稱=$v[作物名稱]<br/>";
    //寫入資料庫
    mysqli_query($link,"INSERT INTO `花果` (`流水號`,`日期`,`名稱`,`平均價格`,`交易量`) VALUES (NULL,'$v[交易日期]','$v[作物名稱]','$v[平均價]','$v[交易量]');") or die(mysqli_error($link));
}
//因為在背景執行 這個程式顯示的部分(echo)要拿掉
//如果程式執行到最後面 只要用echo顯示一個1 讓前台知道執行成功
echo "1";
?>