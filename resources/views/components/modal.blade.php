<div class="modal" tabindex="-1" role="dialog" id="@yield('modalID')">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@yield('modalTitle')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @yield('modalBody')
      </div>
      <div class="modal-footer">
        @yield('modalFooter')
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@yield('modalCloseBtnText','關閉視窗')</button>
      </div>
    </div>
  </div>
</div>
<script>
    $("#@yield('modalID')").modal('toggle');
</script>