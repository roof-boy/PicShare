A small instagram clone project I am working on in order to practice my PHP, HTML, CSS and Bootstrap skills.

Contains a functional login and registration system

## INSTALLATION

Download the latest release, extract it in the **www** folder of your Wamp installation, it is **mandatory** that you rename the folder to PicShare. Head to your PhpMyAdmin and import **picshare.sql**. After that, make sure you are using the root account which has a password of root (this will be made more flexible in the future). Other than that your installation should be ready to go.

### Registering a user as admin

In order to register a user as an admin/moderator, you should register an account as normal. After that, head into the table **users** and edit the entry for the account you want to make an admin. Change **IsAdmin** from 0 to 1. After that, when logging in to the admin account, an additional option for the Moderation Panel should appear at the top of the navigation bar at the top.

## Possible upload error

When uploading, if the image exceeds the maximum file size, it will return to the upload page with the url "..upload.php?error=error_file_upload". If the upload is succesful it should return you to the main page where you will be able to see your post.

# UPDATE 10 - 8 - 2024

To whomever this may concern, this project is not dead. I am working behind the scenes with a remastering of the UI and a remastering of the backend. The release date for the next update is unknown however it will come at some point. Meanwhile, enjoy some of these new UI screenshots:
![image](https://github.com/user-attachments/assets/0f764a48-2ca4-4e86-81ad-07b625be9266)
![image](https://github.com/user-attachments/assets/d06284ed-582c-4e19-b1ee-72e8068ee969)
