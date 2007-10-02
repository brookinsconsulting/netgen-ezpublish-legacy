#!/usr/bin/env php
<?php
//
// Created on: <14-Jan-2005 09:27:13 dr>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ publish
// SOFTWARE RELEASE: 3.10.x
// COPYRIGHT NOTICE: Copyright (C) 1999-2006 eZ systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

//include_once( 'lib/ezutils/classes/ezcli.php' );
//include_once( 'kernel/classes/ezscript.php' );

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "eZ Publish static cache generator\n" .
                                                        "\n" .
                                                        "./bin/makestaticcache.php --siteaccess user" ),
                                     'use-session' => false,
                                     'use-modules' => true,
                                     'use-extensions' => true ) );

$script->startup();

$options = $script->getOptions( "[f|force]",
                                "",
                                array( 'force' => "Force generation of cache files even if they already exist." ) );

$force = $options['force'];

$script->initialize();

require_once( 'lib/ezutils/classes/ezdebug.php' );
//include_once( 'lib/ezfile/classes/ezdir.php' );
//include_once( 'lib/ezutils/classes/ezini.php' );
//include_once( 'kernel/classes/ezstaticcache.php' );

$staticCache = new eZStaticCache();
$staticCache->generateCache( $force, false, $cli, false );

if ( !$force )
{
    $staticCache->generateAlwaysUpdatedCache( false, $cli, false );
}

eZStaticCache::executeActions();

$script->shutdown();

?>
