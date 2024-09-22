<?php
/*

╔══╗─╔═══╗╔╗─╔╗╔══╗╔══╗╔═══╗
║╔╗║─║╔══╝║╚═╝║╚═╗║║╔═╝║╔═╗║
║╚╝╚╗║╚══╗║╔╗─║──║╚╝║──║╚═╝║
║╔═╗║║╔══╝║║╚╗║──║╔╗║──║╔══╝
║╚═╝║║╚══╗║║─║║╔═╝║║╚═╗║║───
╚═══╝╚═══╝╚╝─╚╝╚══╝╚══╝╚╝───

*/


$app_key = '999999'; // app_key
$app_secret = '04d4ad40eeec11e9bad2d962f53dda9d'; // app-secret
$url = 'https://u-openapi.yundasys.com/openapi/outer/logictis/query'; // 请求接口
//$url = 'https://openapi.yundaex.com/openapi/outer/logictis/query'; // 正式使用请换成这个接口
//$url = 'https://u-openapi.yundasys.com/openapi/outer/tmm/outerapi/intercept/invokeExpressChangeAddr'; // 改地址-指令下发测试接口
//$url = 'https://openapi.yundaex.com/openapi/outer/tmm/outerapi/intercept/invokeExpressChangeAddr' // 改地址-指令下发正式接口

// 当前时间戳
$req_time = (string)(microtime(true) * 1000); // 精确到毫秒

// 请求数据
$data = [
    "shipId" => "4301814981782",
    "startSiteCode" => "518000",
    "inteType" => "2",
    "changeAddress" => "重庆市重庆市南岸区丹龙路xx号骏逸第一江岸x栋",
    "changeName" => "李四",
    "changeTel" => "13912345678",
    "interceptSponsorName" => "王二麻子",
    "interceptCreateTime" => "2018-11-25 18:00:00",
    "remark" => "test"
];

$data_json = json_encode($data); // 将data数据转换成JSON
$data_digest = md5($data_json); 
$partner_id = '7';

// 生成sign
$sign = md5($data_json . '_' . $app_secret); // 将已转换成JSON的data数组与app_secret结合，中间以_连接

// 请求头
$headers = [
    "app-key: $app_key",
    "sign: $sign",
    "req-time: $req_time",
    "Content-Type: application/json"
];

// 初始化cURL
$ch = curl_init($url);

// 设置cURL选项
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 返回结果作为字符串
curl_setopt($ch, CURLOPT_POST, true); // 设置请求方法为POST
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // 设置请求头信息
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json); // 设置要发送的POST数据

// 发送请求并获取响应
$response = curl_exec($ch);

// 关闭cURL
curl_close($ch);

// 输出
echo $response;

?>
