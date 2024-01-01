<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

$request = Request::createFromGlobals();

if (!$request->files->get('file')) {
    $response = new JsonResponse(['result' => 'error', 'message' => 'No file uploaded'], Response::HTTP_BAD_REQUEST);
    $response->send();
    exit;
}

if(!$request->request->has('totalChunks') || !$request->request->has('currentChunk')) {
    $response = new JsonResponse(['result' => 'error', 'message' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    $response->send();
    exit;
}

$uploadDir = 'uploads' . DIRECTORY_SEPARATOR;
$fileName = sprintf('uploaded_file.%s', $request->request->get('extension', 'unknown'));

$totalChunks = $request->request->get('totalChunks');
$currentChunk = $request->request->get('currentChunk');
$tempFileName = $uploadDir . $fileName . '_' . $currentChunk;

move_uploaded_file($request->files->get('file')->getRealPath(), $tempFileName);

if ($currentChunk == $totalChunks - 1) {
    $finalFileName = $uploadDir . $fileName;
    $finalFile = fopen($finalFileName, 'wb');

    for ($i = 0; $i < $totalChunks; $i++) {
        $tempFileName = $uploadDir . $fileName . '_' . $i;
        $chunk = file_get_contents($tempFileName);
        fwrite($finalFile, $chunk);
        unlink($tempFileName);
    }

    fclose($finalFile);
    $response = new JsonResponse([
        'result' => 'success',
        'message' => 'File uploaded successfully',
        'mimetype' => mime_content_type($finalFileName)]);
    $response->send();
    exit;
}

$response = new JsonResponse(['result' => 'success', 'message' => 'Chunk uploaded successfully']);
$response->send();
