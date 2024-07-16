<?php
// Check if kodepelanggan parameter is set
if (isset($_GET['kodepelanggan'])) {
    // Sanitize input to prevent XSS attacks
    $kodepelanggan = htmlspecialchars($_GET['kodepelanggan']);

    // Assume you have a function to generate the document URL based on kodepelanggan
    $documentUrl = generateDocumentUrl($kodepelanggan);

    if ($documentUrl) {
        // Output the document URL as JSON response
        echo json_encode(array('documentUrl' => $documentUrl));
        exit; // Stop further execution after sending response
    } else {
        // If failed to generate document URL, return an error response
        http_response_code(500); // Internal Server Error
        echo json_encode(array('error' => 'Failed to generate document URL'));
        exit; // Stop further execution after sending response
    }
} else {
    // If kodepelanggan parameter is not provided, return an error response
    http_response_code(400); // Bad Request
    echo json_encode(array('error' => 'Parameter "kodepelanggan" is required'));
    exit; // Stop further execution after sending response
}

// Function to generate document URL (example)
function generateDocumentUrl($kodepelanggan) {
    // Example logic to construct the document URL based on kodepelanggan
    // Modify this according to how your documents are stored and accessed
    // Example: return 'http://example.com/documents/' . $kodepelanggan . '.pdf';
    return 'http://example.com/proposal/document.php?kodepelanggan=' . $kodepelanggan;
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Example of getting kodepelanggan dynamically (you can adjust this based on your application)
    var kodepelanggan = 1;

    $.ajax({
        url: 'proposal/document.php',
        method: 'GET',
        data: {
            kodepelanggan: kodepelanggan
        },
        success: function(response) {
            console.log('Document URL:', response.documentUrl);
            // Handle success scenario, for example, you can open the URL in a new tab
            window.open(response.documentUrl, '_blank');
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            // Handle error scenario, possibly log or notify the user
        }
    });
});
</script>
