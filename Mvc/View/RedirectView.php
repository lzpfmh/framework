<?php

namespace TE\Mvc\View;

use TE\Mvc\Server\ResponseInterface as Response;
use TE\Mvc\Action\ActionEvent as Event;

/**
 * RedirectView  
 * 
 * @uses AbstractView
 * @copyright Copyright (c) 2012 Typecho Team. (http://typecho.org)
 * @author Joyqi <magike.net@gmail.com> 
 * @license GNU General Public License 2.0
 */
class RedirectView extends AbstractView
{
    /**
     * _url  
     * 
     * @var mixed
     * @access private
     */
    private $_url;

    /**
     * _isPermanently  
     * 
     * @var mixed
     * @access private
     */
    private $_isPermanently = false;

    /**
     * __construct  
     * 
     * @param Event $event
     * @param string $url 
     * @param boolean $isPermanently 
     * @access public
     * @return void
     */
    public function __construct(Event $event, $url, $isPermanently = false)
    {
        $this->_url = $url;
        $this->_isPermanently = $isPermanently;
    }

    /**
     * prepareResponse 
     * 
     * @param Response $response 
     * @access public
     * @return void
     */
    public function prepareResponse(Response $response)
    {
        $response->setStatusCode($this->_isPermanently ? 301 : 302)
            ->setHeader('Location', $this->_url);
    }

    /**
     * render  
     * 
     * @access public
     * @return void
     */
    public function render()
    {
        echo '<h1>Moved ' . ($this->_isPermanently ? 'permanently' : 'temporarily') . '</h1>'
            . '<p>Click the <a href="' . $this->_url . '">url</a> to redirect</p>';
        exit;
    }
}

