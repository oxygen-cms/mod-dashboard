<div class="Row--layout Row--wrap">

<?php
    $i = 0;

    foreach($widget->getBlueprintsInOrder() as $blueprint) {
        if($blueprint->hasPrimaryToolbarItem()) {
            $item = $blueprint->getPrimaryToolbarItem();
            if(auth()->guard()->user()->hasPermissions($item->action->permissions)) {
                $i++
                ?>
                <a
                  href="{{{ URL::route($item->action->getName()) }}}"
                  class="Block Block--link Cell-oneThird<?php if($i % 3 === 0) { echo ' Cell--last'; } ?> Link--smoothState">
                        <h2 class="heading-beta">{{{ $blueprint->getPluralDisplayName() }}}</h2>
                        <span class="Icon--huge Icon--dark Icon--pushUp fa fa-{{{ $blueprint->getIcon() }}}"></span>
                </a>
                <?php
            }
        }
    }

?>

</div>

@if($i < 1)
    <h2 class="heading-gamma margin-large">
        @lang('oxygen/mod-dashboard::dashboard.noItems')
    </h2>
@endif