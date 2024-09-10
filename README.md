# Books Custom Post Type Plugin

The **Books Custom Post Type** plugin adds a custom post type called **Books** to your WordPress website. This post type includes custom fields for **Author**, **Genre**, **Publication Year**, and **ISBN**. It allows website administrators to input and manage book details from the WordPress admin panel.

Additionally, the plugin includes a **shortcode** for displaying a list of books on any page, with optional filtering by **author** or **genre**.

## Features

- Custom post type: "Books"
- Custom fields for each book:
  - **Author**
  - **Genre**
  - **Publication Year**
  - **ISBN**
- Easy-to-use interface for managing books in the WordPress admin panel
- Shortcode for displaying a list of books with optional filters
- Compatible with popular themes and page builders like **Elementor** and **WPBakery**
- Lightweight and follows WordPress coding standards

## Installation

1. Download the latest release from the [Release Page](https://github.com/tensor35/books-cpt/releases).
2. Go to the WordPress dashboard: **Plugins > Add New**.
3. Click on **Upload Plugin**.
4. Choose the downloaded `.zip` file and click **Install Now**.
5. Activate the plugin after installation.

## Usage

### Shortcode Example:

- To display all books:
  ```[books]```

- To filter books by genre:
  ```[books genre="Science Fiction"]```

- To filter books by author:
  ```[books author="J.K. Rowling"]```

## Development & Contribution

This plugin is open-source and licensed under **GPL2**. Contributions are welcome!

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-branch-name`.
3. Make changes and commit them: `git commit -m 'Add some feature'`.
4. Push to the branch: `git push origin feature-branch-name`.
5. Submit a pull request.

## License

This plugin is licensed under the **GNU General Public License v2.0**.  
See the [LICENSE](LICENSE.txt) file for details.

## Support

For issues or feature requests, please open an issue in the [GitHub Issues](https://github.com/tensor35/books-cpt/issues) section.
