<?php

abstract class View {
    
    protected $pageInfo;    // holds the data read from the pages table
    protected $model;       //object for the database class
    
    
    /*
    The construct function is always triggered straight away, as we'll always need
    $pageInfo so as to know what to display, and also $model as each page is coming
    from the database, let alone all the user & recipe information.
    */
    public function __construct($info, $model) {
        
        $this -> pageInfo = $info;
        $this -> model = $model;
        
    }
    
    public function displayPage() {
        
        $this -> model -> checkUserSession();

        $html = $this -> displayHeader();
        $html .= $this -> displayContent();
        $html .= $this -> displayFooter();
        
        return $html;        
    }
    
    abstract protected function displayContent();
    
    private function displayHeader() {

        if($_GET['page'] == 'userPanel') {
            
        }

        /*
        Displaying all the header information
        */
        
        $html =  '<html>'."\n";
        $html .= '<head>'."\n";
        $html .= '<meta charset="UTF-8">'."\n";
        $html .= '<title>'.$this -> pageInfo['pageTitle'].'</title>'."\n";
        $html .= '<link rel="stylesheet" type="text/css" href="css/menu.css" />'."\n";
        $html .= '<link rel="stylesheet" type="text/css" href="css/styles.css" />'."\n";
        $html .= '<link href="http://fonts.googleapis.com/css?family=Text+Me+One|Raleway:400,200" rel="stylesheet" type="text/css" />'."\n";
        $html .= '<meta name="description" content="'.$this -> pageInfo['pageDescription'].'" />'."\n";
        $html .= '<meta name="keywords" content="'.$this -> pageInfo['pageKeywords'].'" />'."\n";
        $html .= '<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>'."\n";
        $html .= '<script src="js/modernizr.custom.25376.js"></script>'."\n";
        $html .= '</head>'."\n";
        $html .= '<body>'."\n";
        $html .= '<div id="header">'."\n";
        $html .= '<div id="hamburger-container">'."\n";
        $html .= '<button id="showMenu" class="hamburger hamburger--vortex" type="button">'."\n";
        $html .= '<span class="hamburger-box">'."\n";
        $html .= '<span class="hamburger-inner"></span>'."\n";
        $html .= '</span>'."\n";
        $html .= '</button>'."\n";
        $html .= '</div> <!-- eo#hamburger-container -->'."\n";
        $html .= '<h1><a id="logo" href="index.php?page=home">Mixer</a></h1>'."\n";
        $html .= '</div>'."\n";
        $html .= '<div id="perspective" class="perspective effect-laydown">'."\n";
        $html .= '<div id="container" class="container">'."\n";
        $html .= '<div class="wrapper">'."\n";
        
        $html .= '<div id="content">'."\n";
        
        return $html;
        
    }

    
    private function displayFooter() {
        

        
        $html = '</div>'."\n";
        $html .= '<div id="footer">'."\n";
        $html .= '<p>Copyright 2012, Mixer Corporation Inc.</p>'."\n";
        $html .= '</div>'."\n";
        $html .= '</div>'."\n";
        $html .= '</div>'."\n";
        $html .= '<nav class="outer-nav top horizontal">'."\n";

        $html .= '<a href="index.php?page=home&amp;mixerReset=true" class="icon-home">Home</a>'."\n";
        $html .= '<a href="index.php?page=recipes&amp;recipes=all" class="icon-news">Recipes</a>'."\n";
        $html .= '<a href="index.php?page=contact" class="icon-image">Contact</a>'."\n";
        $html .= '<a href="index.php?page=about" class="icon-upload">About</a>'."\n";

        /*
        Checking to see if anyone is logged in or not so as to discern whether to display an empty
        login box, or a box that welcomes the user and gives them the option to either logout or
        to visit their user panel.
        */
        if($_SESSION['userName'] && !$_POST['deleteProfile']) {

        $html .= '<div id="loggedIn">'."\n";
        $html .= '<p>Welcome '.$_SESSION['userName'].'</p>'."\n";
        $html .= '<form method="post" action="index.php">'."\n";
        $html .= '<a href="index.php?page=userPanel" class="myButton">User Panel</a>'."\n";
        $html .= '<a href="#" class="myButton" id="logoutBtn">Logout</a>'."\n";
        $html .= '<input type="submit" name="logoutButton" id="logoutButton" class="loginBtn" value="Logout" />'."\n";
        $html .= '</form>'."\n";
        $html .= '</div>'."\n";

        } else {

        $html .= '<!--div id="login">'."\n";
        $html .= '<form method="post" action="index.php">';
        $html .= '<div class="loginFields">'."\n";
        $html .= '<label for="userName">Username:</label>'."\n";
        $html .= '<input type="text" name="userName" id="userName" />'."\n";
        $html .= '</div>'."\n";
        $html .= '<div class="loginFields">'."\n";
        $html .= '<label for="userPassword">Password:</label>'."\n";
        $html .= '<input type="password" name="userPassword" id="userPassword" />'."\n";
        $html .= '</div>'."\n";
        $html .= '<div class="clearDiv"></div>'."\n";
        $html .= '<a href="#" class="myButton" id="loginBtn">Login</a>'."\n";
        $html .= '<a href="index.php?page=register" class="myButton">Register</a>'."\n";
        $html .= '<input type="submit" name="loginButton" id="loginButton" class="loginBtn" value="Login" />'."\n";
        $html .= '</form>'."\n";
        $html .= '<p>'.$this -> model -> loginMsg.'</p>';
        $html .= '<div class="clearDiv"></div>'."\n";
        $html .= '</div-->'."\n";

        $html .= '<div class="login-box">'."\n";
        $html .= '<h1>Login</h1>'."\n";
        $html .= '<form method="post" action="index.php">';
        $html .= '<input type="text" name="userName" placeholder="Username"/>'."\n";
        $html .= '<input type="text" name="userPassword" placeholder="Password"/>'."\n";
        $html .= '<input type="submit" name="loginButton" id="loginButton" class="loginBtn" value="Login" />'."\n";
        $html .= '<button>Login</button>'."\n";
        $html .= '</form>'."\n";
        $html .= '<p>Not a member? <a href="index.php?page=register">Sign Up</a></p>'."\n";
        $html .= '</div>'."\n";

        }

        $html .= '</nav>'."\n";
        $html .= '</div>'."\n";
        $html .= '<script type="text/javascript" src="js/classie.js"></script>'."\n";
        $html .= '<script type="text/javascript" src="js/menu.js"></script>'."\n";
        $html .= '<script type="text/javascript" src="js/scripts.js"></script>'."\n";

        $html .= '</body>'."\n";
        $html .= '</html>'."\n";


        
        return $html;
    }
    
    
    
}





?>