<?php
define("BOT_TOKEN", "************PRIVATE(use your own bot token from bot father)***************");
$v2ray_url = "https://raw.githubusercontent.com/barry-far/V2ray-Configs/main/Sub1.txt";

// دریافت  خام کانفیگ ها از یک فایل گیت هاب
$content = file_get_contents($v2ray_url);

// به دلیل دسترسی نداشتن به سرور اختصاصی از متد آپدیت استفاده شده 

$update_url = "https://api.telegram.org/bot" . BOT_TOKEN . "/getUpdates";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $update_url);
curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:7170");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = json_decode($result, true);


if (!empty($result['result'])) {
    $last_index = count($result['result']) - 1;

    if (isset($result['result'][$last_index]['callback_query'])) {

        $chat_id = $result['result'][$last_index]['callback_query']['message']['chat']['id'];
        $command = $result['result'][$last_index]['callback_query']['data'];
        $type = substr($command, 1);
        echo $type;
    } else {
        $chat_id = $result['result'][$last_index]['message']['chat']['id'];
        $command = $result['result'][$last_index]['message']['text'];
    }


    switch ($command) {
        
        case '/start':
            $data = [
                "chat_id" => $chat_id,
                "text" => "سلام به ربات امیر خوش آمدید لطفا از منو درخواست خود را ارسال کنید",
                "parse_mode" => "html"
            ];
            bot("sendMessage", $data);
            break;

        case "/config":
            $data = [
                "chat_id" => $chat_id,
                "text" => "سلام لطفا نوع <strong>کانفیگ</strong> خود را مشخص کنید",
                "parse_mode" => "html",
                "reply_markup" => json_encode(
                    [

                        "inline_keyboard" => [
                            [
                                ['text' => 'vmess', "callback_data" => "/vmess"],
                                ['text' => 'vless', "callback_data" => "/vless"],
                                ['text' => 'ss', "callback_data" => "/ss"]

                            ]
                        ]
                    ]
                )
            ];
            bot("sendMessage", $data);
            break;

        case '/vless':
        case '/vmess':
        case '/ss':
            preg_match_all('/' . $type . ':\/\/[^\s]+/', $content, $matches);
            $random_number = array_rand($matches[0], 1);
            $data = [
                "chat_id" => $chat_id,
                "text" => $matches[0][$random_number]
            ];

            bot("sendMessage", $data);
            break;

        default:
            $data = [
                "chat_id" => $chat_id,
                "text" => "لطفا یکی از دستورات منو را انتخاب کنید"
            ];
            bot("sendMessage", $data);
            break;
    }
} else {
    echo 'خطا رخ داده ';
}

function bot($method, $data = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot" . BOT_TOKEN . "/" . $method);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:7170");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    return $response;
}
