<?php

namespace Acme\DemoBundle\Form\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Spy\Timeline\Driver\ActionManagerInterface;

/**
 * AddActionFormHandler
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AddActionFormHandler
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ActionManagerInterface
     */
    protected $actionManager;

    /**
     * @param ObjectManager          $objectManager objectManager
     * @param ActionManagerInterface $actionManager actionManager
     */
    public function __construct(ObjectManager $objectManager, ActionManagerInterface $actionManager)
    {
        $this->objectManager = $objectManager;
        $this->actionManager = $actionManager;
    }

    /**
     * @param Form    $form    form
     * @param Request $request request
     */
    public function handle(Form $form, Request $request)
    {
        $form->bind($request);
        if (!$form->isValid()) {
            return;
        }

        $data    = $form->getData();

        $subject = $this->actionManager->findOrCreateComponent(
            $this->extractComponent($data->subject)
        );

        if ($data->complementObject) {
            $complement = $this->extractComponent($data->complementObject);
        } else {
            $complement = $data->complementText;
        }

        $action = $this->actionManager->create($subject, $data->verb, array(
            'complement' => $complement,
        ));

        $this->actionManager->updateAction($action);
    }

    /**
     * @param string $component component
     *
     * @return object
     */
    protected function extractComponent($component)
    {
        list ($model, $identifier) = explode(':', $component);

        switch ($model) {
            case 'User':
                $entity = $this->objectManager->getRepository('AcmeDemoBundle:User')
                    ->find($identifier);
                break;
            case 'Car':
                list($brand, $model) = $identifier = explode('-', $identifier);

                $entity = $this->objectManager
                    ->getRepository('AcmeDemoBundle:Car')
                    ->find(array(
                        'brand' => $brand,
                        'model' => $model,
                    ));
                break;
            default:
                throw new \LogicException('WTF');
                break;
        }

        if (!$entity) {
            throw new \LogicException(sprintf('It seems "%s" does not exists on database for "%s" model', $identifier, $model));
        }

        return $entity;
    }
}
