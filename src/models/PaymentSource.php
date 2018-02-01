<?php

namespace craft\commerce\models;

use Craft;
use craft\commerce\base\GatewayInterface;
use craft\commerce\base\Model;
use craft\commerce\Plugin as Commerce;
use craft\elements\User;

/**
 * Payment source model
 *
 * @property GatewayInterface $gateway
 * @property User             $user
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  2.0
 */
class PaymentSource extends Model
{
    // Properties
    // =========================================================================

    /**
     * @var int Payment source ID
     */
    public $id;

    /**
     * @var int The user ID
     */
    public $userId;

    /**
     * @var int The gateway ID.
     */
    public $gatewayId;

    /**
     * @var string Token
     */
    public $token;

    /**
     * @var string Description
     */
    public $description;

    /**
     * @var string Response data
     */
    public $response;

    /**
     * @var User|null $_user
     */
    private $_user;

    /**
     * @var GatewayInterface|null $_gateway
     */
    private $_gateway;

    // Public Methods
    // =========================================================================

    /**
     * Returns the payment source token.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->token;
    }

    /**
     * Returns the user element associated with this customer.
     *
     * @return User|null
     */
    public function getUser()
    {
        if (null === $this->_user) {
            $this->_user = Craft::$app->getUsers()->getUserById($this->userId);
        }

        return $this->_user;
    }

    /**
     * Returns the user element associated with this customer.
     *
     * @return GatewayInterface|null
     */
    public function getGateway()
    {
        if (null === $this->_gateway) {
            $this->_gateway = Commerce::getInstance()->getGateways()->getGatewayById($this->gatewayId);
        }

        return $this->_gateway;
    }

}