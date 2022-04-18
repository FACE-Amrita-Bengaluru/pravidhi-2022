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
                                        <div class="column lg-12 form-field team-size-input" style="margin-top: 50px">
                                            <input name="cTeamSize" id="cTeamSize" class="u-fullwidth team-size" placeholder="Team Size" value="" type="number" />
                                        </div>

                                        <div class="column lg-12">
                                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large u-fullwidth" value="Register" type="submit" />
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
    <script src="js/team.js"></script>
</body>

</html>

<?php

function pushRegistration()
{
    $_INCLUDE_DIR = $_SERVER['DOCUMENT_ROOT'] . '/pravidhi-2022/includes/';
    require_once $_INCLUDE_DIR . 'dependencies.php';

    foreach ($_POST as $k => $v) {
        consoleBug("post $k : $v");
    }

    foreach ($_SESSION as $k => $v) {
        consoleBug("session $k : $v");
    }

    if (count($_POST) > 0) {
        /*
        Adding new team to teams table
        */
        $event = $_SESSION['event'];

        $eventsTable = new Table_Field_Rel(
            "events",

            "tmin",
            "tmax"
        );

        $eventSyringe = new MySQL_Query_Capsule($eventsTable);
        $eventSyringe->SetWhere("$0.eventid = '$event'");

        consoleBug($eventSyringe);

        $dbc->PushQuery($eventSyringe);

        try {
            $response = $dbc->FlushStack();
        } catch (Exception $e) {
            consoleBug($e->getMessage());
        }

        $aggr = array();

        foreach ($response as $k => $v)
            foreach ($v as $_trivial => $b)
                array_push($aggr, $b);

        $minSize = $aggr[0];
        $maxSize = $aggr[1];

        consoleBug("min: $minSize");
        consoleBug("max: $maxSize");

        $size = $_POST['cTeamSize'];
        consoleBug("fetched max: $maxSize, min: $minSize; current size: $size");

        if ($maxSize < $size) {
            consoleBug('Team size exceeded');
            throwAlert("maximum team size allowed for this event is $maxSize. Please try again");
            return;
        } else if ($minSize > $size) {
            consoleBug('Team size too small');
            throwAlert("minimum team size allowed for this event is $minSize. Please try again");
            return;
        }

        $teamsTable = new Table_Field_Rel(
            "teams",

            "teamname"
        );

        $teamName = $_SESSION['cTeamName'];

        $teamSyringe = new MySQL_Query_Capsule($teamsTable);
        $injection = $teamSyringe->InsertValuesQuery("'$teamName'");

        consoleBug($injection);

        $dbc->PushQuery($injection);

        try {
            $response = $dbc->FlushStack();
        } catch (Exception $e) {
            throwAlert("Team name already taken. Please try again");
            consoleBug($e->getMessage());
            return;
        }

        /*
        Adding new team event relationship in teamevents table
        */
        $teameventsTable = new Table_Field_Rel(
            "teamevents",

            "teamname",
            "eventid"
        );

        $teamEventSyringe = new MySQL_Query_Capsule($teameventsTable);

        $injection = $teamEventSyringe->InsertValuesQuery(
            "'$teamName', '$event'"
        );

        consoleBug($injection);

        $dbc->PushQuery(
            $injection
        );

        try {
            $response = $dbc->FlushStack();
        } catch (Exception $e) {
            throwAlert("$teamName already registered for the event");
            consoleBug($e->getMessage());
            return;
        }

        for ($i = $size; $i > 0; --$i)
            if (
                Validate::Name($_POST["cName-$i"]) &&
                Validate::RegNo($_POST["cReg-$i"]) &&
                Validate::Sem($_POST["cSem-$i"]) &&
                Validate::Branch($_POST["cBranch-$i"]) &&
                Validate::PhNo($_POST["cNumber-$i"]) &&
                Validate::Email($_POST["cEmail-$i"])
            ) {
                /*
                Adding new user to register table
            */
                $registerTable = new Table_Field_Rel(
                    "register",

                    "name",
                    "regno",
                    "sem",
                    "branch",
                    "phno",
                    "email"
                );

                $userSyringe = new MySQL_Query_Capsule($registerTable);

                $userList = array(
                    "'" . $_POST["cName-$i"] . "'",
                    "'" . $_POST["cReg-$i"] . "'",
                    "'" . $_POST["cSem-$i"] . "'",
                    "'" . $_POST["cBranch-$i"] . "'",
                    "'" . $_POST["cNumber-$i"] . "'",
                    "'" . $_POST["cEmail-$i"] . "'"
                );

                $injection = $userSyringe->InsertValuesQuery(
                    implode(",", $userList)
                );

                consoleBug($injection);

                $dbc->PushQuery(
                    $injection
                ); //relay for user info mismatch

                try {
                    $response = $dbc->FlushStack();
                } catch (Exception $e) {
                    consoleBug($e->getMessage());

                    $regno = $userList[1];
                    $userSyringe->SetWhere("$0.0 = $regno");

                    try {
                        consoleBug($userSyringe);
                        $queryFetch = $dbc->RelayQuery($userSyringe);

                        foreach ($queryFetch as $_trivial => $event) {
                            $i = 0;

                            consoleBug(">>");
                            foreach ($event as $_trivial1 => $eventAttr) {
                                consoleBug("attr:$eventAttr");

                                if ("'" . $eventAttr . "'" != $userList[$i++]) {
                                    throwAlert("User details inconsistent with previous entries");
                                    consoleBug($eventAttr . '!=' . $userList[$i - 1]);
                                    return;
                                    // die('goodbye cruel world');
                                } else {
                                    consoleBug($eventAttr . '=' . $userList[$i - 1]);
                                }
                            }
                        }

                        consoleBug("User already registered, ignoring entry");
                    } catch (Exception $e1) {
                        consoleBug($e1->getMessage());
                        throwAlert('One/More of the given details is/are being used by other users. Try again please');
                    }
                }
                /*
                Adding new user event relation in userevents table
            */
                $usereventsTable = new Table_Field_Rel(
                    "userevents",

                    "regno",
                    "eventid"
                );

                $usereventsSyringe = new MySQL_Query_Capsule($usereventsTable);
                $regno = $userList[1];

                $injection = $usereventsSyringe->InsertValuesQuery(
                    "$regno,'$event'"
                );

                consoleBug($injection);

                $dbc->PushQuery(
                    $injection
                ); //relay for user event reregistration mismatch

                try {
                    $response = $dbc->FlushStack();
                } catch (Exception $e) {
                    throwAlert("registered failed: user reregistering for the event");
                    consoleBug($e->getMessage());
                    return;
                }

                /*
                Adding new team user relation in teamusers table
            */
                $teamusersTable = new Table_Field_Rel(
                    "userteams",
                    "regno",
                    "teamname"
                );

                $teamusersSyringe = new MySQL_Query_Capsule($teamusersTable);

                $injection = $teamusersSyringe->InsertValuesQuery(
                    "$regno,'$teamName'"
                );

                $dbc->PushQuery(
                    $injection
                ); //relay for user reassignment to same team

                /*
                Retrieving database response to query stack input
            */
                try {
                    $response = $dbc->FlushStack();
                } catch (Exception $e) {
                    consoleBug($e->getMessage());
                    throwAlert("registered failed: user already in a team for this event");
                    echo "<script>window.location.href='../../../index.html';</script>";
                }

                consoleBug("registeration successful");
                echo "<script>window.location.href='../registered/index.html';</script>";
            }

        foreach ($_POST as $k => $v)
            unset($_POST[$k]);

        //header("Location: http://127.0.0.1:58932/FrontEnd/index.html"); 
    }
}

pushRegistration();
