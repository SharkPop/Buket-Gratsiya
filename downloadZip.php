<?php
// Отключить буферизацию и сжатие
if (ob_get_level()) {
    ob_end_clean();
}
ini_set('zlib.output_compression', 'Off');

// Папка с изображениями
$imagesDir = __DIR__ . '/media/images/';

// Получаем имена файлов из POST
$files = $_POST['files'] ?? [];
if (empty($files) || !is_array($files)) {
    http_response_code(400);
    exit('Нет файлов для архивации');
}

// Имя и путь архива
$zipName = 'photos_' . time() . '.zip';
$zipPath = sys_get_temp_dir() . '/' . $zipName;

// Создание архива
$zip = new ZipArchive();
if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    http_response_code(500);
    exit('Не удалось создать архив');
}

// Добавление файлов
foreach ($files as $fileName) {
    $filePath = $imagesDir . basename($fileName);
    if (file_exists($filePath)) {
        $zip->addFile($filePath, basename($fileName));
    }
}

$zip->close();

// Отдача архива
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: Binary');
header('Content-Disposition: attachment; filename="' . $zipName . '"');
header('Content-Length: ' . filesize($zipPath));

$fp = fopen($zipPath, 'rb');
fpassthru($fp);
fclose($fp);

// Удаление временного архива
unlink($zipPath);
exit;
