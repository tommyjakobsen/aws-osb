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
    'profile' => 'default',
    'region' => 'us-east-1',
    'version' => 'latest',

]);

$currentLanguage = 'es';

$targetLanguage= 'en';

$textToTranslate = 'El AWS SDK for PHP versión 3 permite a los desarrolladores de PHP utilizar Amazon Web Services en su código PHP y crear aplicaciones y software robustos utilizando servicios como Amazon S3, Amazon DynamoDB, Amazon Glacier, etc. Puede empezar rápidamente instalando el SDK mediante Composer (solicitando elpaquete aws/aws-sdk-php) o descargando el archivo aws.zip o aws.phar independiente';

try {
    $result = $client->translateText([
        'SourceLanguageCode' => $currentLanguage,
        'TargetLanguageCode' => $targetLanguage,
        'Text' => $textToTranslate,
    ]);
    var_dump($result);
}catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}