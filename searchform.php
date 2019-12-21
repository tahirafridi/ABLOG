<form class="form-inline" method="get" action="<?php echo home_url('/'); ?>">
    <div class="input-group w-100">
        <input class="form-control" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="Search..." aria-label="Search">
        <div class="input-group-prepend">
            <button class="btn btn-danger" type="button" onclick="$('#searchform').addClass('d-none');" title="Close Search">&times;</button>
        </div>
    </div>
</form>