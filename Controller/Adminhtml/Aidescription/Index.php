<?php
/**
 * Copyright © 2026 Ankush.
 */
namespace Ankush\Aidescription\Controller\Adminhtml\Aidescription;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Email\Model\Template\Filter;
use Ankush\Aidescription\Services\ConfigurationService;
use Ankush\Aidescription\Model\ResourceModel\Agent\CollectionFactory;
use Psr\Log\LoggerInterface;

class Index extends Action
{
        /**
     * @const string
     */
    const LOG = "ai_description.log";

    protected $resultFactory;
    protected $request;
    private $productRepository;
    private $configurationService;
    private $curl;
    private $logger;
    private $collectionFactory;
    private $templateFilter;

    /**
     * Constructor
     *
     * @param Context $context
     */
    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        RequestInterface $request,
        ProductRepositoryInterface $productRepository,
        ConfigurationService $configurationService,
        Curl $curl,
        CollectionFactory $collectionFactory,
        Filter $templateFilter,
        LoggerInterface $logger

    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->configurationService = $configurationService;
        $this->curl = $curl;
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->templateFilter = $templateFilter;
        parent::__construct($context);
    }

    
    public function execute()
    {
        if (!$this->isActive()) {
            return;
        }

        $productId = $this->request->getParam('product_id');
        $product = $this->productRepository->getById($productId);

        $aiApiUrl = $this->configurationService->getApiUrl();
        $aiApiKey = $this->configurationService->getApiKey();
        $aiApiModel = $this->configurationService->getApiModel();
        $aiAgentId = $this->configurationService->getAgentProductDescription();

        $agentCollection = $this->collectionFactory->create();
        $aiAgentProductDescription = $agentCollection->getItemById($aiAgentId)->getAgentDetails();


        $filter = $this->templateFilter;
        $filter->setVariables([
            'data' => [
                'product_name' => $product->getName(),
                'product_description' => $product->getDescription()
            ]
        ]);
        $prompt = $filter->filter($aiAgentProductDescription);

        $this->logger->info(
            sprintf( "Request Start: "),
            [
                $prompt
            ]
        );
        ////////////////
        // AI API call 
        ////////////////
        try {
            $payload = [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'model' => $aiApiModel
            ];

            $this->curl->addHeader('Authorization', 'Bearer ' . $aiApiKey);
            $this->curl->addHeader('Content-Type', 'application/json');
            $this->curl->setTimeout(60);
            $this->curl->post(
                $aiApiUrl,
                json_encode($payload)
            );
            $response = json_decode($this->curl->getBody(), true);

            if (isset($response['error'])) {
                throw new \Exception($response['error']['message']);
            }

            $returnDescription = trim(
                $response['choices'][0]['message']['content'] ?? ''
            );
        } catch (\Exception $e) {
            $responseMessage = 'Error: ' . $e->getMessage();
        }
        ////////////////
        // AI API call 
        ////////////////
        $this->logger->info(
            sprintf("Response Data: "),
            [
                $returnDescription
            ]
        );

        $responseData = [
            'success' => true,
            'message' => $returnDescription,
        ];

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $resultJson->setData($responseData);
        
    }

    public function isActive(?int $websiteId = null): bool
    {
        return $this->configurationService->isActive($websiteId);
    }

}
