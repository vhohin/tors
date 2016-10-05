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

    // line 5
    public function block_content($context, array $blocks = array())
    {
        echo "    
    
    ";
        // line 7
        if ((isset($context["currentUser"]) ? $context["currentUser"] : null)) {
            // line 8
            echo "        <p>Hello ";
            echo twig_escape_filter($this->env, (isset($context["currentUser"]) ? $context["currentUser"] : null), "html", null, true);
            echo ", you can <a href=\"/logout\">Logout</a></p>
    ";
        } else {
            // line 10
            echo "        <p>You are not logined. You can <a href=\"/login\">Login</a> or <a href=\"/register\">Register</a></p>       
    ";
        }
        // line 12
        echo "    
    
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
        return array (  53 => 12,  49 => 10,  43 => 8,  41 => 7,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}TORS{% endblock %}
        
{% block content %}    
    
    {% if currentUser %}
        <p>Hello {{currentUser}}, you can <a href=\"/logout\">Logout</a></p>
    {% else %}
        <p>You are not logined. You can <a href=\"/login\">Login</a> or <a href=\"/register\">Register</a></p>       
    {% endif %}
    
    
{% endblock %}
";
    }
}
