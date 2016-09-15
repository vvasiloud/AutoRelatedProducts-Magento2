<?php namespace Vvasiloud\AutoRelatedProducts\Model\Config\Source;
/**
 * @category   Vvasiloud
 * @package    Vvasiloud_AutoRelatedProducts
 * @author     Vasilis Vasiloudis <vvasiloudis@gmail.com>
 * @website    https://vvasiloud.github.io/
 * @license    http://www.gnu.org/licenses  GNU General Public License
 */
class ProductCount implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 1,
                'label' => __('1'),
            ],
            [
                'value' => 2,
                'label' => __('2'),
            ],
            [
                'value' => 3,
                'label' => __('3'),
            ],
            [
                'value' => 4,
                'label' => __('4'),
            ],
            [
                'value' => 5,
                'label' => __('5'),
            ],			
        ];
    }
}