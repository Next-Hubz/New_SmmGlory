==================== SmartPanel - SMM PHP Script ====================

Thank you for purchasing SmartPanel!
This document contains important information about installing or upgrading the script.



-------------------------------------------------------------------------------
🆕 FOR NEW USERS:
-------------------------------------------------------------------------------

→ Use the file: installation.zip  
→ Follow the installation guide located in the /docs folder or visit:  
   https://smartpanelsmm.com/docs/

****************** Admin Login Page ==============  
    - URL: https://yourdomain.com/admin

    - To change the admin URL prefix:
      + Open the file: app\config\routes.php 
      + Locate the variable: $GLOBALS['ADMIN_URL_PREFIX'] and change it to your preferred value (default: 'admin').

💡 Need Installation Help?  
If you would like us to install SmartPanel for you on your VPS or shared hosting environment,  
please contact us via email to request an installation service:

📨 Email: smartpanelsmm@gmail.com

*Installation services may require an additional fee depending on your hosting environment.*




-------------------------------------------------------------------------------
♻️ FOR EXISTING USERS (UPGRADING FROM AN OLDER VERSION):
-------------------------------------------------------------------------------

    - Please make a full backup (Database + Source Code) before proceeding with any update.
    - Update guide: https://smartpanelsmm.com/docs/smartpanel.php  
    - After updating, clear your browser cache to avoid conflicts.
    - New admin login page: https://yourdomain.com/admin
    - Don’t forget to reconfigure your cronjobs — refer to the documentation for updated instructions.

------- IMPORTANT NOTES ----------------:
    1. **Change in Drip-Feed Order Feature:**  
       The new version has implemented an **automatic drip-feed order** feature, unlike the older versions where it had to be done manually (resell).  
       Therefore, **you will need to manually update** any existing drip-feed orders after upgrading to the new version.

    2. **Change in Service Sync Feature:**  
       The new version has updated the **service sync feature** for each service.  
       You will need to **reconfigure the sync settings** for each service after updating.

    3. If you're using an older version such as 3.2, 3.3, or 3.4 and plan to upgrade to version 4.2,  
       please contact us at: smartpanelsmm@gmail.com for further instructions.

    4. We strongly recommend keeping your panel updated to the latest version.  
       If issues occur during the upgrade, please note that support may not be immediate.  
       Contact us only if your support license is still valid.

---------------------------------------------------------------------------------------





-------------------------------------------------------------------------------
📧 SUPPORT POLICY – PLEASE READ:
-------------------------------------------------------------------------------

We provide support only to users with an **active support license**.

⚠️ IMPORTANT:
If your support period has expired, we will NOT be able to assist you  
until your license has been renewed via the platform where you purchased the script.

➤ Please verify your support status before contacting us.

To extend support, visit your download page and click “Renew support”.

If your license is active, you may contact us here:
📨 Email: smartpanelsmm@gmail.com  
Support response time: 1–2 business days (excluding weekends and public holidays)

-------------------------------------------------------------------------------



-------------------------------------------------------------------------------
➤ CHANGELOG:
-------------------------------------------------------------------------------

** Version 4.2 **
  - [NEW]: User Favorite service
  - [NEW]: Cancel Button
  - [NEW]: Average Order Completion Time
  - [NEW]: Search services on the New Order page
  - [NEW]: Group services by Social Media category on the New Order page
  - [NEW]: Auto Sync Services from the provider (with Rate percentage, min, max, name, cancel button)
  - [IMPROVED]: Edit/Add Service
  - [IMPROVED]: Drip-feed cronjob (Auto-send orders by drip-feed)
  - [IMPROVED]: **Page Load Speed** (Optimized the load time for all pages)
  - Fixed: Various small bugs and UI glitches

** Version 1.0  **
  – Initial Release (2019)
-------------------------------------------------------------------------------


🚀🚀🚀 Enjoy using SmartPanel – and once again, thank you for your trust! 🚀🚀🚀
