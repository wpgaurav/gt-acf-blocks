# GT ACF Blocks

A WordPress plugin that provides a framework for easily creating custom Gutenberg blocks using Advanced Custom Fields (ACF).

## Description

GT ACF Blocks simplifies the process of creating custom Gutenberg blocks for WordPress by leveraging the power of Advanced Custom Fields. This plugin allows developers to quickly build rich, customizable blocks with clean, organized code and without having to write complex JavaScript.

## Features

- Simple framework for registering custom Gutenberg blocks
- Seamless integration with Advanced Custom Fields
- Block templates with automatic field rendering
- Block categories for organization
- Block preview support
- CSS and JS enqueuing for individual blocks
- Developer-friendly API

## Requirements

- WordPress 5.8+
- PHP 7.4+
- Advanced Custom Fields PRO 5.8+

## Installation

1. Upload the `gt-acf-blocks` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ensure Advanced Custom Fields PRO is installed and activated

## Usage

### Creating a New Block

1. Create a new folder for your block in the `blocks` directory
2. Add your block's PHP, CSS, and JS files
3. Register your block using the plugin's API

### Basic Block Structure

```
blocks/
└── example-block/
    ├── block.json       # Block configuration
    ├── block.php        # Block template
    ├── block.css        # Block styles (optional)
    ├── block.js         # Block scripts (optional)
    └── fields.php       # ACF field definitions
```

### Registering a Block

Add your block registration to your theme's `functions.php` or a custom plugin:

```php
add_action('acf/init', 'register_my_blocks');

function register_my_blocks() {
    if (function_exists('gt_acf_blocks_register_block')) {
        gt_acf_blocks_register_block([
            'name'        => 'example-block',
            'title'       => 'Example Block',
            'description' => 'An example custom block',
            'category'    => 'formatting',
            'keywords'    => ['example', 'demo'],
        ]);
    }
}
```

## Adding a New Block

Follow these steps to create and register a new custom block:

1. **Create the block directory structure**:
   ```
   cd /path/to/your/wordpress/wp-content/plugins/gt-acf-blocks/blocks
   mkdir my-custom-block
   ```

2. **Create the necessary files**:
   - `block.json` - Block configuration
   - `block.php` - Block template
   - `fields.php` - ACF field definitions
   - `block.css` (optional) - Block styles
   - `block.js` (optional) - Block scripts

3. **Configure your block.json**:
   ```json
   {
     "name": "my-custom-block",
     "title": "My Custom Block",
     "description": "A description of what my block does",
     "category": "formatting",
     "icon": "star-filled",
     "keywords": ["custom", "example"],
     "acf": {
       "mode": "preview",
       "renderTemplate": "block.php"
     },
     "supports": {
       "align": true,
       "mode": false,
       "jsx": false
     }
   }
   ```

4. **Define your ACF fields in fields.php**:
   ```php
   <?php
   if (function_exists('acf_add_local_field_group')) {
       acf_add_local_field_group([
           'key' => 'group_my_custom_block',
           'title' => 'My Custom Block',
           'fields' => [
               [
                   'key' => 'field_my_custom_field',
                   'label' => 'Custom Field',
                   'name' => 'custom_field',
                   'type' => 'text',
               ],
           ],
           'location' => [
               [
                   [
                       'param' => 'block',
                       'operator' => '==',
                       'value' => 'acf/my-custom-block',
                   ],
               ],
           ],
       ]);
   }
   ```

5. **Create your block template in block.php**:
   ```php
   <?php
   /**
    * Block Template
    */
   
   // Get field values
   $custom_field = get_field('custom_field');
   ?>
   
   <div id="<?php echo esc_attr($block['id']); ?>" class="my-custom-block">
       <?php if ($custom_field): ?>
           <div class="custom-content">
               <?php echo esc_html($custom_field); ?>
           </div>
       <?php endif; ?>
   </div>
   ```

6. **Register your block** in your theme's functions.php or a custom plugin:
   ```php
   add_action('acf/init', 'register_my_blocks');
   
   function register_my_blocks() {
       if (function_exists('gt_acf_blocks_register_block')) {
           gt_acf_blocks_register_block([
               'name' => 'my-custom-block',
           ]);
       }
   }
   ```

7. **Add CSS (optional)** in block.css:
   ```css
   .my-custom-block {
       padding: 20px;
       background-color: #f8f8f8;
   }
   
   .my-custom-block .custom-content {
       font-size: 18px;
       color: #333;
   }
   ```

8. **Add JavaScript (optional)** in block.js:
   ```javascript
   (function($) {
       $(document).ready(function() {
           $('.my-custom-block').on('click', function() {
               // Your custom JavaScript here
           });
       });
   })(jQuery);
   ```

9. **Test your block** by adding it to a page or post in the WordPress editor.

## Configuration

Each block can be configured through its `block.json` file with the following options:

- `name`: Internal block name (required)
- `title`: Display title in the editor (required)
- `description`: Block description
- `category`: Block category
- `icon`: Dashicon or SVG to represent the block
- `keywords`: Search terms to help users discover the block
- `supports`: Block support options
- `example`: Preview example configuration

## Development

### Field Definitions

Define your ACF fields in the block's `fields.php` file:

```php
<?php
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_example_block',
        'title' => 'Example Block',
        'fields' => [
            [
                'key' => 'field_example_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
            ],
            // Add more fields as needed
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/example-block',
                ],
            ],
        ],
    ]);
}
```

### Block Template

Create your block's front-end display in the `block.php` file:

```php
<?php
/**
 * Block Template
 * 
 * @param array $block The block settings and attributes
 * @param string $content The block content
 * @param bool $is_preview Whether this is a preview in the editor
 */

// Get field values
$title = get_field('title');
?>

<div id="<?php echo esc_attr($block['id']); ?>" class="example-block">
    <?php if ($title): ?>
        <h2><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
</div>
```

## Support

For support, feature requests, or bug reports, please submit an issue via the GitHub repository or [send me a message](https://gauravtiwari.org).

## License

This plugin is licensed under the GPL v2 or later.

---

Built with ♥ by [Gaurav Tiwari](https://gauravtiwari.org)
