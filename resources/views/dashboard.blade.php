<?php
    use Oxygen\Core\Html\Header\Header;
    use Oxygen\Core\Blueprint\Blueprint;
    use Blueprint as BlueprintManager;

    $header = new Header(
        __('oxygen/mod-dashboard::dashboard.title')
    );

    $widgets = $dashboard->getWidgets()

?>

<div class="Block">
    {!! $header->render() !!}
</div>

@foreach($widgets as $widget)

    {!! $widget->render() !!}

@endforeach

@if(empty($widgets))
    <div class="Block">
        <h2 class="heading-gamma margin-large">
            @lang('oxygen/mod-dashboard::dashboard.noItems')
        </h2>
    </div>
@endif