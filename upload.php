<?php

$uploadDir = 'uploads/';
$fileName = 'uploaded_file';

if (!empty($_FILES['file']) && isset($_POST['totalChunks']) && isset($_POST['currentChunk'])) {
    $totalChunks = $_POST['totalChunks'];
    $currentChunk = $_POST['currentChunk'];
    $tempFileName = $uploadDir . $fileName . '_' . $currentChunk;

    move_uploaded_file($_FILES['file']['tmp_name'], $tempFileName);

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
        echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully']);
    } else {
        echo json_encode(['status' => 'success', 'message' => 'Chunk uploaded successfully']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
