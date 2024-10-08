<?php


namespace Ced\CsMarketplace\Controller\Account;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Customer\CredentialsValidator;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\InputException;

/**
 * Class ResetPasswordPost
 * @package Ced\CsMarketplace\Controller\Account
 */
class ResetPasswordPost extends \Magento\Customer\Controller\AbstractAccount
{
    /**
     * @var \Magento\Customer\Api\AccountManagementInterface
     */
    protected $accountManagement;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var CredentialsValidator
     */
    private $credentialsValidator;

    /**
     * ResetPasswordPost constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param AccountManagementInterface $accountManagement
     * @param CustomerRepositoryInterface $customerRepository
     * @param CredentialsValidator|null $credentialsValidator
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        AccountManagementInterface $accountManagement,
        CustomerRepositoryInterface $customerRepository,
        CredentialsValidator $credentialsValidator = null
    ) {
        $this->session = $customerSession;
        $this->accountManagement = $accountManagement;
        $this->customerRepository = $customerRepository;
        $this->credentialsValidator = $credentialsValidator ?: ObjectManager::getInstance()
            ->get(CredentialsValidator::class);
        parent::__construct($context);
    }

    /**
     * Reset forgotten password
     *
     * Used to handle data received from reset forgotten password form
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $resetPasswordToken = (string)$this->getRequest()->getQuery('token');
        $customerId = (int)$this->getRequest()->getQuery('id');
        $password = (string)$this->getRequest()->getPost('password');
        $passwordConfirmation = (string)$this->getRequest()->getPost('password_confirmation');

        if ($password !== $passwordConfirmation) {
            $this->messageManager->addErrorMessage(__("New Password and Confirm New Password values didn't match."));
            $resultRedirect->setPath('*/*/createPassword', ['id' => $customerId, 'token' => $resetPasswordToken]);
            return $resultRedirect;
        }
        if (iconv_strlen($password) <= 0) {
            $this->messageManager->addErrorMessage(__('Please enter a new password.'));
            $resultRedirect->setPath('*/*/createPassword', ['id' => $customerId, 'token' => $resetPasswordToken]);
            return $resultRedirect;
        }

        try {
            $customerEmail = $this->customerRepository->getById($customerId)->getEmail();
            $this->credentialsValidator->checkPasswordDifferentFromEmail($customerEmail, $password);
            $this->accountManagement->resetPassword($customerEmail, $resetPasswordToken, $password);
            $this->session->unsRpToken();
            $this->session->unsRpCustomerId();
            $this->messageManager->addSuccessMessage(__('You updated your password.'));
            $resultRedirect->setPath('*/*/login');
            return $resultRedirect;
        } catch (InputException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            foreach ($e->getErrors() as $error) {
                $this->messageManager->addErrorMessage($error->getMessage());
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while saving the new password.'));
        }
        $resultRedirect->setPath('*/*/createPassword', ['id' => $customerId, 'token' => $resetPasswordToken]);
        return $resultRedirect;
    }
}
