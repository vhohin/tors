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
        // line 10
        echo "    </head>
    <body>
        <div id=\"header\">
            <div id=\"logo\">
                <img src=\"images/ticket5.png\"  alt=\"Logo\">
                <h1>Reservation Service</h1>
            </div>            
            <div id=\"topMenu\">
                <ul>
                    <li><a href=\"\" >HELP</a></li>
                    <li><a href=\"\" >CONTACT AS</a></li>
                    <li><a href=\"\" >ABOUT AS</a></li>
                </ul>
            </div>
        </div>   
        <div id=\"centerContent\">
             
<div id=\"content\">
    <div id=\"loginBlock\">";
        // line 28
        $this->displayBlock('login', $context, $blocks);
        echo "</div>    
";
        // line 29
        $this->displayBlock('content', $context, $blocks);
        // line 30
        echo " </div>
            
        </div>
        <div id=\"footer\">                
            &copy; Copyright 2016 by <a href=\"http://tors.ipd8.info/\">TORS</a>.                
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
    }

    // line 28
    public function block_login($context, array $blocks = array())
    {
    }

    // line 29
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "master.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  91 => 29,  86 => 28,  81 => 9,  76 => 4,  64 => 30,  62 => 29,  58 => 28,  38 => 10,  36 => 9,  28 => 4,  23 => 1,);
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
{% block head %}{% endblock %}
    </head>
    <body>
        <div id=\"header\">
            <div id=\"logo\">
                <img src=\"images/ticket5.png\"  alt=\"Logo\">
                <h1>Reservation Service</h1>
            </div>            
            <div id=\"topMenu\">
                <ul>
                    <li><a href=\"\" >HELP</a></li>
                    <li><a href=\"\" >CONTACT AS</a></li>
                    <li><a href=\"\" >ABOUT AS</a></li>
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
            &copy; Copyright 2016 by <a href=\"http://tors.ipd8.info/\">TORS</a>.                
        </div>
    </body>
</html>
";
    }
}
