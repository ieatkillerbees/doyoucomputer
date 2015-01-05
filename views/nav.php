<header id="header">

    <h1 id="logo"><a href="/">DoYou.Computer?</a></h1>
    <nav id="nav">
        <ul>
            {% if name|length > 0%}
            <li><a href="/" class="button">Dashboard</a></li>
            {%else%}
            <li><a href="/#main" class="button">How's It Work?</a></li>
            {%endif%}
            <li><a href="/current" class="button">Current</a></li>
            <li><a href="/past" class="button">Past</a></li>

                {% if name|length > 0%}
            <li class="submenu opener"
                style="-webkit-user-select: none; cursor: pointer; white-space: nowrap; opacity: 1;">
                <a href=""><img src="{{image}}" style="max-width: 30px;
max-height: 30px;
border-radius: 8px;
border: 2px solid black;
vertical-align: top;
margin-top: -10px;
                "></a>

                <ul class="" style="-webkit-user-select: none; display: none; position: absolute;">
                    <li style="white-space: nowrap;">
                        <a href="/challenges" style="display: block;">
                            <i class="fa fa-laptop"></i> My Challenges</a>
                    </li>
                    <li>
                        <a href="/notifications">        <i class="fa fa-bell"></i> Notifications</a>
                    </li>
                    <li style="white-space: nowrap;">
                        <a href="/logout" style="display: block;">
                            <i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </li>
            {%else%}
            <li><a href="/signup" class="button special">Sign Up</a></li>
            <li>|</li>
            <li><a href="/auth" class="button special">Login</a></li>
            {% endif %}
        </ul>
    </nav>
</header>