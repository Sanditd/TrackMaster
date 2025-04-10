
<?php
if (!defined('LOADED_FROM_MAIN')) {
    require_once 'adminNav.php';
}

session_start();

// Check if the session variables are set
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

?>

<div class="container">
        <div class="chart">
            <div id="topic">
                Matrix
            </div>
        </div>

        <div class="alert">
            <div id="topic">
                System Alert
            </div>

            <table class="tg">
                <thead>
                    <tr>
                        <td class="tg-0lax">
                            2024.06.30 | 08.30
                        </td>
                        <td class="tg-req">
                            <div id="tg-con">Account delete req</div>
                        </td>
                        <td>
                            <div id="tg-button"><button>View</button></div>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="user">
            <div id="topic">
                User Engagement
            </div>

            <div >
                <table class="ue">
                    <tr>
                        <th rowspan="2">Period</th>
                        <th colspan="4">New Users</th>
                        <th rowspan="2">Account Deletions</th>
                    </tr>

                    <tr>
                        <td>Coaches</td>
                        <td>Players</td>
                        <td>School</td>
                        <td>Parents</td>
                    </tr>

                    <tr>
                        <td>June 2024</td>
                        <td>2</td>
                        <td>26</td>
                        <td>1</td>
                        <td>26</td>
                        <td>0</td>
                    </tr>

                </table>
            </div>

        </div>
        <div class="sports">
            <div id="topic">
                Sport Engagement
            </div>
        </div>
        <div class="req">
            <div id="topic">
                Account Deletion Request
            </div>

            <table class="tg">
                <thead>
                    <tr>
                        <td class="tg-0lax">
                            2024.06.30 | 08.30
                        </td>
                        <td class="tg-req">
                            <div id="tg-con">Player : Charitha Sudewa</div>
                        </td>
                        <td>
                            <div id="tg-button"><button>View</button></div>
                        </td>
                    </tr>
                </thead>
            </table>

        </div>
        <div class="notification">
            <div id="topic">
                Notifications
            </div>
        </div>
    </div>
