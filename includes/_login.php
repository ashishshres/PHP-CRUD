<?php
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "./connect.php";
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // check for the email and password
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $isFound = mysqli_num_rows($result);
    if ($isFound == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row["password"])) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;
                header("location: ../index.php");
            } else {
                $showError = true;
            }
        }
    } else {
        $showError = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-zinc-900 text-white flex flex-col justify-center items-center h-full w-full">
    <nav class="bg-white dark:bg-gray-900  w-full border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">🐘PHP CRUD</span>
            </a>
        </div>
    </nav>

    <?php
    if ($showError) {
        echo '<div class="transition duration-300 ease-in-out toast-signin fixed top-20 right-0 mx-2 max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg " role="alert">
        <div class="flex p-4">
            <div class="flex-shrink-0">
                <svg class="flex-shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                </svg>
            </div>
            <div class="ms-3">
            <p class="text-sm text-gray-900">
                Invalid credentials.
            </p>
            </div>
        </div>
    </div>';
    }
    ?>

    <div class="w-full flex justify-center items-center flex-col gap-4 p-4 ">
        <h1 class="text-4xl">Login</h1>
        <form class="w-full max-w-[300px] mx-auto" method="post">
            <div class="mb-5">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="off" />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="off" />
            </div>
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="show" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                </div>
                <label for="show" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Show password</label>
            </div>
            <button type="submit" name="login" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
        </form>
    </div>
    <script src="../scripts/main.js"></script>
</body>

</html>