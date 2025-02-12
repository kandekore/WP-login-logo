# Custom Login Logo

**Contributors:** D Kandekore  
**Plugin Name:** Custom Login Logo  
**Author:** D Kandekore  
**Author URI:** [https://darrenk.uk](https://darrenk.uk)  
**Version:** 1.0  
**License:** GPLv2 or later  

---

## Description

The **Custom Login Logo** plugin replaces the default WordPress login screen logo with a custom image. You can upload and manage the logo directly from your WordPress Dashboard. Additionally, you can set a custom width and height for your logo to ensure it looks just right on the login page.

### Features

- **Easy Logo Upload**: Use the native WordPress Media Library to upload or select your logo.  
- **Custom Dimensions**: Adjust the logo width and height to fit your branding needs.  
- **Simple Setup**: Activate the plugin and set your preferences—no extra code needed.

---

## Installation

1. **Download the Plugin**  
   Download this repository as a `.zip` file, or copy the `custom-login-logo.php` file.

2. **Upload to WordPress**  
   - Go to the WordPress admin area: `Plugins > Add New`.  
   - Click **Upload Plugin**, then **Choose File**.  
   - Select the `.zip` file and press **Install Now**.  

   **OR** copy the `custom-login-logo.php` file into your `/wp-content/plugins/custom-login-logo/` folder.

3. **Activate the Plugin**  
   In your WordPress admin area, navigate to `Plugins` and click **Activate** under **Custom Login Logo**.

---

## Usage

1. **Access the Settings Page**  
   From the WordPress admin menu, go to `Settings > Custom Login Logo`.

2. **Upload or Select Your Logo**  
   - In the **Logo URL** field, either paste the URL of your logo or click the **Upload Logo** button.  
   - Use the WordPress Media Library to upload a new image or select an existing one.  

3. **Set Logo Dimensions**  
   - Define the **Logo Width** (in pixels).  
   - Define the **Logo Height** (in pixels).  

4. **Save Changes**  
   Click **Save Changes** to store your custom settings.

5. **View the Result**  
   Go to `[your-site]/wp-login.php` to verify your custom logo is displayed at the desired size.

---

## Frequently Asked Questions

1. **How do I revert to the default WordPress logo?**  
   Simply **deactivate** the plugin or remove the custom logo URL in the plugin settings.

2. **Why is my logo not displaying correctly?**  
   Make sure the **Logo URL** is correct, and verify the image link works by visiting it in your browser. Also, check your **width** and **height** values in case your image is oversized or undersized.

3. **Can I add additional custom CSS?**  
   Yes! You can either edit the plugin’s `custom_login_logo()` method to include more styles or add a custom CSS plugin that targets the `.login h1 a` element.

---

## Changelog

### 1.0
- Initial release of **Custom Login Logo**.

---

## License

This project is licensed under the **GPLv2 (or later)** license.  
[GPL License](https://www.gnu.org/licenses/gpl-2.0.html)

---

### Credits

- **Author**: [D Kandekore](https://darrenk.uk)

---

## Support

If you have any issues or questions, please feel free to reach out via the plugin’s [GitHub repository](https://github.com/kandekore/WP-login-logo/)
