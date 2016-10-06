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
            echo "        <p>Logined: ";
            echo twig_escape_filter($this->env, (isset($context["currentUser"]) ? $context["currentUser"] : null), "html", null, true);
            echo ". <a href=\"/logout\"> LOGOUT</a></p>
    ";
        } else {
            // line 8
            echo "        <p><a href=\"/login\">LOGIN </a> | <a href=\"/register\"> REGISTER</a></p>       
    ";
        }
        // line 10
        echo "    <hr/>
";
    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        echo " 
    ";
        // line 13
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 14
            echo "    <div id=\"errorList\">    
\t<ul>
            ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 17
                echo "\t\t<li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "\t</ul>
    </div>
    ";
        }
        // line 22
        echo "    <div id=\"selectForm\">
        <form method=\"post\"  action=\"/index.php/select\">            
            <p>Depart From: </p><input type=\"text\" name=\"depart\" placeholder=\"Place of departure\">
            <p>Depart To: </p><input type=\"text\" name=\"arrive\" placeholder=\"Place of arrival\"><br/>
            <p>Depart On: </p><input type=\"date\" name=\"dateTimeDepart\">
            <p>Arrive On: </p><input type=\"date\" name=\"dateTimeArrive\"><br/>
            <p>Trip: </p><select name=\"typeTrip\">
                <option value=\"round\">Round trip</option>
                <option value=\"oneway\">One-way</option>                
            </select>
            <input type=\"submit\" Value=\"CONTINUE\">
            <!--<button id=\"selectContinue\">CONTINUE</button>-->
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
        return array (  85 => 22,  80 => 19,  71 => 17,  67 => 16,  63 => 14,  61 => 13,  56 => 12,  51 => 10,  47 => 8,  41 => 6,  39 => 5,  36 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}TORS{% endblock %}
{% block login %}
{% if currentUser %}
        <p>Logined: {{currentUser}}. <a href=\"/logout\"> LOGOUT</a></p>
    {% else %}
        <p><a href=\"/login\">LOGIN </a> | <a href=\"/register\"> REGISTER</a></p>       
    {% endif %}
    <hr/>
{% endblock %}        
{% block content %} 
    {% if errorList %}
    <div id=\"errorList\">    
\t<ul>
            {% for error in errorList %}
\t\t<li>{{ error }}</li>
            {% endfor %}
\t</ul>
    </div>
    {% endif %}
    <div id=\"selectForm\">
        <form method=\"post\"  action=\"/index.php/select\">            
            <p>Depart From: </p><input type=\"text\" name=\"depart\" placeholder=\"Place of departure\">
            <p>Depart To: </p><input type=\"text\" name=\"arrive\" placeholder=\"Place of arrival\"><br/>
            <p>Depart On: </p><input type=\"date\" name=\"dateTimeDepart\">
            <p>Arrive On: </p><input type=\"date\" name=\"dateTimeArrive\"><br/>
            <p>Trip: </p><select name=\"typeTrip\">
                <option value=\"round\">Round trip</option>
                <option value=\"oneway\">One-way</option>                
            </select>
            <input type=\"submit\" Value=\"CONTINUE\">
            <!--<button id=\"selectContinue\">CONTINUE</button>-->
        </form>    
    </div>
    
{% endblock %}
";
    }
}
