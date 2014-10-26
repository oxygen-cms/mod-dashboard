<?php
    use Oxygen\Core\Html\Header\Header;
    use Oxygen\Core\Blueprint\Blueprint;
    use Blueprint as BlueprintManager;

    $header = new Header(
        Lang::get('oxygen/dashboard::dashboard.title')
    );

?>

<div class="Block">
    {{ $header->render() }}
</div>

@foreach($dashboard->getWidgets() as $widget)

    <div class="Block">
        {{ $widget->render() }}
    </div>

@endforeach

@if(empty($dashboard->getWidgets()))
    <div class="Block">
        <h2 class="heading-gamma margin-large">
            @lang('oxygen/dashboard::dashboard.noItems')
        </h2>
    </div>
@endif