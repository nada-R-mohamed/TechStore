<?php if ($session->has("errors")) : ?>
	<div class="md-0 alert alert-danger text-center" style="width: fit-content;">
		<?php foreach ($session->get("errors") as $error) : ?>
			<?= $error . '<br>' ?>
		<?php endforeach;
		$session->remove("errors"); ?>
	</div>
<?php endif; ?>