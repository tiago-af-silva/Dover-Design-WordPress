<?php /* NEWS */ ?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <div class="news_wrap">
            <div class="news_title">
                <h1>News</h1>
            </div>

            <div class="news_content clearfix">
                <?php
                    $args = array(
                        'numberposts' => '5',
                        'post_type' => 'newsletter',
                    );

                    $recent_posts = wp_get_recent_posts($args);

                    $share_message = urlencode('Latest news from Dover Design');

                    foreach ($recent_posts as $recent_post) {
                        $share_url = urlencode(trim($recent_post['post_content']));
                ?>
                    <div class="news_article">
                        <div class="news_article_top clearfix">
                            <div class="news_article_top_left">
                                <a href="https://twitter.com/home?status=<?php echo $share_message ?>%20<?php echo $share_url ?>" title="Share on Twitter" target="_blank">
                                    <?php echo file_get_contents('wp-content/themes/twentythirteen-child/assets/img/twitter.svg') ?>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url ?>" title="Share on Facebook" target="_blank">
                                    <?php echo file_get_contents('wp-content/themes/twentythirteen-child/assets/img/facebook.svg') ?>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url ?>&title=<?php echo $share_message ?>&summary=&source=" title="Share on LinkedIn" target="_blank">
                                    <?php echo file_get_contents('wp-content/themes/twentythirteen-child/assets/img/linkedin.svg') ?>
                                </a>
                            </div>

                            <div class="news_article_top_right">
                                <a href="<?php echo trim($recent_post['post_content']) ?>" target="_blank">View post</a>
                            </div>
                        </div>

                        <div class="news_article_meta">
                            <h3 class="news_article_title"><?php echo $recent_post['post_title'] ?></h3>
                            <p><?php echo get_the_date('F j, Y', $recent_post['ID']) ?></p>
                        </div>

                        <div class="news_article_content">
                            <?php
                                $dom = new DOMDocument();
                                @$dom->loadHTMLFile(trim($recent_post['post_content']));
                                $node = $dom->getElementById('bodyTable');

                                $innerHTML = '';
                                $children = $node->childNodes;

                                foreach ($children as $child) { 
                                    $innerHTML .= $child->ownerDocument->saveXML($child); 
                                }

                                echo $innerHTML;
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <?php include('footer-nav.php'); ?>
            </div>
        </div>
    <?php } ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>
