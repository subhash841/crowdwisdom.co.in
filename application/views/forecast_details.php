<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo "<pre>";
//print_r($user_forecast);
//print_r($election_period);
//print_r($states);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Prediction Details</title>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>

    <body>
        <header>
            <?php
            echo "Election Duration - <strong>" . date("Y-m-d", strtotime($election_period[0]['from_date'])) . " to " . date("Y-m-d", strtotime($election_period[0]['to_date'])) . "</strong>, ";
            echo "<strong>" . $states[0]['name'] . " Elections</strong>";
            echo "<br /><br />";
            ?>
        </header>
        <form name="user_forecast" id="user_forecast" action="ForecastDetails/updateUserForecast" method="post">
            <table>
                <input type="hidden" name="election_period" id="election_period" value="<?= $election_period[0]['id'] ?>">
                <input type="hidden" name="election_state" id="election_state" value="<?= $states[0]['id'] ?>">
                <tr>
                    <th>Party</th>
                    <th>Seat Prediction</th>
                    <th>Actual</th>
                </tr>
                <?php
                $actual_seats = "";
                //$actual_seats = ($election_period[0]['is_result_out'] != 0) ? $seat_forecast['actual_seats'] : "TBA";
                foreach ($user_forecast as $seat_forecast) {
                    echo '<tr>
                        <td>' . $seat_forecast['party'] . '</td>
                        <td>
                            <input type="hidden" name="party[]" id="party" value="' . $seat_forecast['party_id'] . '" />
                            <input type="text" name="seat_forecast[]" value="' . $seat_forecast['seat_forecast'] . '" />
                        </td>
                        <td>' . $actual_seats . '</td>
                    </tr>';
                }
                ?>
            </table>
            <br />
            <table>
                <tr>
                    <th>Party</th>
                    <th>Vote Prediction</th>
                    <th>Actual</th>
                </tr>
                <?php
                $actual_votes = "";
                //$actual_votes = ($election_period[0]['is_result_out'] != 0) ? $vote_forecast['actual_votes'] : "TBA";
                foreach ($user_forecast as $vote_forecast) {
                    echo '<tr>
                        <td>' . $vote_forecast['party'] . '</td>
                        <td><input type="text" name="vote_forecast[]" value="' . $vote_forecast['vote_forcast'] . '" /></td>
                        <td>' . $actual_votes . '</td>
                    </tr>';
                }
                ?>
            </table>
            <input type="submit" name="save_forecast" id="save_forecast" style="float:right;" value="Save">
        </form>
    </body>
</html>