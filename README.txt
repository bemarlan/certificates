CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Recommended Modules
 * Installation
 * Configuration
 * Third Party Assets
 * Maintainers


INTRODUCTION
------------

The Certificate Generator module allows users to create PDFs by utilizing
the jsPDF Library.

 * For a information on jsPDF, visit
   https://parall.ax/products/jspdf


REQUIREMENTS
------------

 * This module requires no modules outside of Drupal core.


RECOMMENDED MODULES
-------------------

 * Token (https://www.drupal.org/project/token):
   When enabled, tokens can be placed in PDFs.


INSTALLATION
------------
 
 * Install the Certificate Generator module as you would normally install a
   contributed Drupal module. Visit: 
   https://drupal.org/documentation/install/modules-themes/modules-8
   for further information.


CONFIGURATION
-------------
 
    1. Navigate to Administration > Extend and enable the module.

    2. Configure user permissions in Administration > People > Permissions:

       - View certificate

         Users in roles with the "View certificate" permission will be able to
         view published certificates.

       - Administer certificates

         Users in roles with the "Administer certificates" permission will be
         able to add new certificate entities.


THIRD PARTY ASSETS
------------------

 * For information on jsPDF, visit
   https://parall.ax/products/jspdf

 * For jsPDF copyright and licensing information, visit
   https://github.com/MrRio/jsPDF/blob/master/MIT-LICENSE.txt


MAINTAINERS
-----------

This module was created by:

 * Beverly Lanning (bemarlan) - https://www.drupal.org/u/bemarlan

as an independent volunteer
