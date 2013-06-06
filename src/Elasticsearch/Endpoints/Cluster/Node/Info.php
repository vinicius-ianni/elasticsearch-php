<?php
/**
 * User: zach
 * Date: 05/31/2013
 * Time: 16:47:11 pm
 */

namespace Elasticsearch\Endpoints\Cluster\Node;

use Elasticsearch\Endpoints\AbstractEndpoint;
use Elasticsearch\Common\Exceptions;

/**
 * Class Info
 * @package Elasticsearch\Endpoints\Cluster\Node
 */
class Info extends AbstractEndpoint
{

    /** @var null|string */
    private $nodeID = null;


    /**
     * @param $nodeID
     *
     * @throws \Elasticsearch\Common\Exceptions\InvalidArgumentException
     * @return $this
     */
    public function setNodeID($nodeID)
    {
        if (is_string($nodeID) !== true) {
            throw new Exceptions\InvalidArgumentException('NodeID must be a string');
        }
        $this->nodeID = urlencode($nodeID);
        return $this;
    }


    /**
     * @return string
     */
    protected function getURI()
    {

        $nodeID = $this->nodeID;
        $uri   = "/_cluster/nodes";

        if (isset($nodeID) === true) {
            $uri = "/_cluster/nodes/$nodeID";
        }
        return $uri;
    }

    /**
     * @return string[]
     */
    protected function getParamWhitelist()
    {
        return array(
            'all',
            'clear',
            'http',
            'jvm',
            'network',
            'os',
            'plugin',
            'process',
            'settings',
            'thread_pool',
            'transport',
        );
    }

    /**
     * @return string
     */
    protected function getMethod()
    {
        return 'GET';
    }
}