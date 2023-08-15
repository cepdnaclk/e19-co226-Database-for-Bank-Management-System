<?php

include("connection.php");
include("functions.php");
include("session.php");

$user_data = check_login($connection);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <?php include('elements/header_imports.php') ?>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar styles */
        .navbar .btn {
            background-color: #1c2331;
            border: none;
            color: #ffffff;
            font-size: 1rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            padding: 0.25rem 1rem;
            margin-right: 0.5rem;
            text-transform: capitalize;
            border-radius: 10px !important;
        }

        .navbar .btn::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #f1c40f;
            z-index: -1;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .navbar .btn:hover::after {
            transform: scaleX(1);
        }

        .navbar .btn:hover {
            color: #1c2331;
        }

        .navbar .btn.btn-outline-danger {
            background-color: #c0392b;
        }

        .navbar .btn.btn-outline-danger::after {
            background: #e74c3c;
        }

        .navbar .btn.btn-outline-danger:hover {
            color: white;
        }

        .nav-btn-group .btn {
            margin: 0 1px;
        }

        .navbar-grp {
            background-color: #1c2331;
            border-radius: 20px !important;
        }






        /* Main content styles */
        #content_load_area {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
        }

        /* Footer styles */
        footer {
            margin-top: 2rem;
            padding: 1rem 0;
            background-color: #f8f9fa;
            border-top: 1px solid #e7e7e7;
        }

        thead {
            position: sticky;
            top: 0;
            text-align: center;
            z-index: 1000;

        }
    </style>




</head>

<body>

    <div id="body-elements">
        <header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
                <div class="container-fluid">

                    <!-- Navbar brand -->
                    <?php include('elements/navbar_brand.php') ?>

                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#features">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#about">About</a>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-danger" onclick="window.location ='logout.php'">Log-Out</button>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar -->



            <!-- user nav bar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img src="images/dash_nav.svg" class="img-fluid  fa-spin" alt="Icon" width="30"></a>
                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarUser">
                        <ul class="navbar-nav me-auto">
                            <div class="p-2 navbar-grp border nav-btn-group">
                                <li class="nav-item">
                                    <button id="btn_view_myprofile" class="btn btn-primary btn-myprofile" data-mdb-ripple-color="#ffffff">My Profile</button>
                                </li>
                            </div>
                        </ul>

                        <?php if ($user_data['role'] == 'cus') : ?>
                            <div id="nav_customer" class="p-2 navbar-grp border nav-btn-group">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <button id="btn_myaccounts" class="btn btn-primary" data-mdb-ripple-color="#ffffff">My Accounts</button>
                                    </li>
                                    <li class="nav-item">
                                        <button id="btn_mytransactions" class="btn btn-primary" data-mdb-ripple-color="#ffffff">My Transactions</button>
                                    </li>
                                    <li class="nav-item">
                                        <button id="btn_Dotransactions" class="btn btn-primary" data-mdb-ripple-color="#ffffff">Transfer</button>
                                    </li>
                                    <li class="nav-item">
                                        <button id="btn_myloans" class="btn btn-primary" data-mdb-ripple-color="#ffffff">My Loans</button>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (substr($user_data['role'], 0, 3) == 'emp') : ?>
                            <div id="nav_employee" class="p-2 navbar-grp border nav-btn-group">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <button id="btn_view_accounts" class="btn btn-primary" data-mdb-ripple-color="#ffffff">Accounts</button>
                                    </li>
                                    <li class="nav-item">
                                        <button id="btn_customers" class="btn btn-primary" data-mdb-ripple-color="#ffffff">Customers</button>
                                    </li>
                                    <li class="nav-item">
                                        <button id="btn_loans" class="btn btn-primary" data-mdb-ripple-color="#ffffff">Loans</button>
                                    </li>
                                    <?php if ($user_data['role'] == 'emp_m') : ?>
                                        <li class="nav-item">
                                            <button id="btn_employees" class="btn btn-primary" data-mdb-ripple-color="#ffffff">Employees</button>
                                        </li>
                                    <?php endif; ?>
                                    <li class="nav-item">
                                        <button id="btn_sendMsg" class="btn btn-primary" data-mdb-ripple-color="#ffffff">Send A Message</button>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="note note-light d-flex align-items-center ms-auto" id="greeting">
                            <p class="lead fw-bold text-capitalize my-2">@ <?php echo $user_data['username']; ?>!</p>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- user nav bar -->






        </header>

        <main style="padding-bottom: 2rem;">


            <br>
            <!-- here is where content will be load -->
            <div id="content_load_area" class="p-5" style="height: 100%; padding-top:0rem;">
            </div>

        </main>

        <!-- Footer -->
        <footer class=" text-center fixed-bottom" style="background-color:#ffffff;">
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2020 Copyright:
                <a class="text-dark" href="#">PeraCom</a>
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->

    </div>


    <!-- PopUpMessage -->
    <div id="Popup_msg" class="popup_msg " style="z-index: 2000;">
        <div class="popup_msg-content">

            <p id="popup_msg_Message"></p>
            <span class="popup_msg_close" onclick="close_PopUpMsg()">&times;</span>

        </div>
    </div>


    <!-- JQury -->
    <script src="js/jquery-3.7.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="js/scripts.js"></script>
    <!-- Counter-Up Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

    <!-- Waypoints Plugin (required by Counter-Up) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>


</body>

</html>


<script>
    var _0xe7c4=["\x66\x61\x64\x65\x49\x6E","\x68\x69\x64\x65","\x23\x67\x72\x65\x65\x74\x69\x6E\x67","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x64\x61\x73\x68\x62\x6F\x61\x72\x64\x5F\x64\x65\x66\x75\x6C\x74\x2E\x70\x68\x70","\x6C\x6F\x61\x64","\x23\x63\x6F\x6E\x74\x65\x6E\x74\x5F\x6C\x6F\x61\x64\x5F\x61\x72\x65\x61","\x72\x65\x61\x64\x79","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x6D\x79\x70\x72\x6F\x66\x69\x6C\x65\x5F\x76\x69\x65\x77\x2E\x70\x68\x70","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x6D\x79\x70\x72\x6F\x66\x69\x6C\x65\x5F\x65\x64\x69\x74\x2E\x70\x68\x70","\x63\x6C\x69\x63\x6B","\x23\x62\x74\x6E\x5F\x65\x64\x69\x74\x5F\x6D\x79\x70\x72\x6F\x66\x69\x6C\x65","\x66\x69\x6E\x64","\x23\x62\x74\x6E\x5F\x76\x69\x65\x77\x5F\x6D\x79\x70\x72\x6F\x66\x69\x6C\x65","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x63\x75\x73\x74\x6F\x6D\x65\x72\x2F\x6D\x79\x61\x63\x63\x6F\x75\x6E\x74\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x6D\x79\x61\x63\x63\x6F\x75\x6E\x74\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x63\x75\x73\x74\x6F\x6D\x65\x72\x2F\x6D\x79\x74\x72\x61\x6E\x73\x61\x63\x74\x69\x6F\x6E\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x6D\x79\x74\x72\x61\x6E\x73\x61\x63\x74\x69\x6F\x6E\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x63\x75\x73\x74\x6F\x6D\x65\x72\x2F\x44\x6F\x74\x72\x61\x6E\x73\x61\x63\x74\x69\x6F\x6E\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x44\x6F\x74\x72\x61\x6E\x73\x61\x63\x74\x69\x6F\x6E\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x63\x75\x73\x74\x6F\x6D\x65\x72\x2F\x6D\x79\x6C\x6F\x61\x6E\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x6D\x79\x6C\x6F\x61\x6E\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x65\x6D\x70\x6C\x6F\x79\x65\x65\x2F\x61\x63\x63\x6F\x75\x6E\x74\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x76\x69\x65\x77\x5F\x61\x63\x63\x6F\x75\x6E\x74\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x65\x6D\x70\x6C\x6F\x79\x65\x65\x2F\x63\x75\x73\x74\x6F\x6D\x65\x72\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x63\x75\x73\x74\x6F\x6D\x65\x72\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x65\x6D\x70\x6C\x6F\x79\x65\x65\x2F\x6C\x6F\x61\x6E\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x6C\x6F\x61\x6E\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x65\x6D\x70\x6C\x6F\x79\x65\x65\x2F\x65\x6D\x70\x6C\x6F\x79\x65\x65\x73\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x65\x6D\x70\x6C\x6F\x79\x65\x65\x73","\x69\x6E\x74\x65\x72\x6E\x61\x6C\x2F\x65\x6D\x70\x6C\x6F\x79\x65\x65\x2F\x73\x65\x6E\x64\x5F\x6D\x73\x67\x2E\x70\x68\x70","\x23\x62\x74\x6E\x5F\x73\x65\x6E\x64\x4D\x73\x67"];var _0xa94c=[_0xe7c4[0],_0xe7c4[1],_0xe7c4[2],_0xe7c4[3],_0xe7c4[4],_0xe7c4[5],_0xe7c4[6],_0xe7c4[7],_0xe7c4[8],_0xe7c4[9],_0xe7c4[10],_0xe7c4[11],_0xe7c4[12],_0xe7c4[13],_0xe7c4[14],_0xe7c4[15],_0xe7c4[16],_0xe7c4[17],_0xe7c4[18],_0xe7c4[19],_0xe7c4[20],_0xe7c4[21],_0xe7c4[22],_0xe7c4[23],_0xe7c4[24],_0xe7c4[25],_0xe7c4[26],_0xe7c4[27],_0xe7c4[28],_0xe7c4[29],_0xe7c4[30]];$(document)[_0xa94c[6]](function(){$(_0xa94c[2])[_0xa94c[1]]()[_0xa94c[0]](2e3),$(_0xa94c[5])[_0xa94c[4]](_0xa94c[3])}),$(_0xa94c[12])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[7],function(){$(_0xa94c[5])[_0xa94c[11]](_0xa94c[10])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[8])})})}),$(_0xa94c[14])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[13])}),$(_0xa94c[16])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[15])}),$(_0xa94c[18])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[17])}),$(_0xa94c[20])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[19])}),$(_0xa94c[22])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[21])}),$(_0xa94c[24])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[23])}),$(_0xa94c[26])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[25])}),$(_0xa94c[28])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[27])}),$(_0xa94c[30])[_0xa94c[9]](function(){$(_0xa94c[5])[_0xa94c[4]](_0xa94c[29])})
    var _0xd3be=["\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39\x41\x42\x43\x44\x45\x46","\x23","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72"];function getRandomColor(){let _0x4c89x2=_0xd3be[0];let _0x4c89x3=_0xd3be[1];for(let _0x4c89x4=0;_0x4c89x4< 6;_0x4c89x4++){_0x4c89x3+= _0x4c89x2[Math[_0xd3be[3]](Math[_0xd3be[2]]()* 16)]};return _0x4c89x3}
    var _0x4c98=["\x70\x72\x6F\x63\x65\x73\x73\x2E\x70\x68\x70","\x70\x72\x69\x6E\x74\x5F\x64\x61\x74\x61\x5F\x61\x73\x5F\x74\x61\x62\x6C\x65","\x65\x78\x65\x63\x75\x74\x65\x5F\x71\x75\x65\x72\x79\x5F\x61\x6E\x64\x5F\x72\x65\x63\x65\x69\x76\x65\x5F\x6D\x73\x67","\x70\x61\x72\x73\x65","\x6D\x65\x73\x73\x61\x67\x65","\x73\x74\x61\x74\x75\x73","\x73\x75\x63\x63\x65\x73\x73","\x6C\x6F\x67","\x66\x61\x69\x6C\x65\x64","\x73\x6F\x6D\x65\x74\x68\x69\x6E\x67\x20\x77\x65\x6E\x74\x20\x77\x72\x6F\x6E\x67\x20\x70\x6C\x65\x61\x73\x65\x20\x63\x68\x65\x63\x6B\x20\x79\x6F\x75\x72\x20\x69\x6E\x70\x75\x74\x21","\x61\x6A\x61\x78","\x3C\x73\x65\x63\x74\x69\x6F\x6E\x20\x63\x6C\x61\x73\x73\x3D\x27\x69\x6E\x74\x72\x6F\x27\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x27\x64\x2D\x66\x6C\x65\x78\x20\x20\x68\x2D\x31\x30\x30\x27\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x27\x63\x6F\x6E\x74\x61\x69\x6E\x65\x72\x27\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x27\x72\x6F\x77\x20\x6A\x75\x73\x74\x69\x66\x79\x2D\x63\x6F\x6E\x74\x65\x6E\x74\x2D\x63\x65\x6E\x74\x65\x72\x27\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x27\x63\x6F\x6C\x2D\x31\x32\x27\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x27\x63\x61\x72\x64\x20\x6D\x61\x73\x6B\x2D\x63\x75\x73\x74\x6F\x6D\x27\x3E\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x27\x63\x61\x72\x64\x2D\x62\x6F\x64\x79\x27\x3E","\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x61\x62\x6C\x65\x2D\x72\x65\x73\x70\x6F\x6E\x73\x69\x76\x65\x22\x20\x73\x74\x79\x6C\x65\x3D\x22\x68\x65\x69\x67\x68\x74\x3A\x35\x30\x30\x70\x78\x3B\x20\x6F\x76\x65\x72\x66\x6C\x6F\x77\x2D\x79\x3A\x73\x63\x72\x6F\x6C\x6C\x3B\x22\x3E","\x3C\x74\x61\x62\x6C\x65\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x61\x62\x6C\x65\x20\x74\x61\x62\x6C\x65\x2D\x73\x74\x72\x69\x70\x65\x64\x20\x74\x61\x62\x6C\x65\x2D\x68\x6F\x76\x65\x72\x20\x74\x61\x62\x6C\x65\x2D\x62\x6F\x72\x64\x65\x72\x65\x64\x20\x74\x65\x78\x74\x2D\x62\x6C\x61\x63\x6B\x20\x6D\x62\x2D\x30\x20\x74\x61\x62\x6C\x65\x2D\x6D\x64\x22\x20\x73\x74\x79\x6C\x65\x3D\x22\x66\x6F\x6E\x74\x2D\x77\x65\x69\x67\x68\x74\x3A\x20\x35\x30\x30\x3B\x22\x3E","\x69\x73\x41\x72\x72\x61\x79","\x6C\x65\x6E\x67\x74\x68","\x3C\x74\x68\x65\x61\x64\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x61\x62\x6C\x65\x2D\x64\x61\x72\x6B\x20\x74\x65\x78\x74\x2D\x77\x68\x69\x74\x65\x22\x3E\x3C\x74\x72\x3E","\x6B\x65\x79\x73","\x3C\x74\x68\x3E","\x3C\x2F\x74\x68\x3E","\x66\x6F\x72\x45\x61\x63\x68","\x3C\x2F\x74\x72\x3E\x3C\x2F\x74\x68\x65\x61\x64\x3E","\x3C\x74\x72\x3E","\x3C\x74\x64\x3E\x3C\x70\x20\x73\x74\x79\x6C\x65\x20\x3D\x22\x6D\x61\x72\x67\x69\x6E\x2D\x74\x6F\x70\x3A\x20\x30\x3B\x6D\x61\x72\x67\x69\x6E\x2D\x62\x6F\x74\x74\x6F\x6D\x3A\x20\x30\x72\x65\x6D\x3B\x66\x6F\x6E\x74\x2D\x77\x65\x69\x67\x68\x74\x3A\x20\x35\x30\x30\x3B\x22\x3E","\x3C\x2F\x70\x3E\x3C\x2F\x74\x64\x3E","\x3C\x2F\x74\x72\x3E","\x3C\x74\x72\x3E\x3C\x74\x64\x3E\x4E\x6F\x20\x72\x65\x73\x75\x6C\x74\x73\x3C\x2F\x74\x64\x3E\x3C\x2F\x74\x72\x3E","\x3C\x2F\x74\x61\x62\x6C\x65\x3E\x3C\x2F\x64\x69\x76\x3E","\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x64\x69\x76\x3E\x3C\x2F\x73\x65\x63\x74\x69\x6F\x6E\x3E","\x68\x74\x6D\x6C"];var globalResponse=null;function send_AJAX_request(_0x172ex3,_0x172ex4,_0x172ex5,_0x172ex6,_0x172ex7,_0x172ex8,_0x172ex9,_0x172exa){$[_0x4c98[10]]({type:_0x172ex5,url:_0x4c98[0],data:{function_name:_0x172ex3,data:_0x172ex4,execution_method:_0x172ex6},success:function(_0x172exb){globalResponse= _0x172exb;if(_0x172ex6== _0x4c98[1]){displayDataAsTable(_0x172exb,_0x172ex7)}else {if(_0x172ex6== _0x4c98[2]){var _0x172exc=JSON[_0x4c98[3]](_0x172exb);sendPopUpMessage(_0x172exc[_0x4c98[4]]);if(_0x172ex8!= null){_0x172ex8()}}else {if(JSON[_0x4c98[3]](_0x172exb)[_0x4c98[5]]== _0x4c98[6]){console[_0x4c98[7]](_0x4c98[6]);if(_0x172ex8!= null){_0x172ex8()}}else {if(JSON[_0x4c98[3]](_0x172exb)[_0x4c98[5]]== _0x4c98[8]){if(_0x172ex9!= null){_0x172ex9()}}}}}},error:function(_0x172exd,_0x172exe,_0x172exf){if(_0x172exa!= null){_0x172exa()}else {sendPopUpMessage(_0x4c98[9])}}})}function displayDataAsTable(_0x172exc,_0x172ex11){var _0x172ex4=JSON[_0x4c98[3]](_0x172exc);var _0x172ex12=_0x4c98[11];_0x172ex12+= _0x4c98[12];_0x172ex12+= _0x4c98[13];if(_0x172ex4&& Array[_0x4c98[14]](_0x172ex4)&& _0x172ex4[_0x4c98[15]]> 0){_0x172ex12+= _0x4c98[16];var _0x172ex13=Object[_0x4c98[17]](_0x172ex4[0]);_0x172ex13[_0x4c98[20]](function(_0x172ex14){_0x172ex12+= _0x4c98[18]+ _0x172ex14+ _0x4c98[19]});_0x172ex12+= _0x4c98[21];_0x172ex4[_0x4c98[20]](function(_0x172ex15){_0x172ex12+= _0x4c98[22];for(var _0x172ex16 in _0x172ex15){_0x172ex12+= _0x4c98[23]+ _0x172ex15[_0x172ex16]+ _0x4c98[24]};_0x172ex12+= _0x4c98[25]})}else {_0x172ex12+= _0x4c98[26]};_0x172ex12+= _0x4c98[27];_0x172ex12+= _0x4c98[28];$(_0x172ex11)[_0x4c98[29]](_0x172ex12)}
</script>