<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../Public/css/Admin/form.css">
    <link rel="stylesheet" href="../../Public/css/Admin/dashboard.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../../Public/css/Admin/userManage.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>
 
</head>

<body>
    <?php require_once 'adminNav.php'?>

    <div id="frame">
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

                <div>
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
</body>
</div>


</body>

</html>