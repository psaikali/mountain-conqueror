<div class="entry-event-data">
	<div class="entry-event-details">
		<!-- I am assuming that every metadata is available on the Event object
			and that it will be the job of the plugin to return a default value if it is empty. -->
		<table>
			<tr>
				<th>
					<?php esc_html_e( 'Date of event:', 'inp-mc' ); ?>
				</th>
				<td>
					<?php printf(
						esc_html_x( 'From %1$s to %2$s', 'Event date', 'inp-mc' ),
						$post->event->startDate()->format( get_option( 'date_format' ) ),
						$post->event->endDate()->format( get_option( 'date_format' ) )
					); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Time:', 'inp-mc' ); ?>
				</th>
				<td>
					8:00 - 16:00
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Location:', 'inp-mc' ); ?>
				</th>
				<td>
					<?php 
					$location_string = _x(
						'<span class="location-name-and-street">%1$s %2$s</span>
						<span class="location-city">%3$s %4$s</span>
						<span class="location-country">%5$s</span>',
						'Event full address details',
						'inp-mc'
					);

					printf(
						wp_kses_post( $location_string ),
						$post->event->location()->name(),
						$post->event->location()->street(),
						$post->event->location()->postalCode(),
						$post->event->location()->city(),
						$post->event->location()->country()
					); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Subscriber:', 'inp-mc' ); ?>
				</th>
				<td>
					<?php printf( 
						esc_html_x( '%1$d - %2$d', 'Event min and max subscribers', 'inp-mc' ),
						$post->event->subscribedMin(),
						$post->event->subscribedMax()
					); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Price:', 'inp-mc' ); ?>
				</th>
				<td>
					110 €
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Included in price:', 'inp-mc' ); ?>
				</th>
				<td>
					<?php echo implode(
						_x( ', ', 'Event separator for the list of what is included in price', 'inp-mc' ),
						$post->event->includedInPrice()
					); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php esc_html_e( 'Registration end:', 'inp-mc' ); ?>
				</th>
				<td>
					<?php printf(
						esc_html_x( 'Until %1$s', 'Event date for end of registration', 'inp-mc' ),
						$post->event->registrationEnd()->format( get_option( 'date_format' ) )
					); ?>
				</td>
			</tr>
		</table>
	</div>

	<div class="entry-event-contact">
		<h3><?php esc_html_e( 'Contact person:', 'inp-mc'); ?></h3>
		<p>
			<?php 
			$contact_string = _x(
				'<span class="contact-name">%1$s %2$s</span>
				<span class="contact-position">%3$s</span>
				<span class="contact-email"><a href="mailto:%4$s">%4$s</a></span>
				<span class="contact-phone"><a href="tel:%5$s">%5$s</a></span>',
				'Event contact person details',
				'inp-mc'
			);

			printf(
				wp_kses_post( $contact_string ),
				$post->event->contactPerson()->firstName(),
				$post->event->contactPerson()->lastName(),
				$post->event->contactPerson()->position(),
				esc_attr( antispambot( $post->event->contactPerson()->email() ) ),
				esc_attr( $post->event->contactPerson()->telephone() )
			); ?>
		</p>
	</div>
</div>