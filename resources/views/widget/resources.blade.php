<div class="Row--layout Row--wrap">

<?php
    $i = 0;
?>

<?php foreach($widget->blueprintManager->all() as $blueprint): ?>
    <?php if($blueprint->hasPrimaryToolbarItem()): ?>
    <?php $item = $blueprint->getPrimaryToolbarItem(); ?>
        <?php if(Auth::user()->hasPermissions($item->action->permissions)): ?>
            <?php
                $i++;
            ?>
            <a
              href="{{{ URL::route($item->action->getName()) }}}"
              class="Block Block--link Cell-oneThird<?php if($i % 3 === 0) { echo ' Cell--last'; } ?> Link--smoothState">
                    <h2 class="heading-beta">{{{ $blueprint->getDisplayName(Blueprint::PLURAL) }}}</h2>
                    <span class="Icon--huge Icon--dark Icon--pushUp Icon Icon-{{{ $blueprint->getIcon() }}}"></span>
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>

</div>

@if($i < 1)
    <h2 class="heading-gamma margin-large">
        @lang('oxygen/mod-dashboard::dashboard.noItems')
    </h2>
@endif