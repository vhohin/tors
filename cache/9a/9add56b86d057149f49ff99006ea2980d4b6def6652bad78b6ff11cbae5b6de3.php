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
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["currentUser"]) ? $context["currentUser"] : null), "userName", array()), "html", null, true);
            echo ". <a href=\"/logout\"> LOGOUT</a></p>
    ";
        } else {
            // line 8
            echo "        <p><a href=\"index.php/login\">LOGIN </a> | <a href=\"index.php/register\"> REGISTER</a></p>       
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
            <p>Depart From: </p><select name=\"departID\" class=\"select_join\">
                <option>-- Select City From--</option>
                ";
        // line 26
        if ((isset($context["cityList"]) ? $context["cityList"] : null)) {
            // line 27
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["cityList"]) ? $context["cityList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["city"]) {
                echo "                    
                        ";
                // line 28
                if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "departID", array()) == $this->getAttribute($context["city"], "ID", array()))) {
                    // line 29
                    echo "                            <option value=";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo " selected>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                } else {
                    // line 30
                    echo " 
                            <option value=";
                    // line 31
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo ">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                }
                // line 33
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['city'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "                
                ";
        }
        // line 36
        echo "            </select>
            <p>Arrive To: </p><select name=\"arriveID\" class=\"select_join\" >
                <option>-- Select City To--</option>
                ";
        // line 39
        if ((isset($context["cityList"]) ? $context["cityList"] : null)) {
            // line 40
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["cityList"]) ? $context["cityList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["city"]) {
                // line 41
                echo "                        ";
                if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "arriveID", array()) == $this->getAttribute($context["city"], "ID", array()))) {
                    // line 42
                    echo "                            <option value=";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo " selected>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                } else {
                    // line 43
                    echo " 
                            <option value=";
                    // line 44
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "ID", array()), "html", null, true);
                    echo ">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
                    echo "</option>
                        ";
                }
                // line 45
                echo "                    
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['city'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo " 
                ";
        }
        // line 47
        echo "                
            </select><br/>
            <p>Depart On: </p><input type=\"date\" name=\"dateTimeDepart\" class=\"select_join\" >
            <p>Arrive On: </p><input type=\"date\" name=\"dateTimeArrive\" class=\"select_join\" ><br/>
            <p>Trip: </p><select name=\"typeTrip\" class=\"select_join\" >
                <!--<option>-- Select Trip Type--</option>-->
                ";
        // line 53
        if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "typeTrip", array()) == "oneway")) {
            // line 54
            echo "                    <option value=\"oneway\" selected>One-way</option>
                ";
        } else {
            // line 55
            echo " 
                    <option value=\"oneway\">One-way</option>
                ";
        }
        // line 58
        echo "                ";
        if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "typeTrip", array()) == "round")) {
            // line 59
            echo "                    <option value=\"round\" selected>Round trip</option>
                ";
        } else {
            // line 60
            echo " 
                    <option value=\"round\">Round trip</option>
                ";
        }
        // line 63
        echo "                                                
            </select>
            <input type=\"submit\" Value=\"CONTINUE\" class=\"submitButton\">
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
        return array (  205 => 63,  200 => 60,  196 => 59,  193 => 58,  188 => 55,  184 => 54,  182 => 53,  174 => 47,  170 => 46,  163 => 45,  156 => 44,  153 => 43,  145 => 42,  142 => 41,  137 => 40,  135 => 39,  130 => 36,  126 => 34,  120 => 33,  113 => 31,  110 => 30,  102 => 29,  100 => 28,  93 => 27,  91 => 26,  85 => 22,  80 => 19,  71 => 17,  67 => 16,  63 => 14,  61 => 13,  56 => 12,  51 => 10,  47 => 8,  41 => 6,  39 => 5,  36 => 4,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}TORS{% endblock %}
{% block login %}
{% if currentUser %}
        <p>Logined: {{currentUser.userName}}. <a href=\"/logout\"> LOGOUT</a></p>
    {% else %}
        <p><a href=\"index.php/login\">LOGIN </a> | <a href=\"index.php/register\"> REGISTER</a></p>       
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
    </div>
    
{% endblock %}
";
    }
}
