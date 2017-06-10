<?php
echo "string";
namespace Sprayground\Nav\Block\Html;

class Topmenu extends \Magento\Theme\Block\Html\Topmenu
{
    protected function _addSubMenu($child, $childLevel, $childrenWrapClass, $limit)
    {
       echo "string2222";
    }

}

