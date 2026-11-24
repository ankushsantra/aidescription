# AI Description
An AI-powered Magento 2 module that automatically generates unique, engaging, and SEO-friendly product descriptions with just a clicks. (Compatible with M2.4.*)

# Requirements
    Minimum PHP 8.1  
    Maximum PHP 8.4  
    Magento minimum version: 2.4.4
    Magento maximum version: 2.4.8  

# Installation
#### Installing

In the command line, navigate to the installation directory of Magento2

Update your root Magento composer.json:
```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ankushsantra/aidescription.git"
        }
    ]
}
```
Enter the following commands:

```
composer require ankush/aidescription:dev-main
php bin/magento setup:upgrade
php bin/magento cache:clean
```

The plugin is now installed

## Module Setup and Configuration

Follow the steps below to configure and use the AI Product Description module in Magento 2.

1. Log in to the **Magento Admin Panel**.
2. Navigate to **Marketing → Communications → AI Agents**.
3. Create a new **AI Agent** and configure the required details.
4. Navigate to **Stores → Configuration → AI Configuration**.
5. Configure the following API settings:
   - **API URL**
   - **API Model**
   - **Authorization Key**
6. Under the **AI Agents** section, configure the **Product Description** prompt or instruction.
7. Click **Save Config** to save the configuration.
8. Navigate to **Catalog → Products**.
9. Open any product you want to update and click the **Run AI** button.
10. The AI-generated product description will appear in the **AI Description** textarea field.
11. Review the generated description and click **Save** to update the product.

**Note:** Make sure the AI Agent and API configuration are properly set up before generating product descriptions.


#### Update instructions

In the command line, navigate to the installation directory of Magento2

Enter the following commands:

```
composer update ankush/aidescription -W
php bin/magento setup:upgrade
php bin/magento cache:clean
```

