<?php

/* master.html.twig */
class __TwigTemplate_940d965ecc5909e9df61df45bbdfd9e74f27f73ba332ff616e5890f816d72ff7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'login' => array($this, 'block_login'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link rel=\"stylesheet\" href=\"/styles.css\" />
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>

    ";
        // line 11
        $this->displayBlock('head', $context, $blocks);
        // line 12
        echo "</head>
<body>
    <div id=\"header\">
        <div id=\"logo\">
            <img src=\"/images/ticket5.png\"  alt=\"Logo\">
            <h1>Reservation Service</h1>
        </div>            
        <div id=\"topMenu\">
            <ul>
                <li><a href=\"/help\" >HELP</a></li>
                <li><a href=\"/contact\" >CONTACT AS</a></li>
                <li><a href=\"/about\" >ABOUT AS</a></li>
            </ul>
        </div>
    </div>   
    <div id=\"centerContent\">

        <div id=\"content\">
            <div id=\"loginBlock\">";
        // line 30
        $this->displayBlock('login', $context, $blocks);
        echo "</div>    
        ";
        // line 31
        $this->displayBlock('content', $context, $blocks);
        // line 32
        echo "    </div>

</div>
<div id=\"footer\">                
    &copy; Copyright 2016 by <a href=\"/\">TORS</a>.                
</div>


<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-85707574-1', 'auto');
    ga('send', 'pageview');

</script>


</body>
<!-- valeriy
        <div id=\"footer\">                
            &copy; Copyright 2016 by <a href=\"/\">TORS</a>.                
        </div>
 
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85701035-1', 'auto');
  ga('send', 'pageview');

</script>

    </body>
-->
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
    }

    // line 11
    public function block_head($context, array $blocks = array())
    {
    }

    // line 30
    public function block_login($context, array $blocks = array())
    {
    }

    // line 31
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "master.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  132 => 31,  127 => 30,  122 => 11,  117 => 5,  66 => 32,  64 => 31,  60 => 30,  40 => 12,  38 => 11,  29 => 5,  23 => 1,);
    }

    public function getSource()
    {
        return "<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>{% block title %}{% endblock %}</title>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link rel=\"stylesheet\" href=\"/styles.css\" />
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>

    {% block head %}{% endblock %}
</head>
<body>
    <div id=\"header\">
        <div id=\"logo\">
            <img src=\"/images/ticket5.png\"  alt=\"Logo\">
            <h1>Reservation Service</h1>
        </div>            
        <div id=\"topMenu\">
            <ul>
                <li><a href=\"/help\" >HELP</a></li>
                <li><a href=\"/contact\" >CONTACT AS</a></li>
                <li><a href=\"/about\" >ABOUT AS</a></li>
            </ul>
        </div>
    </div>   
    <div id=\"centerContent\">

        <div id=\"content\">
            <div id=\"loginBlock\">{% block login %}{% endblock %}</div>    
        {% block content %}{% endblock %}
    </div>

</div>
<div id=\"footer\">                
    &copy; Copyright 2016 by <a href=\"/\">TORS</a>.                
</div>


<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-85707574-1', 'auto');
    ga('send', 'pageview');

</script>


</body>
<!-- valeriy
        <div id=\"footer\">                
            &copy; Copyright 2016 by <a href=\"/\">TORS</a>.                
        </div>
 
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85701035-1', 'auto');
  ga('send', 'pageview');

</script>

    </body>
-->
</html>
";
    }
}
