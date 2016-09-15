<?php
/**
 * @category   Vvasiloud
 * @package    Vvasiloud_AutoRelatedProducts
 * @author     Vasilis Vasiloudis <vvasiloudis@gmail.com>
 * @website    https://vvasiloud.github.io/
 * @license    http://www.gnu.org/licenses  GNU General Public License
 */
namespace Vvasiloud\AutoRelatedProducts\Helper;

use Magento\Framework\Module\ModuleListInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	const XML_PATH_ENABLED    		 			= 'general/enabled';
	const XML_PATH_PRODUCTCOUNT    		 		= 'general/productcount';
	
	/**
     * @var ModuleListInterface
     */
    protected $_moduleList;
	
	/**
     * @param \Magento\Framework\App\Helper\Context $context
	 * @param ModuleListInterface $moduleList
     */
	public function __construct(\Magento\Framework\App\Helper\Context $context, ModuleListInterface $moduleList
	) {
		$this->_moduleList              = $moduleList;
		parent::__construct($context);
	}

    /**
     * @param $xmlPath
     * @param string $section
     *
     * @return string
     */
    public function getConfigPath(
        $xmlPath,
        $section = 'vvasiloud_autorelatedproducts'
    ) {
        return $section . '/' . $xmlPath;
    }
	
	 /**
     * Check if enabled
     *
     * @return string|null
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            $this->getConfigPath(self::XML_PATH_ENABLED),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
	
	 /**
     * Show Extensions Version
     *
     * @return string|null
     */	
    public function getExtensionVersion()
    {
        $moduleCode = 'Vvasiloud_AutoRelatedProducts';
        $moduleInfo = $this->_moduleList->getOne($moduleCode);
        return $moduleInfo['setup_version'];
    }	
	
	 /**
     * Get product count
     *
     * @return string|null
     */
    public function getProductCount()
    {
        return $this->scopeConfig->getValue(
            $this->getConfigPath(self::XML_PATH_PRODUCTCOUNT),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }	
	
}