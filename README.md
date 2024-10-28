# Contact Form 7 - Email to Flamingo WordPress Plugin

[![Plugin Version](https://img.shields.io/badge/version-0.2-blue.svg)](https://github.com/drhdev/cf7-email-to-flamingo/releases)
[![License](https://img.shields.io/badge/license-GPLv2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

The Contact Form 7 - Email to Flamingo WordPress plugin is actually an add-on to the WordPress Plugins Contact Form 7 and Flamingo. It entirely disables email sending in Contact Form 7 and sends all CF7 submissions directly to Flamingo. It requires both the Contact Form 7 and the Flamingo WordPress plugins.

## Description

This WordPress plugin allows you to disable email sending in [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) and have all form submissions saved directly into the [Flamingo](https://wordpress.org/plugins/flamingo/) plugin's database.

It's particularly useful for sites where email delivery is unreliable, unnecessary, or when you prefer to manage form submissions within WordPress.

## Features

- **Disable Email Sending**: Prevent Contact Form 7 from sending emails.
- **Store Submissions in Flamingo**: All form submissions are saved in Flamingo's database.
- **Easy Configuration**: Simple settings page integrated into the Contact Form 7 menu.
- **Dependency Checks**: Notifies you if Contact Form 7 or Flamingo are not installed or activated.
- **Localization Ready**: Prepared for translation into multiple languages.

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) plugin
- [Flamingo](https://wordpress.org/plugins/flamingo/) plugin

## Installation

1. **Download the Plugin**:

   - Download the latest version from the [Releases](https://github.com/drhdev/cf7-email-to-flamingo/releases) page.

2. **Upload to WordPress**:

   - Upload the `cf7-email-to-flamingo` folder to the `/wp-content/plugins/` directory.
   - Alternatively, upload the ZIP file via the WordPress admin: `Plugins` -> `Add New` -> `Upload Plugin`.

3. **Activate the Plugin**:

   - Activate the plugin through the `Plugins` screen in WordPress.

4. **Ensure Dependencies are Active**:

   - Make sure both Contact Form 7 and Flamingo plugins are installed and activated.

5. **Configure the Plugin**:

   - Go to `Contact` -> `Email to Flamingo` to access the settings.
   - Check the option to disable email sending and save your changes.

## Usage

- **Disabling Email Sending**:

  - Navigate to `Contact` -> `Email to Flamingo`.
  - Check the box labeled `Disable email sending and send submissions to Flamingo only`.
  - Click `Save Changes`.

- **Re-enabling Email Sending**:

  - Uncheck the box in the settings page.
  - Save your changes.

## Screenshots

*No screenshots are currently available.*

## Frequently Asked Questions

### **Does this plugin require both Contact Form 7 and Flamingo?**

Yes, both plugins are required for this add-on to function properly.

### **Can I re-enable email sending after disabling it?**

Yes, simply uncheck the option in the plugin settings to re-enable email sending.

### **Will this plugin affect existing form submissions?**

No, it will only affect form submissions made after the plugin is activated and configured.

### **Is this plugin compatible with other Contact Form 7 add-ons?**

The plugin is designed to be compatible with other add-ons. However, if you experience any conflicts, please report them in the issues section.

## Contributing

Contributions are welcome! Please read the [Contributing Guidelines](CONTRIBUTING.md) for more information.

## Support

If you encounter any issues or have questions, feel free to [open an issue](https://github.com/drhdev/cf7-email-to-flamingo/issues) on GitHub.

## Changelog

### Version 0.2

- Improved error handling and compatibility.
- Added localization support.
- Included uninstall script.

### Version 0.1

- Initial release.

## Roadmap

- Add support for per-form settings.
- Implement logging of skipped emails.
- Provide more customization options.

## License

This plugin is licensed under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

## Acknowledgements

- [Contact Form 7](https://github.com/rocklobster-in/contact-form-7)
- [Flamingo](https://github.com/rocklobster-in/flamingo/)
- Inspired by the need to manage form submissions within WordPress without relying on email.

## Author

Developed by [drhdev](https://github.com/drhdev).

## Donations

If you find this plugin helpful, consider buying the the original [developers of CF7](https://contactform7.com/) a coffee! ;-)

## Disclosure

This WordPress plugin is not affliated or endorsed by the developers of Contact Form 7 and the Flamingo WordPress plugin.
