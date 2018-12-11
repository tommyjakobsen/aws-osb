<?php
require './aws-autoloader.php';

use Aws\Translate\TranslateClient;
use Aws\Translate\Exception;


if(getenv('SQS_AWS_ACCESS_KEY_ID') !== false)
    {
        $SQS_AWS_ACCESS_KEY_ID=getenv('SQS_AWS_ACCESS_KEY_ID');
       //Debug
        //echo "Found Access Key: $SQS_AWS_ACCESS_KEY_ID<hr>";
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
     }else{
        echo "<font color=red><b>! \$SQS_AWS_SECRET_ACCESS_KEY variable not set...<br>Check bindings in openshift...</font>";
        echo "</body>";
     exit(1);
     }




/*
  $client = new DynamoDbClient([
    'profile' => 'project1',
    'region'  => 'us-west-2',
    'version' => 'latest'
]);

 */

$client = translateClient(array(
    'credentials' => array(
        'key'    => 'SQS_AWS_ACCESS_KEY_ID',
        'secret' => 'SQS_AWS_SECRET_ACCESS_KEY',
    )
));


$result = $client->getTerminology([
    'Name' => '<string>', // REQUIRED
    'TerminologyDataFormat' => 'CSV|TMX', // REQUIRED
]);



?>
