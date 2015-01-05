{% include "header.php" %}
	<body class="index">
	
		<!-- Header -->
			{%include "nav.php"%}
		<!-- Main -->
        {% if name %}
            {%include "user/dashboard.php"%}
        {%else%}
            {%include "main_content.php"%}
        {%endif%}


		<!-- Footer -->
        {% include "footer.php" %}

	</body>
</html>