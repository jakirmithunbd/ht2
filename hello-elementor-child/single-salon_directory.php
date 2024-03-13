<?php get_header();
$hero = get_field('hero_area', get_the_ID());
?>

<div class="quality-container">

    <section class="single-salon rounded" style="background-image: url(<?php echo $hero['image']['url']; ?>);">
        <div class="hero-content">
            <h1 class="text-center white"><strong><?php echo get_the_title(); ?></strong></h1>
        </div>
    </section>
</div>

<div class="quality-breadcrumb">
    <div class="quality-container">
        <?php echo custom_breadcrumb(); ?>
    </div>
</div>

<section class="salon-info">
    <div class="quality-container">
        <div class="salon-info-row">
            <div class="media rounded">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail();
                }
                ?>
            </div>

            <?php
            $subtitle = get_field('sub_title');
            $suite = get_field('suite');
            $bio = get_field('bio');
            ?>

            <div class="info-content">
                <h2><?php echo get_the_title(); ?></h2>

                <?php

                if ($subtitle) {
                    printf('<h4>%s</h4>', $subtitle);
                }

                $terms = get_the_terms(get_the_ID(), 'salon_type');

                // Check if terms were retrieved
                if ($terms && !is_wp_error($terms)) {
                    echo '<ul class="post-categories">';
                    foreach ($terms as $term) {
                        printf('<li><a href="%s">%s</a></li>', esc_url(get_term_link($term)), esc_html($term->name));
                    }
                    echo '</ul>';
                }

                if ($suite) {
                    printf('<h5>%s</h5>', $suite);
                }

                $terms = get_the_terms(get_the_ID(), 'artist_tag');

                // Check if terms were retrieved
                if ($terms && !is_wp_error($terms)) {
                    echo '<ul class="post-categories artist-tags">';
                    foreach ($terms as $term) {
                        printf('<li><a href="%s">%s</a></li>', esc_url(get_term_link($term)), esc_html($term->name));
                    }
                    echo '</ul>';
                }

                printf('<p>%s</p>', esc_html($bio));

                // contacts
                $contacts = get_field('contacts');
                if ($contacts) {
                    echo '<div class="contact-links">';
                    foreach ($contacts as $contact) {
                        if ($contact['contact_link']['url'] && $contact['contact_link']['title']) {
                            printf('<a href="%s"><img src="%s">%s</a>', $contact['contact_link']['url'], $contact['icon'], $contact['contact_link']['title']);
                        }
                    }
                    echo '</div>';
                }

                ?>
            </div>
        </div>

        <div class="gallery-group">
            <?php $gallery = get_field('gallery');
            if ($gallery) : foreach ($gallery as $item) : ?>
                    <a href="<?php echo $item['url']; ?>" class="media rounded">
                        <img src="<?php echo $item['url']; ?>" alt="<?php echo $item['tite']; ?>">
                    </a>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>
<div class="custom-footer-template">
    <?php $template = get_field('add_elementor_template');
    echo do_shortcode($template); ?>
</div>
<?php get_footer(); ?>