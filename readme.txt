A CD-R (or DVD-R if necessary) of all your materials including your project code, documentation and so on.  
This CD-R must contain a file in the root directory called “readme.txt” which is a plain text file (editable 
by MS NotePad or the like) explaining the file system contents (directory structure and where files are located) 
and how to use the CD.  If your code uses a compiler not installed on Alicia’s machine, include a copy of the 
code in plain text format and/or include a printed copy of your code.

File system contents:
  Root folder:
    Account.php : Account page. Has personal run information and links depending on user type.
      Admins access admin pages via this account page.
    Changepassword.php : Page for users to change their password.
    Clientorderinfo.php : Displays client order information to users.
    Contact.php : Contact form for users to contact me with questions or concerns.
    Guides for site functions:
      Guide_browseco.php
      Guide_browsenpc.php
      Guide_browsequest.php
      Guide_changepassword.php
      Guide_login.php
      Guide_register.php
      Guide_submitdata.php
      Guide_viewdata.php
    Index.php : Home page for the site.
    Layout-styles.css : Style sheet for the site.
    Login.php : Page for logging in.
    Logout.php : Contains the logic for logging out.
    Mountains.jpeg : Image for the home page.
    Npcinfo.php : Displays NPC info for the user.
    Otherresources.php : Lists PSO2 resources and sites used for site development.
    Questinfo.php : Displays quest info, including runs.
    Readme.txt : ... This file. How meta.
    Register.php : Form for user to register to the site.
    Search.php : Contains various search functions.
    Submitdata.php : Form for users to submit data to the database.
    Termsofuse.php : Lists the terms of use of the website.
    Viewruns.php : Shows options for viewing quest run data.
    Viewruns_admin.php : Admin view of viewrunsall.php. Allows admin to delete quest runs.
    Viewrunsall.php : Displays a complete list of quest runs.
    Viewrunsgroup.php : Shows average data for quests calculated by quest runs.
    Viewusers_admin : Admin view of users. Allows admin to delete users.
  
  Includes folder:
    Header.php : Header file for each site page. Includes most of the navigation, and includes session checks.
    Footer.php : Footer file for each page. Includes some navigation and closes code started by Header.
    Mysqli_connect.php : Default connection file for the site. 
      NOTE: I HAVE REPLACED THE PASSWORD WITH 'PASSWORD' TO KEEP MY PASSWORD SAFE. LET ME KNOW IF YOU WANT A
      COPY OF THE ORIGINAL, UNEDITED FILE.
  
  Guideimages folder:
    Contains the image files for the site's guides.
  
  Buttons folder:
    Contains image files for each of the site's buttons.
