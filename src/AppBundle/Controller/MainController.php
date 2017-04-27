<?php

namespace AppBundle\Controller;

use AppBundle\Captcha\Captcha;
use AppBundle\Form\ActionForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\PDOConnection\PDOConnection;



class MainController extends Controller
{

    /**
     * @Route("/start", name="start")
     */
    public function indexAction(Request $request)
    {
        $ActionForm = $this->createForm(ActionForm::class);
        $ActionForm->handleRequest($request);
        $captcha = new Captcha();

        $pdo = new PDOConnection();
        $pdo = $pdo->getPDO();

        # check if form is submitted and Recaptcha response is success
        if($ActionForm->isSubmitted() && $ActionForm->isValid() &&
            $captcha->captchaVerify($request->get('g-recaptcha-response'))){

            $links = $ActionForm->getData();
            $new = $links['new'];
            $old = $links['old'];
            $date = date("Y-m-d");

            if(substr($old, 0,6) == 'https:'){
                $old = substr($old,8);
            }elseif(substr($old, 0,5) == 'http:'){
                $old = substr($old,7);
            }else{}


            $defaultFormField = 'This field may be blank, if so you will get random URL';
            if($new == $defaultFormField || $new == '' ){

                $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                $randomString = '';

                    for($i=0; $i<=5; $i++){
                        $x = rand(0,35);
                        $randomString .= $characters[$x];
                    }

                    $new = $randomString;
            }

            $result = $pdo->query("SELECT * FROM links WHERE new='".$new."'");
            $alredyExist= $result->fetch();

            if($alredyExist !== false){
                $this->addFlash(
                    'message',
                    'Link name alredy exists!'
                );
            }else{
                $newRecord = "INSERT INTO `links` (`old`, `new`, `createDate`) 
                VALUES ('$old', '$new', '$date')";
    
                $pdo->exec($newRecord);

            }

            return $this->redirectToRoute('final', [
                'old' => $old,
                'new' => $new,
            ]);
        }

        if($ActionForm->isSubmitted() && $ActionForm->isValid()
            && !$captcha->captchaverify($request->get('g-recaptcha-response'))){

            $this->addFlash(
                'message',
                'Captcha Require!'
            );
        }

        return $this->render('/main.html.twig', [
            'ActionForm' => $ActionForm->createView(),

        ]);
    }

    /**
     * @Route("/final", name="final")
     */
    public function finalLinkAction(Request $request)
    {
        $old = $request->get('old');
        $new = $request->get('new');

        return $this->render('/final.html.twig', [
            'old' => $old,
            'new' => $new,
        ]);
    }

    /**
     * @Route("/{new}", name="new-link")
     */
    public function newLinkAction($new)
    {
        $pdo = new PDOConnection();
        $pdo = $pdo->getPDO();

        $result = $pdo->query("SELECT old FROM links WHERE new='".$new."'");
        $old = $result->fetch();

        return $this->redirect('http://'.$old['old']);

    }



}
