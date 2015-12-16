<?php namespace Alxy\Facebook\Components;

use Cms\Classes\ComponentBase;
use HTML;
use Alxy\Facebook\Models\Settings;
use Request;

class Comments extends ComponentBase
{

    public $appId;
    public $lang;
    public $attributes;

    public function componentDetails()
    {
        return [
            'name'        => 'Comments',
            'description' => 'Display a Facebook Comments Box.'
        ];
    }

    public function defineProperties()
    {
        return [
            'data-colorscheme' => [
                 'title'             => 'Color scheme',
                 'description'       => 'The color scheme used by the plugin.',
                 'default'           => 'light',
                 'type'              => 'dropdown',
                 'options'           => [
                    'light' => 'light',
                    'dark' => 'dark'
                 ]
            ],
            'data-kid-directed-site' => [
                 'title'             => 'Kid directed site',
                 'description'       => 'If your web site or online service, or a portion of your service, is directed to children under 13 you must enable this.',
                 'default'           => 0,
                 'type'              => 'checkbox'
            ],
            'data-numposts' => [
                 'title'             => 'Number of Posts',
                 'description'       => 'The number of comments to show by default. The minimum value is 1.',
                 'default'           => 5,
                 'type'              => 'string',
                 'validationPattern' => '^(\d+)?$',
                 'validationMessage' => 'The width must be an integer.'
            ], 
            'data-width' => [
                 'title'             => 'Width',
                 'description'       => 'The width of the plugin. Either a pixel'.
                    'value or the literal 100% for fluid width. The mobile '.
                    'version of the Comments plugin ignores the width parameter,'.
                    ' and instead has a fluid width of 100%.',
                 'default'           => '550',
                 'type'              => 'string',
                 'validationPattern' => '^(\d+(px|%)?)?$',
                 'validationMessage' => 'The width must be either pixel value or percentage.'
            ],
        ];
    }

    public function onRun()
    {
        $attributes = array_except($this->getProperties(), ['lang']);
        array_walk($attributes, function (&$value, $key) {
            switch ($value) {
                case '1':
                    $value = 'true';
                    break;

                case '0':
                    $value = 'false';
                    break;

                default:
                    $value = $value;
                    break;
            }
        });
        $this->attributes = HTML::attributes($attributes);
    }
}
