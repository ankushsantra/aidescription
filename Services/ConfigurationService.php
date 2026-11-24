<?php
/**
 * Copyright
 *
 * @category Ankush
 * @package  Ankush_Aidescription
 */

//declare(strict_types=1);

namespace Ankush\Aidescription\Services;

use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigurationService
{
    /**
     * Configuration xml path
     *
     * @const string
     */
    const XML_PATH_IS_ACTIVE = 'ai_description/aidescription/active';

    /**
     * @const string
     */
    const XML_PATH_API_URL = 'ai_description/aidescription/api_url';

    /**
     * @const string
     */
    const XML_PATH_API_KEY = 'ai_description/aidescription/api_key';

    /**
     * @const string
     */
    const XML_PATH_API_MODEL = 'ai_description/aidescription/api_model';

    /**
     * @const string
     */
    const XML_PATH_AGENT_PRODUCT_DESCRIPTION = 'ai_description/aiagents/product_description';

    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * constructor.
     *
     * @param EncryptorInterface $encryptor
     * @param ScopeConfigInterface $scopeConfig
    */

    public function __construct(
        EncryptorInterface $encryptor,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->encryptor = $encryptor;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check AI is active
     *
     * @param int|null $websiteId
     * @return bool
     */
    public function isActive(?int $websiteId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_IS_ACTIVE,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }

    /**
     * Get AI API URL
     *
     * @return string
     */
    public function getApiUrl($websiteId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_API_URL,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }

    /**
     * Get AI API KEY
     *
     * @return string
     */
    public function getApiKey($websiteId = null): string
    {
        return $this->encryptor->decrypt(
            $this->scopeConfig->getValue(
                self::XML_PATH_API_KEY,
                ScopeInterface::SCOPE_WEBSITE,
                $websiteId
            )
        );
    }

    /**
     * Get AI API MODEL
     *
     * @return string
     */
    public function getApiModel($websiteId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_API_MODEL,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }

    /**
     * Get AI AGENT PRODUCT DESCRIPTION
     *
     * @return string
     */
    public function getAgentProductDescription($websiteId = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_AGENT_PRODUCT_DESCRIPTION,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }
}
