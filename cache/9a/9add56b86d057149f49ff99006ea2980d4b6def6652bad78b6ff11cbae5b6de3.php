<?php

/* index.html.twig */
class __TwigTemplate_5c79871831b4bc6a1e9bc6c5322359ff5e16ce03d442e08fa0a1a8c48d55e855 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'login' => array($this, 'block_login'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "TORS";
    }

    // line 4
    public function block_login($context, array $blocks = array())
    {
        // line 5
        if ((isset($context["currentUser"]) ? $context["currentUser"] : null)) {
            // line 6
            echo "        <p>Hello ";
            echo twig_escape_filter($this->env, (isset($context["currentUser"]) ? $context["currentUser"] : null), "html", null, true);
            echo ". <a href=\"/logout\"> LOGOUT</a></p>
    ";
        } else {
            // line 8
            echo "        <p><a href=\"/login\">LOGIN </a> | <a href=\"/register\"> REGISTER</a></p>       
    ";
        }
    }

    // line 11
    public function block_content($context, array $blocks = array())
    {
        echo "    
    <div id=\"selectForm\">
        <form method=\"post\">
            <p>Trip: </p><select name=\"typeTrip\">
                <option value=\"volvo\">Round trip</option>
                <option value=\"saab\">One-way</option>                
            </select>
            <p>From: </p><input type=\"text\" name=\"depart\"  placeholder=\"Place of departure\"></span>
            <p>To: </p><input type=\"text\" name=\"arrive\"  placeholder=\"Place of arrival\"><br/>
            <p>Depart on: </p><input type=\"date\" name=\"dateTimeDepart\" placeholder=\"Date of departure\">
            <p>Arrive on: </p><input type=\"date\" name=\"dateTimeArrive\" placeholder=\"Date of arrival\">
            <button id=\"selectContinue\">CONTINUE</button>
        </form>    
    </div>
    
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 11,  47 => 8,  41 => 6,  39 => 5,  36 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}TORS{% endblock %}
{% block login %}
{% if currentUser %}
        <p>Hello {{currentUser}}. <a href=\"/logout\"> LOGOUT</a></p>
    {% else %}
        <p><a href=\"/login\">LOGIN </a> | <a href=\"/register\"> REGISTER</a></p>       
    {% endif %}
{% endblock %}        
{% block content %}    
    <div id=\"selectForm\">
        <form method=\"post\">
            <p>Trip: </p><select name=\"typeTrip\">
                <option value=\"volvo\">Round trip</option>
                <option value=\"saab\">One-way</option>                
            </select>
            <p>From: </p><input type=\"text\" name=\"depart\"  placeholder=\"Place of departure\"></span>
            <p>To: </p><input type=\"text\" name=\"arrive\"  placeholder=\"Place of arrival\"><br/>
            <p>Depart on: </p><input type=\"date\" name=\"dateTimeDepart\" placeholder=\"Date of departure\">
            <p>Arrive on: </p><input type=\"date\" name=\"dateTimeArrive\" placeholder=\"Date of arrival\">
            <button id=\"selectContinue\">CONTINUE</button>
        </form>    
    </div>
    
{% endblock %}
";
    }
}
