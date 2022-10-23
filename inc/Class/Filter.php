<?php
declare(strict_types = 1);

namespace NighyDev;

/**
 * Build and add all Filter Functionality
 * 
 * @param string $customPostType The name of the CPT

 */
class Filter {
    // Filter Properties
    private string $customPostType;

    public function __construct( string $customPostType) {
        $this->customPostType = $customPostType;
    }

    public function getCustomPostType() {
        return $this->customPostType;
    }

    public function setArgs() {
        $args = [
            'post_type' => $this->customPostType,
            'tax_query' => array(
                'relation' => 'AND',
            ),
        ];
        
        return $args;
    }

}
