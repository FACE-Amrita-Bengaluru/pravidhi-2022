<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en" class="no-js">

<head>
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
    </script>
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="./../../../images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./../../../images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./../../../images/favicon-16x16.png" />
    <link rel="manifest" href="./../../../site.webmanifest" />
</head>

<body id="top">
    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- page wrap
    ================================================== -->
    <section id="page" class="s-pagewrap">
        <!-- # site header
        ================================================== -->
        <header id="masthead" class="s-header">
            <div class="s-header__branding">
                <p class="site-title">
                    <a href="./../../../index.html" rel="home">
                        <img src="./images/logo.png" alt="Logo" style="width: 300px; margin-top: 100px; margin-left: -50px" />
                    </a>
                </p>
            </div>
            <div class="row s-header__navigation">
                <nav class="s-header__nav-wrap">
                    <h3 class="s-header__nav-heading">Navigate to</h3>
                    <!-- end s-header__nav -->
                </nav>
                <!-- end s-header__nav-wrap -->
            </div>
            <!-- end s-header__navigation -->
            <div class="s-header__search">
                <div class="s-header__search-inner">
                    <div class="row">
                        <form role="search" method="get" class="s-header__search-form" action="#">
                            <label>
                                <span class="u-screen-reader-text">Search for:</span>
                                <input type="search" class="s-header__search-field" placeholder="Search for..." value="" name="s" title="Search for:" autocomplete="off" />
                            </label>
                            <input type="submit" class="s-header__search-submit" value="Search" />
                        </form>
                        <a href="#0" title="Close Search" class="s-header__search-close">Close</a>
                    </div>
                    <!-- end row -->
                </div>
                <!-- s-header__search-inner -->
            </div>
            <!-- end s-header__search -->
        </header>
        <!-- end s-header -->
        <!-- # site-content
        ================================================== -->
        <div id="content" class="s-content s-content--page">
            <div class="row entry-wrap">
                <div class="column lg-12">
                    <article class="entry">
                        <header class="entry__header entry__header--narrow">
                            <h1 class="entry__title">Register.</h1>
                        </header>
                        <div class="entry__media">
                            <figure class="featured-image"></figure>
                        </div>
                        <div class="content-primary">
                            <div class="entry__content">
                                <div class="row block-large-1-2 block-tab-whole entry__blocks"></div>
                                <form name="cForm" id="cForm" class="entry__form" method="post" action="" autocomplete="off">
                                    <fieldset class="row">
                                        <div class="column lg-12">
                                            <div class="ss-custom-select">
                                                <select class="u-fullwidth" name="cEvent" id="sampleRecipientInput">
                                                    <option value="" hidden>Events</option>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($_SESSION["index1"] as $k => $v) {
                                                        echo ('<option value=' . "'" . $v[0] . "'" . '>' . $v[2] . ' - ' . $v[1] . '</option>');
                                                        $i = $i + 1;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="column lg-6 tab-12 form-field">
                                            <input name="name" id="cName" class="u-fullwidth" placeholder="Name" value="" type="text" />
                                        </div>
                                        <div class="column lg-6 tab-12 form-field">
                                            <input name="regno" id="cEmail" class="u-fullwidth" placeholder="Registration Number" value="" type="text" />
                                        </div>
                                        <div class="column lg-6 tab-12 form-field">
                                            <div class="ss-custom-select">
                                                <select class="u-fullwidth" name="sem" id="sampleRecipientInput">
                                                    <option value="" hidden>Semester</option>
                                                    <option value="4">4</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="column lg-6 tab-12 form-field">
                                            <div class="ss-custom-select">
                                                <select class="u-fullwidth" name="branch" id="sampleRecipientInput">
                                                    <option value="" hidden>Branch</option>
                                                    <option value="CSE">CSE</option>
                                                    <option value="AIE">AIE</option>
                                                    <option value="ECE">ECE</option>
                                                    <option value="EAC">EAC</option>
                                                    <option value="MEE">MEE</option>
                                                    <option value="EEE">EEE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="column lg-6 tab-12 form-field">
                                            <input name="phno" id="cEmail" class="u-fullwidth" placeholder="WhatsApp Number" value="" type="text" />
                                        </div>
                                        <div class="column lg-6 tab-12 form-field">
                                            <input name="email" id="cEmail" class="u-fullwidth" placeholder="Email" value="" type="text" />
                                        </div>
                                        <div class="column lg-12">
                                            <input name="login" id="submit" class="btn btn--primary btn-wide btn--large u-fullwidth" value="Register" type="submit" />
                                        </div>
                                    </fieldset>
                                </form>
                                <!-- end form -->
                            </div>
                        </div>
                        <!-- end content-primary -->
                    </article>
                    <!-- end entry -->
                </div>
            </div>
            <!-- end entry-wrap -->
        </div>
        <!-- end s-content -->
        <!-- # site-footer
        ================================================== -->
        <!-- contact
            ----------------------------------------------- -->
        <section id="contact" class="s-contact target-section">
            <div class="row s-contact__infos">
                <div class="column lg-8 md-6 stack-on-900 s-contact__block-address">
                    <h5 class="with-top-line">Where to Find Us</h5>
                    <p>
                        Amrita Vishwa Vidyapeetham University,<br />
                        Kasavanahalli, Carmelaram P.O., <br />
                        Bangalore - 560 035. <br />
                    </p>
                </div>
                <div class="column lg-4 md-12 stack-on-900 s-contact__block-number">
                    <h5 class="with-top-line">Contact Us</h5>
                    <ul class="s-contact__list">
                        <li><a href="mailto:pravidhi@blr.amrita.edu">pravidhi@blr.amrita.edu</a></li>
                        <li>
                            <a href="https://www.instagram.com/pravidhi_aseb/">
                                <i class="fa-brands fa-instagram"></i>
                                <span>Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end s-contact__infos -->
        </section>
        <!-- end contact -->
        <!-- end s-content -->
        <!-- footer
        ================================================== -->
        <footer id="colophon" class="s-footer">
            <div class="row">
                <div class="column lg-12 ss-copyright">
                    <span>&#169; Copyright Pravidhi Amrita 2022</span>
                    <span>Made and maintained by
                        <a href="https://www.linkedin.com/in/suriya-2002/" target="_blank">Suriya KS</a>,
                        <a href="https://www.linkedin.com/in/jaga-pravin-b61a75195/" target="_blank">Jagapravin</a>,
                        <a href="https://www.linkedin.com/in/vivek-radhakrishnan-9a1a18207/" target="_blank">Vivek Radhakrishnan</a>
                        and,
                        <a href="https://www.linkedin.com/in/v-ganith/" target="_blank">V Ganith</a>
                        as a part of
                        <a href="#" target="_blank">FACE Website Team</a>
                    </span>
                    <span style="opacity: 0.5">With Credits to
                        <a href="https://www.styleshout.com/" target="_blank">StyleShout</a></span>
                </div>
            </div>
            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1)">
                        <path d="M6 4h12v2H6zm5 10v6h2v-6h5l-6-6-6 6z"></path>
                    </svg>
                </a>
            </div>
            <!-- end ss-go-top -->
        </footer>
        <!-- end s-footer -->
    </section>
    <!-- end s-pagewrap -->
    <!-- Java Script
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
<?php

function pushRegistration()
{
    $_INCLUDE_DIR = $_SERVER['DOCUMENT_ROOT'] . '/pravidhi-2022/includes/';
    require_once $_INCLUDE_DIR . 'dependencies.php';

    $select = new Table_Field_Rel(
        "events",

        "eventid", //0
        "name", //1
        "eventname", //2
        "venue", //3
        "start", //4
        "end", //5
        "description", //6
        "tmin", //7
        "tmax" //8
    );

    $query = new MySQL_Query_Capsule($select);
    $query->SetWhere("$0.8 = 1");

    consoleBug($query);

    try {
        $out = $dbc->RelayQuery($query);
    } catch (Exception $e) {
        consoleBug($e->getMessage());
    }

    $a = array();

    foreach ($out as $_trivial => $eventTuple) {
        $b = array();

        consoleBug(">>");
        foreach ($eventTuple     as $_trivial1 => $eventAttr) {
            consoleBug("attr: $eventAttr");
            array_push($b, $eventAttr);
        }

        array_push($a, $b);
    }

    consoleBug($a[0][0]);

    $_SESSION["index1"] = $a;

    if (count($_POST) > 0) {
        $selected_tables = new Table_Field_Rel(
            "register",

            "regno",
            "name",
            "sem",
            "branch",
            "phno",
            "email"
        );

        $query = new MySQL_Query_Capsule($selected_tables);
        $event = $_POST['cEvent'];
        consoleBug("event:$event");

        if (
            Validate::RegNo($_POST['regno']) &&
            Validate::Name($_POST['name']) &&
            Validate::Sem($_POST['sem']) &&
            Validate::Branch($_POST['branch']) &&
            Validate::PhNo($_POST['phno']) &&
            Validate::Email($_POST['email']) ||
            true
        ) {
            $userList = array(
                "'" . $_POST['regno'] . "'",
                "'" . $_POST['name'] . "'",
                "'" . $_POST['sem'] . "'",
                "'" . $_POST['branch'] . "'",
                "'" . $_POST['phno'] . "'",
                "'" . $_POST['email'] . "'"
            );

            $insertion = $query->InsertValuesQuery(
                implode(",", $userList)
            );

            consoleBug($insertion);

            $dbc->PushQuery(
                $insertion
            );

            try {
                $return = $dbc->FlushStack();
                consoleBug($return);
            } catch (Exception $e) {
                consoleBug($e->getMessage());
                // throwAlert('boo');
                // header('Location: localhost/pravidhi-2022/index.html');
            }

            $selected_tables = new Table_Field_Rel(
                "userevents",
                "regno",
                "eventid"
            );

            $joinInsertion =  new MySQL_Query_Capsule($selected_tables);

            $regno = $userList[0];

            $insert = $joinInsertion->InsertValuesQuery(
                "$regno,'$event'"
            );
            consoleBug($insert);

            $dbc->PushQuery(
                $insert
            );

            try {
                $response = $dbc->FlushStack();
            } catch (Exception $e) {
                throwAlert("registration failed: you have already registered for this event");
                consoleBug($e->getMessage());
                echo "<script>window.location.href='../../../index.html';</script>";
                exit;
            }

            consoleBug("registeration successful");
            echo "<script>window.location.href='../registered/index.html';</script>";
            exit;
        }
    }
}   
pushRegistration();
?>