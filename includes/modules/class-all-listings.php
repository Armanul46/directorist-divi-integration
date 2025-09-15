<?php
/**
 * Directorist All Listings Divi Module
 */

defined( 'ABSPATH' ) || exit;

class DirectoristDiviAllListings extends ET_Builder_Module {

    public $slug       = 'directorist_all_listings';
    public $vb_support = 'off';

    protected $module_credits = [
        'module_uri' => 'https://wpwax.com',
        'author'     => 'wpWax',
        'author_uri' => 'https://wpwax.com',
    ];

    public function init() {
        $this->name = esc_html__( 'Directorist All Listing', 'directorist-divi-extension' );
        $this->settings_modal_toggles = $this->get_settings_modal_toggles();
    }

    /**
     * Get settings modal toggles for grouped settings
     */
    public function get_settings_modal_toggles() {
        $general = [
            'directory_type'     => esc_html__( 'Directory Type Settings', 'directorist-divi-extension' ),
            'listing_config'     => esc_html__( 'Listing Configuration', 'directorist-divi-extension' ),
            'filter_display'     => esc_html__( 'Filter & Display Controls', 'directorist-divi-extension' ),
            'pagination'         => esc_html__( 'Pagination Area', 'directorist-divi-extension' ),
        ];

        return [
            'general' => [ 'toggles' => $general ],
        ];
    }

    public function get_fields() {
        return [
            // Directory Type Settings Group
            'type' => [
                'label'           => esc_html__( 'Select Types', 'directorist-divi-extension' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'default'         => '',
                'description'     => $this->get_directory_types_description(),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'directory_type',
            ],
            'default_type' => [
                'label'           => esc_html__( 'Active Type', 'directorist-divi-extension' ),
                'type'            => 'select',
                'option_category' => 'basic_option',
                'options'         => $this->get_directory_types_options_with_empty(),
                'description'     => esc_html__( 'Select the default active directory type.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'directory_type',
            ],
            'type_align' => [
                'label'           => esc_html__( 'Type Alignment', 'directorist-divi-extension' ),
                'type'            => 'text_align',
                'option_category' => 'layout',
                'options'         => et_builder_get_text_orientation_options( [ 'justified' ] ),
                'default'         => 'left',
                'mobile_options'  => true,
                'responsive'      => true,
                'description'     => esc_html__( 'Choose how to align the directory type navigation.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'directory_type',
            ],

            // Listing Configuration Group
            'header' => [
                'label'           => esc_html__( 'Display Header Section', 'directorist-divi-extension' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => [
                    'on'  => esc_html__( 'Enable', 'directorist-divi-extension' ),
                    'off' => esc_html__( 'Disable', 'directorist-divi-extension' ),
                ],
                'default'         => 'on',
                'description'     => esc_html__( 'Show the listings header section.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'header_title' => [
                'label'           => esc_html__( 'Listings Found Text', 'directorist-divi-extension' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'default'         => esc_html__( 'Listings Found', 'directorist-divi-extension' ),
                'description'     => esc_html__( 'Text to display in the header section.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'sidebar' => [
                'label'           => esc_html__( 'Sidebar Options', 'directorist-divi-extension' ),
                'type'            => 'select',
                'option_category' => 'basic_option',
                'options'         => [
                    ''              => esc_html__( 'Default', 'directorist-divi-extension' ),
                    'left_sidebar'  => esc_html__( 'Left', 'directorist-divi-extension' ),
                    'right_sidebar' => esc_html__( 'Right', 'directorist-divi-extension' ),
                    'no_sidebar'    => esc_html__( 'No Sidebar', 'directorist-divi-extension' ),
                ],
                'default'         => '',
                'description'     => esc_html__( 'Select sidebar position.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'filter' => [
                'label'           => esc_html__( 'Enable Filter Button', 'directorist-divi-extension' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => [
                    'on'  => esc_html__( 'Enable', 'directorist-divi-extension' ),
                    'off' => esc_html__( 'Disable', 'directorist-divi-extension' ),
                ],
                'default'         => 'off',
                'description'     => esc_html__( 'Show filter button in header.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'preview' => [
                'label'           => esc_html__( 'Display Preview Image', 'directorist-divi-extension' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => [
                    'on'  => esc_html__( 'Enable', 'directorist-divi-extension' ),
                    'off' => esc_html__( 'Disable', 'directorist-divi-extension' ),
                ],
                'default'         => 'on',
                'description'     => esc_html__( 'Show preview images for listings.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'view' => [
                'label'           => esc_html__( 'View As', 'directorist-divi-extension' ),
                'type'            => 'select',
                'option_category' => 'basic_option',
                'options'         => [
                    'grid' => esc_html__( 'Grid', 'directorist-divi-extension' ),
                    'list' => esc_html__( 'List', 'directorist-divi-extension' ),
                    'map'  => esc_html__( 'Map', 'directorist-divi-extension' ),
                ],
                'default'         => 'grid',
                'description'     => esc_html__( 'Select the view type for listings.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'map_height' => [
                'label'           => esc_html__( 'Map Height', 'directorist-divi-extension' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'range_settings'  => [
                    'min'  => 300,
                    'max'  => 1980,
                    'step' => 10,
                ],
                'default'         => 500,
                'description'     => esc_html__( 'Set map height in pixels.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'columns' => [
                'label'           => esc_html__( 'Grid Columns', 'directorist-divi-extension' ),
                'type'            => 'select',
                'option_category' => 'basic_option',
                'options'         => [
                    '6' => esc_html__( '6 Columns', 'directorist-divi-extension' ),
                    '4' => esc_html__( '4 Columns', 'directorist-divi-extension' ),
                    '3' => esc_html__( '3 Columns', 'directorist-divi-extension' ),
                    '2' => esc_html__( '2 Columns', 'directorist-divi-extension' ),
                ],
                'default'         => '3',
                'description'     => esc_html__( 'Select number of columns for grid view.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'featured' => [
                'label'           => esc_html__( 'Show Featured Listings Only', 'directorist-divi-extension' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'directorist-divi-extension' ),
                    'off' => esc_html__( 'No', 'directorist-divi-extension' ),
                ],
                'default'         => 'off',
                'description'     => esc_html__( 'Display only featured listings.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'popular' => [
                'label'           => esc_html__( 'Show Popular Listings Only', 'directorist-divi-extension' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'directorist-divi-extension' ),
                    'off' => esc_html__( 'No', 'directorist-divi-extension' ),
                ],
                'default'         => 'off',
                'description'     => esc_html__( 'Display only popular listings.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],
            'user' => [
                'label'           => esc_html__( 'Only For Logged In User?', 'directorist-divi-extension' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => [
                    'on'  => esc_html__( 'Yes', 'directorist-divi-extension' ),
                    'off' => esc_html__( 'No', 'directorist-divi-extension' ),
                ],
                'default'         => 'off',
                'description'     => esc_html__( 'Show listings only to logged in users.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'listing_config',
            ],

            // Filter & Display Controls Group
            'cat' => [
                'label'           => esc_html__( 'Specify Categories', 'directorist-divi-extension' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'default'         => '',
                'description'     => $this->get_categories_description(),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'filter_display',
            ],
            'tag' => [
                'label'           => esc_html__( 'Specify Tags', 'directorist-divi-extension' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'default'         => '',
                'description'     => $this->get_tags_description(),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'filter_display',
            ],
            'location' => [
                'label'           => esc_html__( 'Specify Locations', 'directorist-divi-extension' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'default'         => '',
                'description'     => $this->get_locations_description(),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'filter_display',
            ],

            // Pagination Area Group
            'listing_number' => [
                'label'           => esc_html__( 'Listings Per Page', 'directorist-divi-extension' ),
                'type'            => 'range',
                'option_category' => 'basic_option',
                'range_settings'  => [
                    'min'  => 1,
                    'max'  => 50,
                    'step' => 1,
                ],
                'default'         => 6,
                'description'     => esc_html__( 'Number of listings to display per page. Set -1 to display all listings.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'pagination',
            ],
            'show_pagination' => [
                'label'           => esc_html__( 'Enable Pagination', 'directorist-divi-extension' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => [
                    'on'  => esc_html__( 'Enable', 'directorist-divi-extension' ),
                    'off' => esc_html__( 'Disable', 'directorist-divi-extension' ),
                ],
                'default'         => 'off',
                'description'     => esc_html__( 'Show pagination for listings.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'pagination',
            ],
            'order_by' => [
                'label'           => esc_html__( 'Order By', 'directorist-divi-extension' ),
                'type'            => 'select',
                'option_category' => 'basic_option',
                'options'         => [
                    'date'       => esc_html__( 'Date', 'directorist-divi-extension' ),
                    'title'      => esc_html__( 'Title', 'directorist-divi-extension' ),
                    'price'      => esc_html__( 'Price', 'directorist-divi-extension' ),
                    'featured'   => esc_html__( 'Featured', 'directorist-divi-extension' ),
                    'popular'    => esc_html__( 'Popular', 'directorist-divi-extension' ),
                    'rating'     => esc_html__( 'Rating', 'directorist-divi-extension' ),
                    'rand'       => esc_html__( 'Random', 'directorist-divi-extension' ),
                ],
                'default'         => 'date',
                'description'     => esc_html__( 'Select how to order the listings.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'pagination',
            ],
            'order_list' => [
                'label'           => esc_html__( 'Order', 'directorist-divi-extension' ),
                'type'            => 'select',
                'option_category' => 'basic_option',
                'options'         => [
                    'asc'  => esc_html__( 'Ascending', 'directorist-divi-extension' ),
                    'desc' => esc_html__( 'Descending', 'directorist-divi-extension' ),
                ],
                'default'         => 'desc',
                'description'     => esc_html__( 'Select the order direction.', 'directorist-divi-extension' ),
                'tab_slug'        => 'general',
                'toggle_slug'     => 'pagination',
            ],
        ];
    }

    /**
     * Get directory types description with available options
     */
    private function get_directory_types_description() {
        $description = esc_html__( 'Enter directory type slugs separated by commas (e.g., business,restaurant). Leave empty to display all types.', 'directorist-divi-extension' );
        
        if ( function_exists( 'directorist_is_multi_directory_enabled' ) && directorist_is_multi_directory_enabled() ) {
            $all_types = get_terms([
                'taxonomy'   => ATBDP_TYPE,
                'hide_empty' => false,
            ]);

            if ( ! is_wp_error( $all_types ) && ! empty( $all_types ) ) {
                $type_list = [];
                foreach ( $all_types as $type ) {
                    $type_list[] = $type->slug . ' (' . $type->name . ')';
                }
                $description .= '<br><strong>' . esc_html__( 'Available types:', 'directorist-divi-extension' ) . '</strong><br>' . implode( ', ', $type_list );
            }
        }

        return $description;
    }

    /**
     * Get categories description with available options
     */
    private function get_categories_description() {
        $description = esc_html__( 'Enter category slugs separated by commas (e.g., food,shopping). Leave empty to display all categories.', 'directorist-divi-extension' );
        
        $categories = get_terms( ATBDP_CATEGORY );
        if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
            $cat_list = [];
            foreach ( $categories as $category ) {
                $cat_list[] = $category->slug . ' (' . $category->name . ')';
            }
            $description .= '<br><strong>' . esc_html__( 'Available categories:', 'directorist-divi-extension' ) . '</strong><br>' . implode( ', ', $cat_list );
        }

        return $description;
    }

    /**
     * Get tags description with available options
     */
    private function get_tags_description() {
        $description = esc_html__( 'Enter tag slugs separated by commas (e.g., featured,popular). Leave empty to display all tags.', 'directorist-divi-extension' );
        
        $tags = get_terms( ATBDP_TAGS );
        if ( ! is_wp_error( $tags ) && ! empty( $tags ) ) {
            $tag_list = [];
            foreach ( $tags as $tag ) {
                $tag_list[] = $tag->slug . ' (' . $tag->name . ')';
            }
            $description .= '<br><strong>' . esc_html__( 'Available tags:', 'directorist-divi-extension' ) . '</strong><br>' . implode( ', ', $tag_list );
        }

        return $description;
    }

    /**
     * Get locations description with available options
     */
    private function get_locations_description() {
        $description = esc_html__( 'Enter location slugs separated by commas (e.g., new-york,london). Leave empty to display all locations.', 'directorist-divi-extension' );
        
        $locations = get_terms( ATBDP_LOCATION );
        if ( ! is_wp_error( $locations ) && ! empty( $locations ) ) {
            $location_list = [];
            foreach ( $locations as $location ) {
                $location_list[] = $location->slug . ' (' . $location->name . ')';
            }
            $description .= '<br><strong>' . esc_html__( 'Available locations:', 'directorist-divi-extension' ) . '</strong><br>' . implode( ', ', $location_list );
        }

        return $description;
    }

    /**
     * Get directory types options with empty option
     */
    private function get_directory_types_options_with_empty() {
        $options = ['' => esc_html__( 'No Default Selection', 'directorist-divi-extension' )];
        
        if ( function_exists( 'directorist_is_multi_directory_enabled' ) && directorist_is_multi_directory_enabled() ) {
            $all_types = get_terms([
                'taxonomy'   => ATBDP_TYPE,
                'hide_empty' => false,
            ]);

            if ( ! is_wp_error( $all_types ) ) {
                foreach ( $all_types as $type ) {
                    $options[$type->slug] = $type->name;
                }
            }
        }

        return $options;
    }

    public function get_advanced_fields_config() {
        return [
            'text'           => false,
            'text_shadow'    => false,
            'fonts'          => false,
            'background'     => false,
            'borders'        => false,
            'box_shadow'     => false,
            'button'         => false,
            'link_options'   => false,
            'custom_margin_padding' => false,
        ];
    }

    /**
     * Generate Type Alignment CSS
     */
    private function add_type_alignment_css( $render_slug ) {
        $alignment_map = [
            'left'   => 'flex-start',
            'center' => 'center', 
            'right'  => 'flex-end',
        ];
        
        $type_align = $this->props['type_align'] ?? '';
        $type_align_tablet = $this->props['type_align_tablet'] ?? '';
        $type_align_phone = $this->props['type_align_phone'] ?? '';
        
        // Desktop
        if ( ! empty( $type_align ) && isset( $alignment_map[$type_align] ) ) {
            ET_Builder_Element::set_style( $render_slug, [
                'selector'    => '.directorist-type-nav .directorist-type-nav__list',
                'declaration' => sprintf( 'justify-content: %s !important;', $alignment_map[$type_align] ),
            ] );
        }
        
        // Tablet
        if ( ! empty( $type_align_tablet ) && isset( $alignment_map[$type_align_tablet] ) ) {
            ET_Builder_Element::set_style( $render_slug, [
                'selector'    => '.directorist-type-nav .directorist-type-nav__list',
                'declaration' => sprintf( 'justify-content: %s !important;', $alignment_map[$type_align_tablet] ),
                'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
            ] );
        }
        
        // Phone
        if ( ! empty( $type_align_phone ) && isset( $alignment_map[$type_align_phone] ) ) {
            ET_Builder_Element::set_style( $render_slug, [
                'selector'    => '.directorist-type-nav .directorist-type-nav__list',
                'declaration' => sprintf( 'justify-content: %s !important;', $alignment_map[$type_align_phone] ),
                'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
            ] );
        }
    }

    public function render( $attrs, $content = null, $render_slug ) {
        // Add Type Alignment CSS
        $this->add_type_alignment_css( $render_slug );
        
        // Get all props
        $header         = $this->props['header'] ?? 'on';
        $header_title   = $this->props['header_title'] ?? 'Listings Found';
        $sidebar        = $this->props['sidebar'] ?? '';
        $filter         = $this->props['filter'] ?? 'off';
        $preview        = $this->props['preview'] ?? 'on';
        $view           = $this->props['view'] ?? 'grid';
        $map_height     = $this->props['map_height'] ?? 500;
        $columns        = $this->props['columns'] ?? '3';
        $featured       = $this->props['featured'] ?? 'off';
        $popular        = $this->props['popular'] ?? 'off';
        $user           = $this->props['user'] ?? 'off';
        $type           = $this->props['type'] ?? '';
        $default_type   = $this->props['default_type'] ?? '';
        $cat            = $this->props['cat'] ?? '';
        $tag            = $this->props['tag'] ?? '';
        $location       = $this->props['location'] ?? '';
        $listing_number = $this->props['listing_number'] ?? 6;
        $show_pagination = $this->props['show_pagination'] ?? 'off';
        $order_by       = $this->props['order_by'] ?? 'date';
        $order_list     = $this->props['order_list'] ?? 'desc';

        // Prepare shortcode attributes - using exact same format as Directorist core
        $shortcode_atts = [
            'header'            => $header === 'on' ? 'yes' : 'no',
            'header_title'      => $header_title,
            'view'              => $view,
            'map_height'        => $map_height,
            'columns'           => $columns,
            'listings_per_page' => $listing_number,
            'show_pagination'   => $show_pagination === 'on' ? 'yes' : 'no',
            'featured_only'     => $featured === 'on' ? 'yes' : 'no',
            'popular_only'      => $popular === 'on' ? 'yes' : 'no',
            'logged_in_user_only' => $user === 'on' ? 'yes' : 'no',
            'display_preview_image' => $preview === 'on' ? 'yes' : 'no',
            'orderby'           => $order_by,
            'order'             => $order_list,
        ];

        // Add sidebar if specified
        if ( ! empty( $sidebar ) ) {
            $shortcode_atts['sidebar'] = $sidebar;
        }

        // Add filter setting
        if ( $sidebar === 'no_sidebar' && $filter === 'on' ) {
            $shortcode_atts['advanced_filter'] = 'yes';
        } else {
            $shortcode_atts['advanced_filter'] = 'no';
        }

        // Add directory type if specified
        if ( ! empty( $type ) ) {
            $shortcode_atts['directory_type'] = $type;
        }
        
        // Add default directory type if specified
        if ( ! empty( $default_type ) ) {
            $shortcode_atts['default_directory_type'] = $default_type;
        }

        // Add taxonomy filters
        if ( ! empty( $cat ) ) {
            $shortcode_atts['category'] = $cat;
        }
        if ( ! empty( $tag ) ) {
            $shortcode_atts['tag'] = $tag;
        }
        if ( ! empty( $location ) ) {
            $shortcode_atts['location'] = $location;
        }

        // Generate Type Alignment CSS using Divi's standard method
        $this->generate_type_alignment_styles( $render_slug );
        
        // Build shortcode
        $shortcode = '[directorist_all_listing';
        foreach ( $shortcode_atts as $key => $value ) {
            if ( ! empty( $value ) ) {
                $shortcode .= ' ' . $key . '="' . esc_attr( $value ) . '"';
            }
        }
        $shortcode .= ']';

        return do_shortcode( $shortcode );
    }
}
