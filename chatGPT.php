// <?php

// define("BOT_TOKEN", "*********PRIVATE(use your own bot token from bot father)*********");
// define("chatGPT_url", "https://api.one-api.ir/chatbot/v1/gpt3.5-turbo/");
// function update()
// {
//     $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/getUpdates";
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:7170');
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $update = curl_exec($ch);
//     if (!empty($update)) {
//         $result = json_decode($update, 1);
//         $last_index = count($result['result']) - 1;
//         $message = $result['result'][$last_index]['message']['text'];
//         $chat_id = $result['result'][$last_index]['message']['chat']['id'];
//         $data = [
//             "chat_id" => $chat_id,
//             "text" => $message,
//             "parse_mode" => "html",
            
//         ];
//         chatGPTsearch($message,$chat_id);

//     } else {
//         echo "خطایی رخ داده است";
//     }
// }
// update();

// function bot($method, $data = [])
// {
//     $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/$method";
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//     curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:7170');
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $response = curl_exec($ch);
// }

// function chatGPTsearch($query, $chat_id)
// {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, chatGPT_url);
//     curl_setopt($ch, CURLOPT_POST, true);

//     $headers = [
//         "one-api-token" => "*****PRIVATE*******",
//         "Content-Type" => "application/json"
//     ];
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array_map(
//         fn($k, $v) => "$k: $v", 
//         array_keys($headers), 
//         $headers
//     ));
//     curl_setopt($ch,CURLOPT_POST,true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([["role" => "user","content"=>$query]]));
//     curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:7170');
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//     $response = curl_exec($ch);
//     if ($response) {
//         $response = json_decode($response, true);
//         $data = [
//             "chat_id"=>$chat_id,
//             "text"=>$response['result']
//         ];
//         bot("sendMessage",$data);
//     } else {
//         echo 'در قسمت جی پی تی مشکل داری';
//     }
// }
