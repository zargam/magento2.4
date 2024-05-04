Magento 2 - Add BG Color in Order Grid admin
Version : >= Magento 2.4
Installation
Copy the content of the repo to the app/code/Zargam/ChangeOrderStatusColor
Run command: php bin/magento setup:upgrade
Run command: php bin/magento setup:static-content:deploy (Use -f for force deploy on 2.2.x or later)
Now flush cache: php bin/magento cache:flush
