@extends('front.mobile.app')
@section('content')
@include('front.mobile.partials.header')

<main class="oneProductContent collectionContent oneProductContentNew">
    @php
        if (is_null($mainSet)) {
            $mainSet = json_encode('empty');
        }
        if ($otherSets == 'all') {
            $otherSets = $collection->sets;
        }
    @endphp

    <collection-mobile
                    :main_set="{{ $mainSet }}"
                    :other_sets="{{ $otherSets }}"
                    :collection="{{ $collection }}"
                    :similars="{{ $similars }}"
                    site="{{ $site }}"
                    >
    </collection-mobile>

</main>
@include('front.mobile.partials.footer')

@include('front.mobile.partials.modalsPage')
@stop

<style media="screen">
    .oneProductContent{
        height: auto !important;
    }
    header #cart span{
        margin-top: -10px !important;
    }
</style>
