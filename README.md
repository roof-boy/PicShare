A small instagram clone project I am working on in order to practice my PHP, HTML, CSS and Bootstrap skills.

Contains a functional login and registration system

## INSTALLATION

Download the latest release, extract it in the **www** folder of your Wamp installation, it is **mandatory** that you rename the folder to PicShare. Head to your PhpMyAdmin and import **picshare.sql**. After that, make sure you are using the root account which has a password of root (this will be made more flexible in the future). Other than that your installation should be ready to go.

### Registering a user as admin

In order to register a user as an admin/moderator, you should register an account as normal. After that, head into the table **users** and edit the entry for the account you want to make an admin. Change **IsAdmin** from 0 to 1. After that, when logging in to the admin account, an additional option for the Moderation Panel should appear at the top of the navigation bar at the top.
