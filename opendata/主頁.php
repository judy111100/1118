<!DOCTYPE html>
<html>
<head>
<title>opendata主頁</title>
<script src="jquery-3.6.1.min.js"></script>
<script>
    function QQ(){
        //alert('XX');
        alert('QQ');
        $.ajax({
            method:"get",
            url:"json-1-ajax.php",
            success:function(r){
                //alert程式執行完成後 會來這邊執行裡面的程式碼
                alert("同步成功");
            }
        });
    }
    //123123
</script>
</head>
<body>
    <h2>opendata主頁</h2>
    <ul>
        <li onclick="QQ();">同步資料</li>
        <li>花果即時行情</li>
    </ul>
</body>
</html>