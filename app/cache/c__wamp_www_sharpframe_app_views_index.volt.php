<!DOCTYPE html>
<html>
	<head>
                <link rel="stylesheet" type="text/css" href="/public/css/default.css">
		<title><?php echo $title; ?> - SharpFrame</title>
	</head>
	<body>
            <div id="mainwrapper">
                <header>
                    <img src="/public/img/sharpframelogo.png" />
                    <nav>
                        
                    </nav>
                </header>
                <div id="maincontent">
                    <?php echo $this->getContent(); ?>
                </div>
                <footer>
                    &copy; Nathan Morgan
                </footer>
            </div>
	</body>
</html>