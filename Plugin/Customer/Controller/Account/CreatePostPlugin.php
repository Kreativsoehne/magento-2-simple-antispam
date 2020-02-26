<?php

namespace KuS\Antispam\Plugin\Customer\Controller\Account;

class CreatePostPlugin
{

    public function aroundExecute(\Magento\Customer\Controller\Account\CreatePost $subject, callable $proceed)
    {
        $data = \Magento\Framework\App\ObjectManager::getInstance()
                ->get('Magento\Framework\App\RequestInterface')
                ->getPost();

        $spamContent = array(
            "http://",
            "https://",
            "www.",
            ".com",
            ".de",
            ".ru",
            ".cn",
            ".net"
        );

        $formFieldsToCheck = array(
            'firstname',
            'lastname'
        );

        $spam = false;

        foreach ($spamContent as $entry) {
            foreach ($formFieldsToCheck as $field) {
                if (strpos($data[$field], $entry) !== false) {
                    $spam = true;				
                }
            }
        }

        if (!$spam) {
            return $proceed();
        }

    }

}
