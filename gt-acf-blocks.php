<?php
/**
 * Plugin Name: GT ACF Blocks
 * Plugin URI:  https://gauravtiwari.org
 * Description: Auto-loads ACF block registrations from blocks/ subfolders.
 * Version:     1.0.4
 * Author:      Gaurav Tiwari
 * Text Domain: gt-acf-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// constants for plugin dir and URL
define( 'GT_ACF_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'GT_ACF_BLOCKS_URL', plugin_dir_url(  __FILE__ ) );

// Auto-load ACF field groups from JSON files
add_action( 'acf/init', 'gt_acf_load_block_field_groups', 4 );
function gt_acf_load_block_field_groups() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        error_log('ACF function acf_add_local_field_group not available');
        return;
    }

    $blocks_dir = GT_ACF_BLOCKS_DIR . 'blocks/';
    if ( ! is_dir( $blocks_dir ) ) {
        error_log('Blocks directory not found: ' . $blocks_dir);
        return;
    }

    $it = new DirectoryIterator( $blocks_dir );
    foreach ( $it as $item ) {
        if ( $item->isDot() || ! $item->isDir() ) {
            continue;
        }
        
        // Check for a JSON file with the same name as the block directory
        $block_name = $item->getFilename();
        $json_file = $item->getPathname() . '/' . $block_name . '.json';
        
        if ( file_exists( $json_file ) ) {
            // Read the file
            $json = file_get_contents( $json_file );
            
            // Decode the JSON data
            $json_data = json_decode( $json, true );
            
            // Check if json is valid
            if ( is_array( $json_data ) ) {
                // Check if a field group with this key already exists
                $existing_groups = acf_get_local_field_groups();
                $key_exists = false;
                
                if (isset($json_data[0]['key'])) {
                    $key = $json_data[0]['key'];
                    
                    foreach ($existing_groups as $group) {
                        if ($group['key'] === $key) {
                            $key_exists = true;
                            error_log('Field group key already exists: ' . $key . ' - skipping import from ' . $json_file);
                            break;
                        }
                    }
                    
                    if (!$key_exists) {
                        // Register the field group
                        acf_add_local_field_group( $json_data[0] );
                        error_log('Loaded ACF field group: ' . $key . ' from ' . $json_file);
                    }
                } else {
                    error_log('No key found in JSON data: ' . $json_file);
                }
            } else {
                error_log('Invalid JSON in file: ' . $json_file);
            }
        } else {
            error_log('JSON file not found: ' . $json_file);
        }
    }
}

// auto-load block registrations
add_action( 'acf/init', 'gt_acf_blocks_loader_init', 5 );
function gt_acf_blocks_loader_init() {
    if ( ! function_exists( 'acf_register_block_type' ) ) {
        return;
    }

    $blocks_dir = GT_ACF_BLOCKS_DIR . 'blocks/';
    if ( ! is_dir( $blocks_dir ) ) {
        return;
    }

    $it = new DirectoryIterator( $blocks_dir );
    foreach ( $it as $item ) {
        if ( $item->isDot() || ! $item->isDir() ) {
            continue;
        }
        $file = $item->getPathname() . '/block.php';
        if ( is_readable( $file ) ) {
            include_once $file;
        }
    }
}
