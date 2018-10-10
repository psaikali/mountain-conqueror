<?php
global $post;
$event = apply_filters( 'inp_mc_event_data_source', $post->event, $post );
$notes = $event->additionalNotes();

if ( strlen( $notes ) === 0 ) {
	return;
}
?>
<div class="entry-event-additional-notes">
	<?php echo wp_kses_post( apply_filters( 'the_content', make_clickable( $notes ) ) ); ?>
</div>
