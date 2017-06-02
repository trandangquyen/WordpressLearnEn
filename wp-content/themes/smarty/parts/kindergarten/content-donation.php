<?php
	$donation_view = 'post_view_single';
?>
<article id="donation-<?php the_ID(); ?>" <?php post_class( $donation_view ); ?>>
    <?php $page_id = smarty_page_id(); ?>
	<h2 class="entry-title entry-title_type_donation <?php if ( ! get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>hidden<?php endif; ?>"><?php the_title(); ?></h2>
	<div class="donation-info">
		<div class="donation-info__heading">
			<?php
				$stm_donation_goal = get_post_meta( get_the_ID(), 'stm_donation_goal', true );
				$stm_donation_raised = ( ( get_post_meta( get_the_ID(), 'stm_donation_raised', true ) ) ? : 0 );
				$stm_donation_currency = get_post_meta( get_the_ID(), 'stm_donation_currency', true );
				$stm_donation_donors = ( ( get_post_meta( get_the_ID(), 'stm_donation_donors', true ) ) ? : 0 );
				$stm_donation_currency_pos = get_post_meta( get_the_ID(), 'stm_donation_currency_pos', true );

				// Progress
				$stm_donation_progress = 0;
				if( $stm_donation_goal != '' && $stm_donation_raised != '' ) {
					$stm_donation_progress = round( ( $stm_donation_raised / $stm_donation_goal ) * 100 );
					if ( $stm_donation_progress > 100 || $stm_donation_progress == 100 ) {
						$stm_donation_progress = 100;
					}
				}
			?>
			<?php
				// Time
				$stm_donation_time = strtotime( get_post_meta( get_the_ID(), 'stm_donation_time', true ) );
				$stm_donation_time_today = strtotime( date( get_option('date_format') . get_option('time_format') ) );
				$stm_donation_time_difference = $stm_donation_time - $stm_donation_time_today;

				if( $stm_donation_time_difference > 0 ) {
					$stm_donation_time_left =  floor( $stm_donation_time_difference/(60*60*24) );
				} else {
					$stm_donation_time_left = 0;
				}

				// State
				$stm_donation_state = get_post_meta( get_the_ID(), 'stm_donation_state', true );
				if( $stm_donation_state === 'completed' ) {
					$stm_donation_time_left = 0;
				}
			?>
		</div>
		<div class="donation-info__progress">
				<div class="donation-info__progress-bar" style="width: <?php echo esc_attr( $stm_donation_progress . '%' ); ?>"></div>
		</div>
		<?php
			if( $stm_donation_currency_pos == 'right' ) {
				$stm_raised_val = number_format( $stm_donation_raised ) . $stm_donation_currency;
			} else {
				$stm_raised_val = $stm_donation_currency . number_format( $stm_donation_raised );
			}

			$stm_donation_stats = array(
				'donated' => array(
					'val'   => esc_html( $stm_donation_progress . '%' ),
					'label' => esc_html__('Donated', 'smarty')
				),
                'goal' => array(
                    'val'   => esc_html( '$'. $stm_donation_goal ),
                    'label' => esc_html__('Goal', 'smarty')
                ),
				'raised' => array(
					'val'   => esc_html( $stm_raised_val ),
					'label' => esc_html__('Raised', 'smarty')
				),
				'donors' => array(
					'val'   => esc_html( number_format( $stm_donation_donors ) ),
					'label' => esc_html__('Donors', 'smarty')
				),
				'time' => array(
					'val'   => esc_html(  $stm_donation_time_left ),
					'label' => esc_html__('Days left', 'smarty')
				)
			);
		?>
		<div class="donation-info__footer">
			<div class="donation-info__footer-col donation-info__footer-col_large">
				<div class="donation-info__stats">
					<?php if( !empty( $stm_donation_stats ) ) : ?>
						<?php foreach( $stm_donation_stats as $stm_donation_stats_item ) : ?>
							<div class="donation-info__stats-item">
                                <div class="donation-info__stats-label"><?php echo esc_html( $stm_donation_stats_item['label'] ); ?></div>
                                <div class="donation-info__stats-val"><?php echo esc_html( $stm_donation_stats_item['val'] ); ?></div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="donation-info__footer-col">
				<div class="donation-info__action">
					<?php if( $stm_donation_time_left > 0 ) : ?>
						<button type="button" data-target="#donate-form" data-toggle="modal" class="stm-btn stm-btn_flat stm-btn_pink stm-btn_md stm-btn_icon-right"><?php esc_html_e( 'Donate Now', 'smarty' ); ?></button>
					<?php else : ?>
						<button type="button" class="stm-btn stm-btn_flat stm-btn_pink stm-btn_md stm-btn_icon-right stm-btn_disabled"><?php esc_html_e( 'Has been completed', 'smarty' ); ?></button>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="entry-content"><?php the_content(); ?></div>
	<footer class="entry-footer">
		<div class="share entry-share">
			<span class="share__title"><?php esc_html_e('Share', 'smarty'); ?></span>
			<script type="text/javascript">var switchTo5x=true;</script>
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher: "07305ded-c299-419b-bbfc-2f15806f61b2", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

			<span class="share__item st_facebook_large" displayText='Facebook'></span>
			<span class="share__item st_twitter_large" displayText='Tweet'></span>
			<span class="share__item st_googleplus_large" displayText='Google +'></span>
			<span class="share__item st_sharethis_large" displayText='ShareThis'></span>
		</div>
	</footer>
</article>

<?php get_template_part( 'parts/donation', 'form' ); ?>