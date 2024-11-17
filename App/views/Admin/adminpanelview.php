<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../Public/css/Admin/form.css">
    <link rel="stylesheet" href="../../Public/css/Admin/dashboard.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>
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
</body>
        </div>

        

 

    <!-- Popup Form -->

    <div class="popup">
        <div id="form-port">
        <span class="frmclosebtn">&times;</span>
            <form>
                <div>
                   <h1 style="text-align:center">Create New User</h1>
                </div>
                <div>
                    Enter User Name:
                </div>
                <div>
                    <input type="text" placeholder="User Name" name="uname">
                </div>
                <div>
                    Enter User Email:
                </div>
                <div>
                    <input type="text" placeholder="Email" name="uemail">
                </div>
                <div>
                    Enter Phone Number:
                </div>
                <div>
                    <input type="text" placeholder="Phone Number" name="upn">
                </div>
                <div>
                    Enter Address:
                </div>
                <div>
                    <input type="text" placeholder="Address" name="uaddress">
                </div>
                <div>
                    Enter Initial Password:
                </div>
                <div>
                    <input type="password" placeholder="Password" name="upw">
                </div>
                <div>
                    Renter Initial Password:
                </div>
                <div>
                    <input type="password" placeholder="Password Confirm" name="rpw">
                </div>
                <button type="Submit" style="width:150px;height: 45px;">Create profile</button>
            </form>
        </div>
    </div>


    <script>
    document.getElementById("createacc").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "flex";

        document.getElementById("content").classList.add("blur");
    })



    var popup = document.querySelector(".popup");


      // Get the <span> element that closes the modal
      var span = document.querySelector(".frmclosebtn")[0];
    

    // When the user clicks on <span> (x), close the modal
    popup.onclick = function() {
        popup.style.display = "none";
        document.getElementById("content").classList.remove("blur");
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none";
            
        }
    }
    </script>


</body>

</html>
