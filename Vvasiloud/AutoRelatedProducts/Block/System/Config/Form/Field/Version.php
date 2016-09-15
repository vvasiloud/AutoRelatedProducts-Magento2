<?php
namespace Vvasiloud\AutoRelatedProducts\Block\System\Config\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Version renderer with link
 *
 * @category   Vvasiloud
 * @package    Vvasiloud_AutoRelatedProducts
 * @author     Vasilis Vasiloudis <vvasiloudis@gmail.com>
 * @website    https://vvasiloud.github.io/
 */
class Version extends \Magento\Config\Block\System\Config\Form\Field
{
    const EXTENSION_URL = 'https://vvasiloud.github.io/';

    /**
     * @var \Vvasiloud\AutoRelatedProducts\Helper\Data $helper
     */
    protected $_helper;

    /**
     * @param   \Magento\Backend\Block\Template\Context $context
     * @param   \Vvasiloud\AutoRelatedProducts\Helper\Data   $helper
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Vvasiloud\AutoRelatedProducts\Helper\Data $helper
    ) {
        $this->_helper = $helper;
        parent::__construct($context);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $extensionVersion = $this->_helper->getExtensionVersion();
        $extensionTitle   = 'Auto Related Products';
        $versionLabel     = sprintf(
            '<a href="%s" title="%s" target="_blank">%s</a>',
            self::EXTENSION_URL,
            $extensionTitle,
            $extensionVersion
        );
        $element->setValue($versionLabel);

        return $element->getValue();
    }
}