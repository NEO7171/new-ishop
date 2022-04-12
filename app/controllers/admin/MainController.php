<?php

namespace app\controllers\admin;
use wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        echo 'admin ' . __METHOD__ . ' и ' . __NAMESPACE__;
    }
}
