<?php





if(getenv('SQS_AWS_ACCESS_KEY_ID') !== false)
    {
        $SQS_AWS_ACCESS_KEY_ID=getenv('SQS_AWS_ACCESS_KEY_ID');
       //Debug
        //echo "Found Access Key: $SQS_AWS_ACCESS_KEY_ID<hr>";
        putenv("AWS_ACCESS_KEY_ID=$SQS_AWS_ACCESS_KEY_ID");
     }else{
        echo "<font color=red><b>! \$SQS_AWS_ACCESS_KEY_ID variable not set...<br>Add secrets to application...</font>";
        echo "</body>";
     exit(1);
     }
if(getenv('SQS_AWS_SECRET_ACCESS_KEY') !== false)
    {
        $SQS_AWS_SECRET_ACCESS_KEY=getenv('SQS_AWS_SECRET_ACCESS_KEY');
        //DEBUG
        //echo "Found aiKey at: $SQS_AWS_SECRET_ACCESS_KEY<hr>";
        putenv("AWS_SECRET_ACCESS_KEY=$SQS_AWS_SECRET_ACCESS_KEY");
     }else{
        echo "<font color=red><b>! \$SQS_AWS_SECRET_ACCESS_KEY variable not set...<br>Check bindings in openshift...</font>";
        echo "</body>";
     exit(1);
     }


require './aws-autoloader.php';
use Aws\Translate\TranslateClient;
use Aws\Translate\Exception;

$client = new Aws\Translate\TranslateClient([
    'region' => 'us-east-1',
    'version' => 'latest',

]);

if(isset($_POST["sourceLang"]) && isset($_POST["targLang"]) && isset($_POST["textToTranslate"]) ){

    $currentLanguage = $_POST["sourceLang"];

    $targetLanguage= $_POST["targLang"];

    $textToTranslate = $_POST["textToTranslate"];



}else{
    
    $currentLanguage = 'es';

    $targetLanguage= 'en';

    $textToTranslate = '¡Ahora estoy tan enojado con esta mierda!
¡Mi red pierde conexión todo el tiempo!

¡Mis genes españoles están gritando de furia!
¡AYUDAME AHORA';
}


try {
    $result = $client->translateText([
        'SourceLanguageCode' => $currentLanguage,
        'TargetLanguageCode' => $targetLanguage,
        'Text' => $textToTranslate,
    ]);
//DEBUG
// var_dump($result);
}catch (AwsException $e) {
    // output error message if fails
    echo preg_replace('/\n/', '<br>'. $e->getMessage());
    echo "";
    exit(1);
}

$result = $result->toArray();
echo "$textToTranslate<hr>":
echo $result["TranslatedText"]."<hr>";




?>