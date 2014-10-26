<?php foreach($widget->blueprintManager->all() as $blueprint): ?>

    <?php if($blueprint->hasPrimaryToolbarItem()): ?>
    <?php $item = $blueprint->getPrimaryToolbarItem(); ?>
        <?php if(Auth::user()->hasPermissions($item->action->permissions)): ?>
            <?php $displayed = true; ?>
            <a
              href="{{{ URL::route($item->action->getName()) }}}"
              class="Box Box--border">
                    <h2 class="heading-beta">{{{ $blueprint->getDisplayName(Blueprint::PLURAL) }}}</h2>
                    <span class="Icon--huge Icon--pushUp Icon Icon-{{{ $blueprint->getIcon() }}}"></span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

<?php endforeach; ?>

@if(!isset($displayed))
    <h2 class="heading-gamma margin-large">
        @lang('oxygen/dashboard::dashboard.noItems')
    </h2>
@endif