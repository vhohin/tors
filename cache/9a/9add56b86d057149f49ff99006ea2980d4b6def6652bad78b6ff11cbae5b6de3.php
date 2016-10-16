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

    // line 5
    public function block_login($context, array $blocks = array())
    {
        // line 6
        if ((isset($context["currentUser"]) ? $context["currentUser"] : null)) {
            // line 7
            echo "        <p class=\"pLongRight\">Welcome, ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["currentUser"]) ? $context["currentUser"] : null), "email", array()), "html", null, true);
            echo ". <a href=\"index.php/profile/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["currentUser"]) ? $context["currentUser"] : null), "ID", array()), "html", null, true);
            echo "\">EDIT PROFILE </a>  | <a href=\"index.php/logout\"> LOGOUT</a></p>
        ";
            // line 8
            if ((isset($context["startCart"]) ? $context["startCart"] : null)) {
                // line 9
                echo "        <p class=\"pLongRight\"><a href=\"index.php/cartview\">CART VIEW</a></p>    
        ";
            }
        } elseif (        // line 11
(isset($context["fbUser"]) ? $context["fbUser"] : null)) {
            // line 12
            echo "         <p class=\"pLongRight\">Welcome, ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["fbUser"]) ? $context["fbUser"] : null), "email", array()), "html", null, true);
            echo ". <a href=\"fblogout.php\"> LOGOUT</a></p>
";
        } else {
            // line 14
            echo "        <p class=\"pLongRight\"><a href=\"index.php/login\">LOGIN </a> | <a href=\"index.php/register\"> REGISTER</a></p>       
";
        }
        // line 16
        echo "    <hr/>
";
    }

    // line 18
    public function block_content($context, array $blocks = array())
    {
        // line 19
        echo "<div id=\"indexForm\">    
    ";
        // line 20
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 21
            echo "    <div id=\"errorList\">    
\t<ul>
            ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 24
                echo "\t\t<li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "\t</ul>
    </div>
    ";
        }
        // line 29
        echo "    <div id=\"selectForm\">
        <form method=\"post\"  action=\"/index.php/select\">            
            <p>Depart From: </p><select name=\"departID\" class=\"select_join\">
                <option>-- Select City From--</option>
                ";
        // line 33
        if ((isset($context["cityList"]) ? $context["cityList"] : null)) {
            // line 34
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["cityList"]) ? $context["cityList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["city"]) {
                echo "                    
                        ";
                // line 35
                if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "departID", array()) == $this->getAttribute($context["city"], "ID", array()))) {
                    // line 36
                    echo "                            <option value=";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo " selected>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                } else {
                    // line 37
                    echo " 
                            <option value=";
                    // line 38
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo ">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                }
                // line 40
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['city'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "                
                ";
        }
        // line 43
        echo "            </select>
            <p>Arrive To: </p><select name=\"arriveID\" class=\"select_join\" >
                <option>-- Select City To--</option>
                ";
        // line 46
        if ((isset($context["cityList"]) ? $context["cityList"] : null)) {
            // line 47
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["cityList"]) ? $context["cityList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["city"]) {
                // line 48
                echo "                        ";
                if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "arriveID", array()) == $this->getAttribute($context["city"], "ID", array()))) {
                    // line 49
                    echo "                            <option value=";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo " selected>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                } else {
                    // line 50
                    echo " 
                            <option value=";
                    // line 51
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo ">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                }
                // line 52
                echo "                    
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['city'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            echo " 
                ";
        }
        // line 54
        echo "                
            </select><br/>
            <p>Depart On: </p><input type=\"date\" name=\"dateTimeDepart\" class=\"select_join\" >
            <p>Arrive On: </p><input type=\"date\" name=\"dateTimeArrive\" class=\"select_join\" ><br/>
            <p>Trip: </p><select name=\"typeTrip\" class=\"select_join\" >
                <!--<option>-- Select Trip Type--</option>-->
                ";
        // line 60
        if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "typeTrip", array()) == "oneway")) {
            // line 61
            echo "                    <option value=\"oneway\" selected>One-way</option>
                ";
        } else {
            // line 62
            echo " 
                    <option value=\"oneway\">One-way</option>
                ";
        }
        // line 65
        echo "                ";
        if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "typeTrip", array()) == "round")) {
            // line 66
            echo "                    <option value=\"round\" selected>Round trip</option>
                ";
        } else {
            // line 67
            echo " 
                    <option value=\"round\">Round trip</option>
                ";
        }
        // line 70
        echo "                                                
            </select>
            <input type=\"submit\" Value=\"CONTINUE\" class=\"submitButton\">
            <!--<button id=\"selectContinue\">CONTINUE</button>-->
        </form>   
        <div id=\"indexAdvertising\">
            <img src=\"/images/advert1.jpg\" alt=\"Advertising 1\" style=\"float:left;\">
            <img src=\"/images/advert2.jpg\" alt=\"Advertising 2\">
            <img src=\"/images/advert3.jpg\" alt=\"Advertising 3\">
                    
        </div>        
                
    </div>
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
        return array (  221 => 70,  216 => 67,  212 => 66,  209 => 65,  204 => 62,  200 => 61,  198 => 60,  190 => 54,  186 => 53,  179 => 52,  172 => 51,  169 => 50,  161 => 49,  158 => 48,  153 => 47,  151 => 46,  146 => 43,  142 => 41,  136 => 40,  129 => 38,  126 => 37,  118 => 36,  116 => 35,  109 => 34,  107 => 33,  101 => 29,  96 => 26,  87 => 24,  83 => 23,  79 => 21,  77 => 20,  74 => 19,  71 => 18,  66 => 16,  62 => 14,  56 => 12,  54 => 11,  50 => 9,  48 => 8,  41 => 7,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}TORS{% endblock %}

{% block login %}
{% if currentUser %}
        <p class=\"pLongRight\">Welcome, {{currentUser.email}}. <a href=\"index.php/profile/{{currentUser.ID}}\">EDIT PROFILE </a>  | <a href=\"index.php/logout\"> LOGOUT</a></p>
        {% if startCart %}
        <p class=\"pLongRight\"><a href=\"index.php/cartview\">CART VIEW</a></p>    
        {% endif %}
{% elseif fbUser %}
         <p class=\"pLongRight\">Welcome, {{fbUser.email}}. <a href=\"fblogout.php\"> LOGOUT</a></p>
{% else %}
        <p class=\"pLongRight\"><a href=\"index.php/login\">LOGIN </a> | <a href=\"index.php/register\"> REGISTER</a></p>       
{% endif %}
    <hr/>
{% endblock %}        
{% block content %}
<div id=\"indexForm\">    
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
            <p>Depart From: </p><select name=\"departID\" class=\"select_join\">
                <option>-- Select City From--</option>
                {% if cityList %}
                    {% for city in cityList %}                    
                        {% if v.departID==city.ID %}
                            <option value={{city.ID}} selected>{{city.name}}</option>
                        {% else %} 
                            <option value={{city.ID}}>{{city.name}}</option>
                        {% endif %}
                    {% endfor %}
                
                {% endif %}
            </select>
            <p>Arrive To: </p><select name=\"arriveID\" class=\"select_join\" >
                <option>-- Select City To--</option>
                {% if cityList %}
                    {% for city in cityList %}
                        {% if v.arriveID==city.ID %}
                            <option value={{city.ID}} selected>{{city.name}}</option>
                        {% else %} 
                            <option value={{city.ID}}>{{city.name}}</option>
                        {% endif %}                    
                    {% endfor %} 
                {% endif %}                
            </select><br/>
            <p>Depart On: </p><input type=\"date\" name=\"dateTimeDepart\" class=\"select_join\" >
            <p>Arrive On: </p><input type=\"date\" name=\"dateTimeArrive\" class=\"select_join\" ><br/>
            <p>Trip: </p><select name=\"typeTrip\" class=\"select_join\" >
                <!--<option>-- Select Trip Type--</option>-->
                {% if v.typeTrip==\"oneway\" %}
                    <option value=\"oneway\" selected>One-way</option>
                {% else %} 
                    <option value=\"oneway\">One-way</option>
                {% endif %}
                {% if v.typeTrip==\"round\" %}
                    <option value=\"round\" selected>Round trip</option>
                {% else %} 
                    <option value=\"round\">Round trip</option>
                {% endif %}
                                                
            </select>
            <input type=\"submit\" Value=\"CONTINUE\" class=\"submitButton\">
            <!--<button id=\"selectContinue\">CONTINUE</button>-->
        </form>   
        <div id=\"indexAdvertising\">
            <img src=\"/images/advert1.jpg\" alt=\"Advertising 1\" style=\"float:left;\">
            <img src=\"/images/advert2.jpg\" alt=\"Advertising 2\">
            <img src=\"/images/advert3.jpg\" alt=\"Advertising 3\">
                    
        </div>        
                
    </div>
</div>    
{% endblock %}
";
    }
}
