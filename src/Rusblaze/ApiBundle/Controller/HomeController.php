<?php
namespace Rusblaze\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Rest\View
     */
    public function helloAction()
    {
        return ['hello' => 'world!'];
    }
}