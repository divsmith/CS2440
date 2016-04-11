<?php
    session_start();

if ( !isset($_SESSION['randNum'])) {
    $_SESSION['randNum'] = rand(1, 100);
    $_SESSION['numGuesses'] = 0;
    $_SESSION['low'] = 1;
    $_SESSION['high'] = 100;
}

$randNum = $_SESSION['randNum'];
$userGuess = $_POST['userGuess'];
$count = $_SESSION['numGuesses'];
$message = '';

if ( isset($_POST['userGuess']) && $userGuess > 0) {
    $_SESSION['numGuesses']++;
    if ( $userGuess < $randNum ) {
        $message = "<center>You guessed too low!</center>You are on guess $count";
        $_SESSION['low'] = $userGuess;
    } else if ( $userGuess > $randNum ) {
        $message = "<center>You guessed too high!</center>You are on guess $count";
        $_SESSION['high'] = $userGuess;
    } else if ( $userGuess == $randNum ) {
        $message = "<center>Congratulations, you're right!</center>You guessed right in $count guesses";
        $_SESSION['low'] = $userGuess;
        $_SESSION['high'] = $userGuess;
        unset($_SESSION['randNum']);
        unset($_SESSION['numGuesses']);
        session_destroy();
    }
} else {
    $message = "<center>Are you ready to start?</center>You are on guess $count";
}

echo <<<HTML
    <html>
    <head>
        <title>Guessing Game</title>
    </head>
    <body>
    <center>
        <form action="sessioncode.php" method="POST">
            Guess a number 1-100:<select name="userGuess">
HTML;

if ( $_SESSION['low'] == $_SESSION['high']) {
    echo "<option value=0>" . $_SESSION['low'] . "</option>";
}
for ($i = $_SESSION['low']; $i < $_SESSION['high']; $i++)
{
    echo "<option value='$i'>$i</option>";
}

echo <<<HTML
             </select>
            <input type="submit" value="userGuess"/>
HTML;


echo "</form></center>$message</body></html>";

