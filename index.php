<?php
/**
 * The main template file
 * @package gauch
 */
get_header();

    // Blog Sidebar
    if(isset($gauch_opt['gauch_blog_sidebar'])) {
        if( $gauch_opt['gauch_blog_sidebar'] == 'gauch_without_sidebar_center' ):
            $gauch_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
        elseif( $gauch_opt['gauch_blog_sidebar'] == 'gauch_without_sidebar' ):
            $gauch_sidebar_class = 'col-lg-12 col-md-12';
        else:
            if( is_active_sidebar( 'sidebar-1' ) ):
                $gauch_sidebar_class = 'col-lg-8 col-md-12';
            else:
                $gauch_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
            endif;
        endif;
        $sidebar_hide = $gauch_opt['gauch_blog_sidebar'];
    } else {
        if( is_active_sidebar( 'sidebar-1' ) ):
            $gauch_sidebar_class = 'col-lg-8 col-md-12';
            $sidebar_hide = 'gauch_with_sidebar';
        else:
            $gauch_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
            $sidebar_hide = 'gauch_without_sidebar';
        endif;
    }

    // Blog title and breadcrumb
    if( isset($gauch_opt['blog_title']) ) {
        $title                  = $gauch_opt['blog_title'];
        $hide_breadcrumb        = $gauch_opt['hide_breadcrumb'];
        $hide_blog_banner       = $gauch_opt['hide_blog_banner'];
    } else {
        $hide_breadcrumb        = false;
        $hide_blog_banner       = false;
    }

    $gauch_blog_layout = !empty($gauch_opt['gauch_blog_layout']) ? $gauch_opt['gauch_blog_layout'] : 'container';

    if( isset($gauch_opt['page_title_tag']) ):
        $tag = $gauch_opt['page_title_tag'];
    else:
        $tag = 'h1';
    endif;
    ?>

    <!-- Start Page Title Area -->
    <?php if( $hide_blog_banner == false ): ?>
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content text-center">
                    <?php if( isset($gauch_opt['blog_title']) ): ?>
                        <<?php echo esc_attr( $tag ); ?>><?php echo esc_html( $title ); ?></<?php echo esc_attr( $tag ); ?>>
                    <?php else: ?>
                        <h1><?php esc_html_e('Blog', 'gauch'); ?></h1>
                    <?php endif; ?>

                    <?php if( $hide_breadcrumb == false ): ?>
						<?php
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb( '<p class="gauch-seo-breadcrumbs" id="breadcrumbs">','</p>' );
							} else { ?>
								<ul>
									<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'صفحه نخست', 'gauch' ); ?></a></li>
                                    <?php if( isset($gauch_opt['blog_title']) ): ?>
                                        <li><?php echo esc_html( $title ); ?></li>
                                    <?php else: ?>
                                        <li><?php esc_html_e('Blog', 'gauch'); ?></li>
                                    <?php endif; ?>
								</ul>
								<?php
							}
					endif; ?>
                </div>
            </div>

           <?php gauch_page_shape_images(); ?>
        </div>
    <?php endif; ?>
    <!-- End Page Title Area -->

    <!-- Start Blog Area -->
    <div class="blog-area pt-100 pb-70">
        <div class="<?php echo esc_attr( $gauch_blog_layout ); ?>">
            <div class="row">
                <!-- Start Blog Content -->
                <div class="<?php echo esc_attr( $gauch_sidebar_class ); ?>">
                    <div class="row">
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) :
                                the_post();
                                get_template_part( 'template-parts/content', get_post_format());
                            endwhile;
                        else :
                            get_template_part( 'template-parts/content', 'none' );
                        endif;
                        ?>

                        <?php if(paginate_links()): ?>
                            <!-- Stat Pagination -->
                            <div class="col-lg-12 col-md-12">
                                <div class="pagination-area">
                                    <?php echo paginate_links( array(
                                        'format' => '?paged=%#%',
                                        'prev_text' => '<i class="ri-arrow-left-line"></i>',
                                        'next_text' => '<i class="ri-arrow-right-line"></i>',
                                            )
                                        ) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- End Blog Content -->

                <?php if( $sidebar_hide == 'gauch_with_sidebar' ): ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End Blog Area -->
<?php
get_footer();