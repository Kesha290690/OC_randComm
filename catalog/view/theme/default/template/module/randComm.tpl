<?php if($reviews) { ?>
<div class="row">
    <div class="col-sm-12">
	<?php echo $module_name; echo $category_name; ?>
        <?php foreach($reviews as $review) { ?>
        <div class="col-sm-4">
            <p><span class="bg-primary"><?php echo $review['author']; ?></span> <span class="bg-info"><?php echo $review['date_added']; ?></span></p>
            <img src="<?php echo $review['image']; ?>">
            <p class="class="bg-warning""><?php echo $review['text']; ?></p>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>        