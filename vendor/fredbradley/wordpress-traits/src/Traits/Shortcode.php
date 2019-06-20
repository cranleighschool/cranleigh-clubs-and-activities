<?php

namespace FredBradley\WordPressTraits\Traits;

abstract class Shortcode
{

    public function __construct(array $config = NULL)
    {
        $this->config = $config;
    }

    abstract public function render($atts, $content = NULL);

    public function init()
    {
        add_shortcode($this->tag, array($this, 'render'));
    }
}
