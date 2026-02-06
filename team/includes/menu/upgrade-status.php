<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access

$team_plugin_info = get_option('team_plugin_info');
$team_settings_upgrade = isset($team_plugin_info['settings_upgrade']) ? $team_plugin_info['settings_upgrade'] : '';
$team_members_upgrade = isset($team_plugin_info['team_members_upgrade']) ? $team_plugin_info['team_members_upgrade'] : '';
$team_upgrade = isset($team_plugin_info['team_upgrade']) ? $team_plugin_info['team_upgrade'] : '';

//echo '<pre>'.var_export($team_plugin_info, true).'</pre>';

wp_enqueue_style('font-awesome-5');
$url = admin_url().'edit.php?post_type=team&page=upgrade_status';

?>
<?php

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><h2><?php 
/* translators: PLugin Name */
echo esc_html(sprintf(__('%s Settings - Update', 'team'), team_plugin_name))?></h2>
    <p>Team settings and team member data should automatic upgrade. please wait until all team member and team data update completed. each loop will take 2 minute to completed, based on your team members and team it will take take few minutes to completed.</p>
    <p>If you have any issue please <a href="https://www.pickplugins.com/forum/">create support ticket</a> on our forum</p>
    <p>Don't panic while updating, your old data still saved on database and you can downgrade plugin any time, please <a href="https://wordpress.org/plugins/team/advanced/#plugin-download-history-stats">download from here</a> old version and reinstall.</p>

    <script>
        setTimeout(function(){
            window.location.href = '<?php echo esc_url($url); ?>';
        }, 1000*20);
    </script>

    <h3><?php echo esc_html(sprintf(__('Team settings upgrade status', 'team'))); ?></h3>

    <?php

    if(!empty($team_settings_upgrade)){
        ?>
        <p><?php echo esc_html(sprintf(__('Completed', 'team'))); ?></p>
        <?php
    }else{
        ?>
        <p><?php echo esc_html(sprintf(__('Pending', 'team'))); ?></p>
        <?php
    }

    ?>


    <h3><?php echo esc_html(sprintf(__('Team members upgrade status', 'team'))); ?></h3>
    <?php

    $meta_query = array();

    $meta_query[] = array(
        'key' => 'team_upgrade_status',
        'value' => 'done',
        'compare' => '='
    );

    $args = array(
        'post_type'=>'team_member',
        'post_status'=>'any',
        'posts_per_page'=> -1,
        'meta_query'=> $meta_query,

    );

    $wp_query = new WP_Query($args);

    if ( $wp_query->have_posts() ) :
        ?>
        <ul>
            <?php
            while ( $wp_query->have_posts() ) : $wp_query->the_post();

                $team_id = get_the_id();
                $team_title = get_the_title();
                ?>
                <li><?php echo esc_html($team_title); ?> - <?php echo esc_html(sprintf(__('Done', 'team'))); ?></li>
            <?php

            endwhile;
            ?>
        </ul>
    <?php
    else:
        ?>
        <p><?php echo esc_html(sprintf(__('Pending', 'team'))); ?></p>
    <?php
    endif;

    ?>




    <h3><?php echo esc_html(sprintf(__('Team upgrade status', 'team'))); ?></h3>
    <?php

    $meta_query = array();

    $meta_query[] = array(
        'key' => 'team_upgrade_status',
        'value' => 'done',
        'compare' => '='
    );

    $args = array(
        'post_type'=>'team',
        'post_status'=>'any',
        'posts_per_page'=> -1,
        'meta_query'=> $meta_query,

    );

    $wp_query = new WP_Query($args);

    if ( $wp_query->have_posts() ) :
        ?>
        <ul>
        <?php
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $team_id = get_the_id();
            $team_title = get_the_title();
            ?>
            <li><?php echo esc_html($team_title); ?> - <?php echo esc_html(sprintf(__('Done', 'team'))); ?></li>
            <?php

        endwhile;
        ?>
        </ul>
        <?php

    else:
        ?>
        <p><?php echo esc_html(sprintf(__('Pending', 'team'))); ?></p>
        <?php
    endif;

    ?>



    <p><a class="button" href="<?php echo esc_url(admin_url().'edit.php?post_type=team&page=upgrade_status'); ?>">Refresh</a> to check migration stats.</p>












</div>
