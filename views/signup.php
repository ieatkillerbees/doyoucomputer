{%include "header.php"%}
	<body class="left-sidebar">
	
		<!-- Header -->
        {%include "nav.php"%}


        <!-- Main -->
			<article id="main">
				<header class="special container">
					<span class="icon fa-laptop"></span>
					<h2>Sign Up</h2>
                    <p>We use github for signup. If you don't have a github account, <a href="/contact">shoot us an email</a>. </p>
                    <p>By signing up, you agree to receive emails from us a few times a month.</p>
                    <footer>
                        <ul class="buttons">
                            <li><a href="/auth" class="button special">Sign Up with <i class="fa fa-2x fa-github"></i></a></li>
                        </ul>
                    </footer>
                    <br>
                    <hr>
                    <br>
                    <h2>Already have an account?</h2>
                    <footer>
                        <ul class="buttons">
                            <li><a href="auth" class="button">Login with <i class="fa fa-2x  fa-github"></i></a></li>
                        </ul>
                    </footer>
				</header>


			</article>

		<!-- Footer -->
			{%include "footer.php"%}
	</body>
</html>