<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize an empty array to store search results
$results = [];

// Check if the search term is set via GET method
if (isset($_GET['gsearch'])) {
    $search_term = $_GET['gsearch'];

    // Sanitize the search term to prevent XSS attacks
    $search_term = htmlspecialchars($search_term);

    // Set the directory where your files are located
    $directory = __DIR__;  // Update this to your actual folder name

    // Get all .html and .php files in the directory
    $files = glob($directory . "/*.{html,php}", GLOB_BRACE);

    // Loop through the files and search for the term
    foreach ($files as $file) {
        // Read the content of each file
        $content = file_get_contents($file);

        // Search for the term in the file content (case-insensitive)
        if (stripos($content, $search_term) !== false) {
            // Add the file name and the relative URL to the results array
            $results[] = [
                'title' => basename($file),
                'url' => $file  // Relative URL (since the file is in the same project root)
            ];
        }
    }
}

// Return results as JSON
echo json_encode(['results' => $results]);
?>
