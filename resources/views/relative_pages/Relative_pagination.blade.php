<style>
    .page-link {
        text-decoration: none;
        display: inline-block;
        padding: 8px 16px;
    }

    .page-link:hover {
        background-color: #ddd;
        color: black;
    }

    .page-link {
        color: black;
    }

</style>
@if ($paginator->hasPages())
<div style="margin-left: 50px;">
    @if ($paginator->onFirstPage())
        <a class="page-link" href="#" tabindex="-1" style="color: gray;">Previous</a>
    @else
    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="next" style="background-color: #84e1e1"><< Previous</a>

    @endif

    @if ($paginator->hasMorePages())
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" style="background-color: #84e1e1;">Next >></a>
    @else
        <a class="page-link" href="#">Next</a>
    @endif

</div>
@endif