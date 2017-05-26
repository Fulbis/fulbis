<?php

namespace SignUp\Action;

use App\Action;
use App\Service\EntityPersister;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Xtreamwayz\HTMLFormValidator\FormFactory;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use Zend\Expressive\Router;


class SignUpAction extends Action
{

    private $template;
    private $router;
    private $entityPersister;

    public function __construct(Template\TemplateRendererInterface $template, Router\RouterInterface $router, EntityPersister $entityPersister)
    {
        $this->template = $template;
        $this->router = $router;
        $this->entityPersister = $entityPersister;
    }

    public function index(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new HtmlResponse($this->template->render('signup::index'));
    }

    public function indexPost(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $form = FormFactory::fromHtml($this->template->render('signup::index'));

        $validationResult = $form->validateRequest($request);

        if ($validationResult->isValid()) {

            $data = $validationResult->getValues();

            $data['password'] = password_hash($data['password'],PASSWORD_BCRYPT);

            try {
                $this->entityPersister->create(\App\Entity\User::class, $data);
            } catch (UniqueConstraintViolationException $e) {
                return new HtmlResponse($this->template->render('signup::index', ['form' => $form->asString($validationResult), 'error' => 'Ya existe un usuario con ese email.']));
            }

            return new RedirectResponse($this->router->generateUri('login'));
        }

        return new HtmlResponse($this->template->render('signup::index', ['form' => $form->asString($validationResult), 'errors' => $validationResult->getMessages()]));
    }
}
