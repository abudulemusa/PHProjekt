<?php
/**
 * WebDAV collection model.
 *
 * This software is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License version 3 as published by the Free Software Foundation
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details
 *
 * @category   PHProjekt
 * @package    Application
 * @subpackage WebDAV
 * @copyright  Copyright (c) 2011 Mayflower GmbH (http://www.mayflower.de)
 * @license    LGPL v3 (See LICENSE file)
 * @link       http://www.phprojekt.com
 * @since      File available since Release 6.1
 * @author     Simon Kohlmeyer <simon.kohlmeyer@mayflower.de>
 */

/**
 * WebDAV collection model.
 *
 * A directory in the webdav structure. Maps to a project.
 *
 * @category   PHProjekt
 * @package    Application
 * @subpackage WebDAV
 * @copyright  Copyright (c) 2011 Mayflower GmbH (http://www.mayflower.de)
 * @license    LGPL v3 (See LICENSE file)
 * @link       http://www.phprojekt.com
 * @since      File available since Release 6.1
 * @author     Simon Kohlmeyer <simon.kohlmeyer@mayflower.de>
 */
class WebDAV_Models_ProjectDirectory extends Sabre_DAV_Collection
{
    protected $_project;

    /**
     * Constructor
     *
     * @param Project_Models_Project $project The project that this object represents.
     */
    public function __construct(Project_Models_Project $project)
    {
        $this->_project = $project;
    }

    /**
     * Retrieves the child node with this specific name.
     *
     * @param string $name The name of the child node to get.
     */
    public function getChild($name)
    {
        if (WebDAV_Constants::SUBPROJECTS_NAME === $name) {
            return new WebDAV_Models_SubprojectsDirectory($this->_project);
        } elseif (WebDAV_Constants::FILEMANAGERS_NAME === $name) {
            return new WebDAV_Models_FilemanagersDirectory($this->_project);
        }

        throw new Sabre_DAV_Exception_NotFound('Directory not found: ' . $name);
    }

    /**
     * Checks if a child with the given name exists.
     *
     * @param string $name The name of the child.
     */
    public function childExists($name)
    {
        return in_array($name, array(WebDAV_Constants::SUBPROJECTS_NAME, WebDAV_Constants::FILEMANAGERS_NAME));
    }

    public function createFile($name, $data = NULL)
    {
        throw new Sabre_DAV_Exception_NotImplemented('Files can only be created in Filemanager directories');
    }

    public function createDirectory($name)
    {
        throw new Sabre_DAV_Exception_NotImplemented(
            'Directories can only be created in the "Filemanagers" subdirectories of projects'
        );
    }

    public function getName()
    {
        return $this->_project->title;
    }

    public function getChildren()
    {
        return array(
            new WebDAV_Models_SubprojectsDirectory($this->_project),
            new WebDAV_Models_FilemanagersDirectory($this->_project)
        );
    }

}
