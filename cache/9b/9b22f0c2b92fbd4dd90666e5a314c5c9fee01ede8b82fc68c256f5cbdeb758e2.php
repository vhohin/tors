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
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link rel=\"stylesheet\" href=\"/styles.css\" />
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
        ";
        // line 9
        $this->displayBlock('head', $context, $blocks);
        // line 11
        echo "    </head>
    <body>
        <div id=\"header\">
            <div id=\"logo\">
                <img src=\"\"  alt=\"Logo\" height=\"42\">
                <h1>Ticket Online Reservation Service</h1>
            </div>
            <ul>
                <li>LOGIN</li>
                <li>REGISTER</li>
                <li>ABOUT</li>
            </ul>
        </div>   
        <div id=\"centerContent\">
             
            <div id=\"content\">";
        // line 26
        $this->displayBlock('content', $context, $blocks);
        echo "</div>
            
        </div>
        <div id=\"footer\">                
            &copy; Copyright 2016 by <a href=\"http://domain.invalid/\">you</a>.                
        </div>
    </body>
</html>
";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
    }

    // line 9
    public function block_head($context, array $blocks = array())
    {
        // line 10
        echo "        ";
    }

    // line 26
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "master.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  79 => 26,  75 => 10,  72 => 9,  67 => 4,  54 => 26,  37 => 11,  35 => 9,  27 => 4,  22 => 1,);
    }

    public function getSource()
    {
        return "<!DOCTYPE html>
<html>
    <head>
        <title>{% block title %}{% endblock %}</title>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link rel=\"stylesheet\" href=\"/styles.css\" />
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
        {% block head %}
        {% endblock %}
    </head>
    <body>
        <div id=\"header\">
            <div id=\"logo\">
                <img src=\"\"  alt=\"Logo\" height=\"42\">
                <h1>Ticket Online Reservation Service</h1>
            </div>
            <ul>
                <li>LOGIN</li>
                <li>REGISTER</li>
                <li>ABOUT</li>
            </ul>
        </div>   
        <div id=\"centerContent\">
             
            <div id=\"content\">{% block content %}{% endblock %}</div>
            
        </div>
        <div id=\"footer\">                
            &copy; Copyright 2016 by <a href=\"http://domain.invalid/\">you</a>.                
        </div>
    </body>
</html>
";
    }
}
