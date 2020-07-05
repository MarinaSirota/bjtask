<?php

/**
 * Class View
 */
class View
{
    /**
     * @param $content_view
     * @param $title
     * @param null $model
     * @param string $layout
     */
    function render($content_view, $title, $model = NULL, $layout = 'layout.php')
    {
        if ($content_view == 'signIn') {
            include 'app/views/' . $layout;
        } else {
            if ($this->isAdminView)
                include 'app/admin/views/' . $layout;
            else
                include 'app/views/' . $layout;
        }
    }
}
