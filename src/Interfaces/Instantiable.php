<?php
/**
 * Eloquent IFRS Accounting
 *
 * @author Edward Mungai
 * @copyright Edward Mungai, 2020, Germany
 * @license MIT
 */
namespace IFRS\Interfaces;

use IFRS\Transactions\AbstractTransaction;

/**
 *
 * @author emung
 *
 */
interface Instantiable
{
    /**
     * Instantiate Transaction of the given type.
     *
     * @param string $type
     *
     * @return AbstractTransaction
     */
    public static function instantiate(string $type) : AbstractTransaction;
}
