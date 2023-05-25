<?php
session_start();

?>

<?php
if ($_SESSION['win'] == 0) {
    // Show the form if the dice value is not yet submitted
    echo '<form action="submit.php">';
    echo '<label for="dice">Enter dice value for ' . ($_SESSION['chance'] % 2 == 0 ? "Player 1" : "Player 2") .
        ':</label>';
    echo '<input type="number" id="dice" name="dice" min="1" max="3" required>';
    echo '<input type="submit" value="Roll Dice">';
    echo '</form>';
}

?>