<?php
/**
 *  @author Rafael Corrêa Gomes <rafaelcgstz@gmail.com>
 *  @copyright Copyright (c) 2019.
 */

namespace Rafaelcg\Quicklink\Block;

use Magento\Framework\View\Element\Template;
use Rafaelcg\Quicklink\Helper\Data;

/**
 * Class Quicklink
 *
 * @package Rafaelcg\Quicklink\Block
 */
class Quicklink extends Template
{

    /**
     * @var Template\Context
     */
    private $context;
    /**
     * @var array
     */
    private $data;
    /**
     * @var Data
     */
    private $helper;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->context = $context;
        $this->data = $data;
        $this->helper = $helper;
    }

    /**
     * Initialize the configurations
     *
     * @return string
     */
    public function initConfig()
    {
        $initConfig = [];
        $timeout = $this->helper->getTimeout();
        $requestLimit = $this->helper->getRequestLimit();
        $concurrencyLimit = $this->helper->getConcurrencyLimit();
        $priority = $this->helper->getPriority();

        if ($timeout) {
            $initConfig['timeout'] = $timeout;
        }
        if ($requestLimit) {
            $initConfig['limit'] = $requestLimit;
        }
        if ($concurrencyLimit) {
            $initConfig['throttle'] = $concurrencyLimit;
        }
        if ($timeout) {
            $initConfig['timeout'] = $timeout;
        }
        if ($priority) {
            $initConfig['priority'] = $priority;
        }
        return json_encode(
            $initConfig
        );
    }

    /**
     * Render GA tracking scripts
     *
     * @return string
     */
    protected function _toHtml()
    {
        return !$this->helper->isQuicklinkEnabled() ? '' : parent::_toHtml();
    }
}
