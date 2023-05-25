<?php

session_start();
?>
<?php
function display($a)
{
    $output = "";
    for ($i = 7; $i >= 5; $i--)
        $output .= $a[$i] . "\t";
    $output .= "\n" . $a[0] . "\t" . $a[8] . "\t" . $a[4] . "\n";
    for ($i = 1; $i <= 3; $i++)
        $output .= $a[$i] . "\t";
    return $output;
}
function resetplayer(
    &$board,
    &$place,
    $player
) {
    $board[$place] -= $player;
    $place = 0;
    $board[0] = $player;
}
function check(&$board, &$place, $dice, $player)
{
    if ($place + $dice == 8) {
        $_SESSION['win'] = 1;
        return 1;
    }
    if (($place + $dice) >= 8) {
        return -1;
    }
    if ($board[$place] == 3) {
        $board[$place] -= $player;
    }
    $board[$place] = 0;
    $place += $dice;
    $board[$place] += $player;
    return -1;
}
$dice = (int) $_GET['dice'];

// Continue the game logic with the dice value
$board = $_SESSION['board'];
$placep1 = $_SESSION['placep1'];
$placep2 = $_SESSION['placep2'];
$win = $_SESSION['win'];
$chance = $_SESSION['chance'];

if ($chance % 2 == 0) {

    check($board, $placep1, $dice, 1);
} else {
    check($board, $placep2, $dice, 2);
}

if ($placep1 == $placep2 && $placep1 != 4) {
    if ($chance % 2 == 0) {
        resetplayer($board, $placep2, 2);
        echo "<p>Player 2 has been killed</p>";
    } else {
        resetplayer($board, $placep1, 1);
        echo "<p>Player 1 has been killed</p>";
    }
}

// Update the session variables with the latest values
$_SESSION['board'] = $board;
$_SESSION['placep1'] = $placep1;
$_SESSION['placep2'] = $placep2;
$_SESSION['chance']++;

// Display the game results
if ($_SESSION['win'] == 1) {
    echo "<p>Player " . ($chance % 2 == 0 ? "1" : "2") . " Wins</p>";
    // Clear the session variables after the game ends
    session_unset();
    session_destroy();
} else {
    echo "
    <pre>" . display($_SESSION['board']) . "</pre>";
    echo "<form action='maingame.php'>
    <input type='submit' value='Next Player' />
</form>";


}




?>