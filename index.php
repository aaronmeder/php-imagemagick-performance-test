<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Processing Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

<?php
/**
 * Image Processing Test
 * 
 * This script converts an input image to multiple sizes using ImageMagick and logs how long it takes.
 * Quick and dirty script, put together using ChatGPT.
 * 
 * Contact: Aaron, hello@telltec.ch
 * License: MIT License
 */

$inputImage = 'input-oguz-yagiz-kara-k-dqBTxSOHI-unsplash.jpg';
$outputFolder = 'output/';

// Define the sizes for resizing
$sizes = [
    ['width' => 100, 'height' => 100],
    ['width' => 200, 'height' => 200],
    ['width' => 300, 'height' => 300],
    ['width' => 400, 'height' => 400],
    ['width' => 500, 'height' => 500],
    ['width' => 600, 'height' => 600],
    ['width' => 700, 'height' => 700],
    ['width' => 800, 'height' => 800],
    ['width' => 1200, 'height' => 1200],
    ['width' => 1600, 'height' => 1600],
    ['width' => 2000, 'height' => 2000],
    ['width' => 2560, 'height' => 2560]
];

// Create the output folder if it doesn't exist
if (!file_exists($outputFolder)) {
    mkdir($outputFolder, 0777, true);
}

// Start the timer
$startTime = microtime(true);

// Loop through each size and resize the image
foreach ($sizes as $size) {
    $width = $size['width'];
    $height = $size['height'];

    // Generate a unique name for the resized image
    $outputImage = $outputFolder . 'resized_' . $width . 'x' . $height . '.jpg';

    // Resize the image using ImageMagick
    $imagick = new Imagick($inputImage);
    $imagick->resizeImage($width, $height, Imagick::FILTER_LANCZOS, 1);
    $imagick->writeImage($outputImage);
    $imagick->destroy();
}

echo "<h1>Image Processing Test</h1>";
echo "<p>This script converts an input image to multiple sizes using ImageMagick and logs how long it takes.</p>";

// Calculate the total processing time
$endTime = microtime(true);
$processingTime = $endTime - $startTime;

// Generate the table with links to the resized images
$table = '<table>';
foreach ($sizes as $size) {
    $width = $size['width'];
    $height = $size['height'];
    $imagePath = $outputFolder . 'resized_' . $width . 'x' . $height . '.jpg';
    $table .= '<tr><td>' . $width . 'x' . $height . '</td><td><a href="' . $imagePath . '">Link</a></td></tr>';
}
$table .= '</table>';

// Output the table and processing time
echo $table;
echo 'Total processing time: ' . round($processingTime, 3) . ' seconds';

// Get PHP version
$phpVersion = phpversion();

// Get PHP memory limit
$phpMemoryLimit = ini_get('memory_limit');

// Get ImageMagick version
$imagickVersion = null;
$imagick = new Imagick();
$imagickVersion = $imagick->getVersion()['versionString'];

// Output the meta information
echo '<p style="color: grey;">PHP Version: ' . $phpVersion . ' | PHP Memory Limit: ' . $phpMemoryLimit . ' | ImageMagick Version: ' . $imagickVersion . '</p>';

?>
    
</body>
</html>
