<!DOCTYPE html>
<html>
	<head>
                {{ stylesheet_link("css/default.css") }}
		<title>{{ title }} - SharpFrame</title>
                <link href='http://fonts.googleapis.com/css?family=Aguafina+Script|Orbitron:700' rel='stylesheet' type='text/css'>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#navigationswitch').click(function() {
                            $('#side-navigation').show('slide', {direction: 'left'}, 500);
                            $('#navigationswitch').hide();
                        });
                        
                        $('#exit-navigation').click(function () {
                            $('#side-navigation').hide('slide', {direction: 'left'}, 500);
                            $('#navigationswitch').show();
                        })
                    });
                </script>
	</head>
	<body>
            <div id="main-wrapper">
                <header id="header" class=" nav gradient-top">
                    <a href="/"><img id="logo" class="float-left" src="/public/img/sharpframelogo.png" /></a>
                    <div id="slogan" class="Orbitron-Font float-left">Sharp Frame</div>
                    <div id="searchbox" class="float-right">
                        <input type="textbox" name="search" />
                        <img id="exit-nav" class="float-right" src="/public/img/search.png" />
                    </div>
                </header>
                <div id="maincontent">
                    <div id="navwraper">
                        <div id="side-navigation" class="float-left gradient-top hide">
                            <div id="exit-navigation" class="float-right">X</div>
                            <div id="navigation-title" class="float-left Orbitron-Font">Navigation</div>
                            <ul>
                                <li><a href="/account/register/">Register</a></li>
                                <li><a href="/account/login">Login</a></li>
                                <li><a href="/room/register">New Room</a></li>
                                <li><a href="/search/">Search</a></li>
                            </ul>
                        </div>
                        <div id="navigationswitch" class="gradient-top">S<br />h<br />o<br />w<br /> <br />N<br />a<br />v<br /></div>
                        <div class="clrfloats"></div>
                    </div>
                    <div id="contentwraper">
                        {{ content() }}
                    </div>
                </div>
                <div id="push"></div>
            </div>
            <footer class="gradient-bottom nav text-center">
                <a href="http://tuqiri.net" class="fix-hrefs">Tuqiri.net</a><br />
                &copy; Nathan Morgan <br />
                <a href="">Contact</a> <a href="">Site Map</a> <a href="http://blog.sharpframe.co.uk">Blog</a> <a href="https://github.com/Tuqiri/SharpFrame">Git Hub</a>
            </footer>
	</body>
</html>