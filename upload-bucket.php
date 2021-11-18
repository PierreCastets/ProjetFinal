<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

if (count($argv) <= 2) {
    echo $USAGE;
    exit();
}

$bucket = $argv[1];
$file_Path = $argv[2];

try {
    //Create a S3Client
    $s3Client = new S3Client([
        'profile' => 'default',
        'region' => 'eu-central-1',
        'version' => '2006-03-01'
    ]);
    $result = $s3Client->uploadDirectory('/var/www/html/public/uploads/photos', 'bucket-projet-final/uploads/photos');
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}


?>
