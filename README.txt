CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Creating a New PDF
 * Maintainers


INTRODUCTION
------------

The Certificate Generator module allows developers to create a PDF in realtime
by utilizing the jsPDF Library.

 * For a information od jsPDF, visit
   https://parall.ax/products/jspdf


REQUIREMENTS
------------

 * This module requires no modules outside of Drupal core.


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

       - View Course Completed Certificate


CREATING A New PDF
------------------
 
    1. Create a new js file under js/

       - Copy contents from an existing js file and follow inline instructions.

    2. Add a new library that includes your new js file to
       certificate_generator.libraries.yml.

       - Copy existing entry and update the library name and js file path.

    3. Add new routing for your PDF by adding a new entry to
       certificate_generator.routing.yml

       - Copy existing entry and update the routing name and path.

    4. Add a new case to the existing switch statement in
       certificate_generator.module under the
       certificate_generator_preprocess_page function. Case should be equal to
       your routing name, and the library should be 'certificate_generator/'
       plus your library name.


MAINTAINERS
-----------

This module was created by:

 * Beverly Lanning (bemarlan) - https://www.drupal.org/u/bemarlan

as an independent volunteer
