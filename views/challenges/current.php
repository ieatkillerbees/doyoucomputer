{%include "header.php"%}
	<body class="left-sidebar">
	
		<!-- Header -->
        {%include "nav.php"%}


        <!-- Main -->
			<article id="main">
				<header class="special container">
					<span class="icon fa-laptop"></span>
					<h2>Coming Soon</h2>
                    {% if name%}
                    {%else%}
                    <p>Have you signed up yet?</p>
                    <br>
                    <footer>
                        <ul class="buttons vertical">
                            <li><a href="/signup" class="button special">Do it now</a></li>
                        </ul>
                    </footer>
                    {%endif%}
				</header>


			</article>

		<!-- Footer -->
			{%include "footer.php"%}
	</body>
</html>