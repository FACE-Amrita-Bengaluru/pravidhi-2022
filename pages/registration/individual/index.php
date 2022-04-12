<!DOCTYPE html>
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
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png" />
        <link rel="manifest" href="site.webmanifest" />
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
                        <a href="index.html" rel="home">
                            <img
                                src="./images/logo.png"
                                alt="Logo"
                                style="width: 300px; margin-top: 100px; margin-left: -50px"
                            />
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
                                    <input
                                        type="search"
                                        class="s-header__search-field"
                                        placeholder="Search for..."
                                        value=""
                                        name="s"
                                        title="Search for:"
                                        autocomplete="off"
                                    />
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

                                    <form
                                        name="cForm"
                                        id="cForm"
                                        class="entry__form"
                                        method="post"
                                        action=""
                                        autocomplete="off"
                                    >
                                        <fieldset class="row">
                                            <div class="column lg-6 tab-12 form-field">
                                                <input
                                                    name="name"
                                                    id="cName"
                                                    class="u-fullwidth"
                                                    placeholder="Name"
                                                    value=""
                                                    type="text"
                                                />
                                            </div>

                                            <div class="column lg-6 tab-12 form-field">
                                                <input
                                                    name="regno"
                                                    id="cEmail"
                                                    class="u-fullwidth"
                                                    placeholder="Registration Number"
                                                    value=""
                                                    type="text"
                                                />
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
                                                <input
                                                    name="phno"
                                                    id="cEmail"
                                                    class="u-fullwidth"
                                                    placeholder="WhatsApp Number"
                                                    value=""
                                                    type="text"
                                                />
                                            </div>
                                            <div class="column lg-6 tab-12 form-field">
                                                <input
                                                    name="email"
                                                    id="cEmail"
                                                    class="u-fullwidth"
                                                    placeholder="Email"
                                                    value=""
                                                    type="text"
                                                />
                                            </div>

                                            <?php 
        function fetchEvents() : void
        {
          require_once "connect_to_db.php";
          require_once "query_capsule.php";
          
            $select = new Table_Field_Rel(
                "events", 
                    
                    "eventid",
                    "name",
                    "description",
                    "start",
                    "end"           
            );
            
            $query = new MySQL_Query_Capsule($select);
            consoleBug($query);
        
            $out = $dbc -> RelayQuery($query);
            $a = array();

            foreach ($out as $key => $value) {
            $b = array();

            foreach ($value as $k => $v){
                array_push($b,$v); }
                array_push($a,$b);          
            }
            echo('<div class="column lg-12">');
            echo('<div class="ss-custom-select">');
            echo('<select class="u-fullwidth" name="event" id="sampleRecipientInput">');
            echo('<option value="" hidden>Events</option>');
            $i=0;
            foreach ($a as $k => $v){
            

                    echo('<option value='."vol".$i.'>'.$v[1].'</option>');
                    
                    $i=$i+1;
                
                
            }
            echo("</select>");
        }

        fetchEvents(); 
        ?>
        <br>

                                            <div class="column lg-12">
                                                <input
                                                    name="login"
                                                    id="submit"
                                                    class="btn btn--primary btn-wide btn--large u-fullwidth"
                                                    value="Register"
                                                    type="submit"
                                                />
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
                        <span
                            >Made and maintained by
                            <a href="https://www.linkedin.com/in/suriya-2002/" target="_blank">Suriya KS</a>,
                            <a href="https://www.linkedin.com/in/jaga-pravin-b61a75195/" target="_blank"
                                >Jagapravin</a
                            >,
                            <a
                                href="https://www.linkedin.com/in/vivek-radhakrishnan-9a1a18207/"
                                target="_blank"
                                >Vivek Radhakrishnan</a
                            >
                            and,
                            <a href="https://www.linkedin.com/in/v-ganith/" target="_blank">V Ganith</a>
                            as a part of
                            <a href="#" target="_blank">FACE Website Team</a>
                        </span>
                        <span style="opacity: 0.5"
                            >With Credits to
                            <a href="https://www.styleshout.com/" target="_blank">StyleShout</a></span
                        >
                    </div>
                </div>

                <div class="ss-go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1)"
                        >
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

    function validateRegNo(string $regno) : bool
    {
      return true;
        $valid = preg_match("/^BL\.EN\.U4\.(CSE|AIE|EAC|ECE|EEE|MEE)(19|20)[0-9]{3}$/", $regno);

        if (! $valid)
          consoleBug("invalid registeration number");
        
          return $valid;
    }

    function validateName(string $name) : bool
    {
      $valid = preg_match("/^[a-zA-Z]+( [a-zA-Z]+)?( [a-zA-Z]+)?$/", $name);
      
      if (! $valid)
        consoleBug("invalid name");
    
      return $valid;
    }

    function validateSem(string $sem) : bool
    {
      $valid = preg_match("/^4|6$/", $sem);

      if (! $valid)
        consoleBug("invalid semester");

      return $valid;
    }
    
    function validateBranch(string $branch) : bool
    {
      $valid = preg_match("/^CSE|AIE|EAC|ECE|EEE|MEE$/", $branch);

      if (! $valid)
        consoleBug("invalid branch");
  
      return $valid;
    }

    function validateEmail(string $email) : bool
    {
        $valid = preg_match("/^([a-zA-Z_][a-zA-Z0-9_]*\.)*([a-zA-Z_][a-zA-Z0-9_]*)\@([a-zA-Z_][a-zA-Z0-9_]*\.)*[a-z]{2,3}$/", $email);      
        if (! $valid)
            consoleBug("invalid email");
        
        return $valid;
    }

    function validatePhNo(string $phno) : bool
    {
      $valid = preg_match("/^[0-9]{10}$/", $phno);
  
      if (! $valid)
        consoleBug("invalid phone number");
    
      return $valid;
    }
    
    function pushRegistration() : void
    {
        if (count($_POST) > 0) {
            require_once "connect_to_db.php";
            require_once "query_capsule.php";
     
            $selected_tables = new Table_Field_Rel(
                "register",
                    
                    "name",
                    "regno",
                    "sem",
                    "branch",
                    "phno",
                    "email"
                    
            );

            $query = new MySQL_Query_Capsule($selected_tables);
            
            unset($_POST['login']);

            $event = $_POST['event'];
            unset($_POST['event']);
            
            if (
                validateRegNo($_POST['regno']) &&
                validateName($_POST['name']) &&
                validateEmail($_POST['email']) &&
                validatePhNo($_POST['phno'])
            ) {
                $insertion = $query -> InsertValuesQuery(
                    implode(",", $_POST)
                );
        
                consoleBug($insertion);
                
                $dbc -> PushQuery(
                    $insertion  
                );
                
                $selected_tables = new Table_Field_Rel(
                    "userevents",
                        "regno",
                        "eventid"
                );

                $joinInsertion =  new MySQL_Query_Capsule($selected_tables);
                $regno = $_POST['regno'];

                $insertion = $query -> InsertValuesQuery(
                    "'$regno','$event'"
                );
        
                consoleBug($insertion);
                
                $dbc -> PushQuery(
                    $insertion
                );

                $return = $dbc -> FlushStack();
                consoleBug($return);
                
                if( empty($return) ) {
                    consoleBug("registered failed: re-registeration is not allowed");
                    return;
                }
        
                consoleBug("registeration successful");
            }

            foreach ($_POST as $k=>$v) {
                unset($_POST[$k]);
            }
            
            //header("Location: http://127.0.0.1:58932/FrontEnd/index.html"); 
        }
    }

pushRegistration();