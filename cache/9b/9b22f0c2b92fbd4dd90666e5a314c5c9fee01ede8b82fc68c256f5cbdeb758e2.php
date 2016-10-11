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
        // line 10
        $this->displayBlock('head', $context, $blocks);
        // line 11
        echo "    </head>
    <body>
        <div id=\"header\">
            <div id=\"logo\">
                <img src=\"/images/ticket5.png\"  alt=\"Logo\">
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
        // line 29
        $this->displayBlock('login', $context, $blocks);
        echo "</div>    
";
        // line 30
        $this->displayBlock('content', $context, $blocks);
        // line 31
        echo " </div>
            
        </div>
        <div id=\"footer\">                
            &copy; Copyright 2016 by <a href=\"/\">TORS</a>.                
        </div>
    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
    }

    // line 10
    public function block_head($context, array $blocks = array())
    {
    }

    // line 29
    public function block_login($context, array $blocks = array())
    {
    }

    // line 30
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "master.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  92 => 30,  87 => 29,  82 => 10,  77 => 5,  65 => 31,  63 => 30,  59 => 29,  39 => 11,  37 => 10,  29 => 5,  23 => 1,);
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
            &copy; Copyright 2016 by <a href=\"/\">TORS</a>.                
        </div>
    </body>
</html>
";
    }
}
