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
    $directory = __DIR__;  // Use the actual directory path with __DIR__

    // Get all .html and .php files in the directory
    $files = glob($directory . "/*.{html,php}", GLOB_BRACE);

    // Loop through the files and search for the term
    foreach ($files as $file) {
        // Read the content of each file
        $content = file_get_contents($file);

        // Remove the <style> and <script> blocks completely using regex
        $content_without_styles_and_scripts = preg_replace(
            ['/<!--.*?-->/', '/<style.*?>.*?<\/style>/s', '/<script.*?>.*?<\/script>/s'],
            '',
            $content
        );

        // Strip remaining HTML tags to only get text content
        $text_content = strip_tags($content_without_styles_and_scripts);

        // Search for the term in the text content (case-insensitive)
        if (stripos($text_content, $search_term) !== false) {
            // Find position of the search term in the text content
            $pos = stripos($text_content, $search_term);

            // Extract a snippet around the search term
            $snippet_start = max($pos - 100, 0);  // Start 100 chars before the term, or at the beginning
            $snippet_end = min($pos + 100, strlen($text_content));  // End 100 chars after the term, or at the end

            $snippet = substr($text_content, $snippet_start, $snippet_end - $snippet_start);

            // Highlight the search term in the snippet
            $highlighted_snippet = str_ireplace($search_term, "<strong>$search_term</strong>", $snippet);

            // Add the file name, relative URL, and snippet to the results array
            $results[] = [
                'title' => basename($file),
                'url' => basename($file),
                'snippet' => $highlighted_snippet
            ];
        }
    }
}

// Return results as JSON
echo json_encode(['results' => $results]);
?>
