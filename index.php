<?php

require_once __DIR__ . '/vendor/autoload.php';

/*
$inputString = file_get_contents('php://input');
error_log($inputString)
*/
error_log("0000");
// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
error_log("1111");
// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
error_log("2222");
// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER['HTTP' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

// 署名が正当かチェック。正当であればリクエストをパースし配列へ
$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);

// 配列に格納された各イベントをループで処理
foreach ($events as $event) {
  // テキストを返信
  $bot->replyText($event->getReplyToken(), 'TextMessage');
}

?>
