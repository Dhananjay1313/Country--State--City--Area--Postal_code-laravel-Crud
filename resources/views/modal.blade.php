
<!-- modal.blade.php -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body">
                @yield('modal-content')
                @yield('modal-state')
                @yield('modal-city')
                @yield('modal-area')
                @yield('modal-postal')
            </div>
        </div>
    </div>
</div>