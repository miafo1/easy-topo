<?php

/*
  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License or any later version.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly
if (!defined('__MONETBIL__')) {
    exit;
}

// To get your service key and secret, go to -> https://www.monetbil.com/services
Monetbil::setServiceKey('c3xOwCav9rEjeJrLwpMbYtXBuzXS037h');
Monetbil::setServiceSecret('sMKEfPUjQGaiWBOO9DykXydi5d7Zi6hM27vlknuqBNxf3SksTfas1CLjExZrrkH8');

// To use responsive widget, set version to 'v2.1'
Monetbil::setWidgetVersion('v2.1');
