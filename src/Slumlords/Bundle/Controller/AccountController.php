<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Slumlords\Bundle\Entity\Log;
use Slumlords\Bundle\Entity\Bank;
use Slumlords\Bundle\Entity\Offer;
use Slumlords\Bundle\Entity\User;
use Slumlords\Bundle\Entity\Property;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 

class AccountController extends Controller
{
    public function userAttendanceAction() 
    {
    
        return $this->render('SlumlordsBundle:Account:attendance.html.twig', array(
        )); 
    }
}
