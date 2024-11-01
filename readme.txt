=== Google Drive for Wordpress ===

Contributors: Securenext Softwares WP Team, Malarvizhi Krishnan
Plugin url:http://www.securenext.com
Tags: Google drive for Wordpress, WP Google drive, Bakup WP with Google drive, securenext google drive, back up, backup, Drive backup, google drive, wordpress backup
Requires at least: 3.1
Tested up to: 3.4.1
Stable tag: 2.2

Google drive for Wordpress plugin used to backup Wordpress files and DB with Google Drive. 

== Description ==

This plugin used to Make backups of your Wordpress files and Mysql DB with Google Drive. Google Drive for Wordpress is a plugin that provides backup capabilities for Wordpress. Backups are 'zip' archives created locally and uploaded to a folder of your choosing on Google Drive.

[http://www.securenext.com](http://www.securenext.com "http://www.securenext.com")
	
== Installation ==

The plugin requires at least WordPress 3.1 and is installed like any other plugin.
	
1. Upload the plugin to the '/wp-contents/plugins/' folder.
2. Activate the plugin from the 'Plugins' menu in WordPress.
3. Configure the plugin by following the instructions on the 'Google Drive for Wordpress' settings page.

http://www.youtube.com/watch?v=oactH9QBPn4

== Configuration ==

Here is the step-by-step guide that helps to backup your WordPress blog to Google Drive. Brief list of things you have to do in this tutorial:

1. Login to Google API and create a Client ID in it.

2. Authorizing the Plugin by using Client ID and Client Secret.

3. Setting up the plugin frequency to take backups.
	   
To create API key with Google APIs Console: 

1. Follow this link Google APIs Console and login to your Google Account.

2. Go to 'API Access' tab and click on 'Create an OAuth 2.0 client ID'.

3. In the pop-up window, give a product name and upload logo before clicking on 'Next' button.

4. By default "Web Application" will be selected and don't change it.

5. In "Your site or hostname" section, click on "More Options" to expand link sections.

6. Click on "Create Client ID" and you have successfully created a Client ID using Google API Console.

7. Copy the Client ID and Client Secret from API dashboard and paste them in "Configure Google" page.

9. You have to authorize the plugin by clicking on "Allow Access" button.

10. Allow Access to the Plugin and the entire setup has been successfully installed.
   
Backup Settings:

1. You can name your backup directory, any name you like just enter it on text box.

2. Mail Options : Enable this option to receive mail notification after successful backup on 
   google drive.

3. Schedule Backup:You can schedule a backup duration here. Based upon the Scheduled time, 
   it will automatically perform schedule backup to google drive.

4. Manage database : 
   --Check yes, if you want to keep Database backup
   --Check the option if you want to exclude particular tables from backup
   --Always keep a recent backup of your site.Here you have option to keep most recent backups. 
     Select how many you want to maintain on your server. 
   --If you want, you can move particular backup folder to google drive.
   
5. Manage Files: wp-content files 
   --Check option to exclude files from backup
   --Select how many backups you would like to maintain on your server.
   --If you want, you can move particular backup folder to google drive.

6. Manage Files: wordpress core files
   --Check option to exclude files from backup
   
7. On-time backup: For immediate backup.

FYI:

Both schedule backup and Ontime backup will works based upon your files selection on Manage database and Manage Files section.

Multisite support:
Activate the plugin through Network admin. 
Once you activated, the plugin automatically get activated for all configured sites.

Database backup on multisite : When you take backup through Main site, it will backup all sites database.
For particular sub-domain or subdirectory, corresponding DB tables will be back up.

== Screenshots ===

1. Configure Google Account
2. BackUp Settings
3. Manage database
4. Manage Files
5. Ontime Backup

== Version History ==

version 2.2

Included core files backup
Fixed backup timeout issues.
Updated multisite support functionalities

Version 2.1

Increased backup memory limit for large files
Changed Mail format 
Changed Status Message Text

Version 2.0

Fixed large file backup errors on some servers.
Fixed fatal error issues.

Added features

1. Manage database
2. Manage Files
3. User handling for recent backups and folder restrictions.

Version 1.0 

*Plugin still in development phase.