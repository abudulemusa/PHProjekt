<?php
/**
 * Unit test
 *
 * This software is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License version 2.1 as published by the Free Software Foundation
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * @copyright  Copyright (c) 2008 Mayflower GmbH (http://www.mayflower.de)
 * @license    LGPL 2.1 (See LICENSE file)
 * @version    $Id$
 * @link       http://www.phprojekt.com
 * @since      File available since Release 6.0
 */
require_once 'PHPUnit/Framework.php';

/**
 * Tests Helpdesk Model class
 *
 * @copyright  Copyright (c) 2008 Mayflower GmbH (http://www.mayflower.de)
 * @license    LGPL 2.1 (See LICENSE file)
 * @version    Release: @package_version@
 * @link       http://www.phprojekt.com
 * @since      File available since Release 6.0
 * @author     Mariano La Penna <mariano.lapenna@mayflower.de>
 */
class Helpdesk_Models_Helpdesk_Test extends PHPUnit_Framework_TestCase
{
    /**
     * Test getNotificationRecipients method
     */
    public function testGetNotificationRecipients()
    {
        $helpdeskModel = new Helpdesk_Models_Helpdesk();
        $helpdeskModel->find(1);
        $response = $helpdeskModel->getNotificationRecipients();
        $this->assertEquals("1", $response);

        $helpdeskModel->find(2);
        $helpdeskModel->assigned = 2;
        $helpdeskModel->save();
        $helpdeskModel->assigned = 1;
        $helpdeskModel->save();
        $response = $helpdeskModel->getNotificationRecipients();
        $this->assertEquals("1,2", $response);
    }
}
