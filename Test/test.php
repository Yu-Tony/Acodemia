<a
  class="btn btn-primary"
  data-mdb-toggle="modal"
  href="#exampleModalToggle1"
  role="button"
  >Open first modal</a
>

<!-- First modal dialog -->
<div
  class="modal fade"
  id="exampleModalToggle1"
  aria-hidden="true"
  aria-labelledby="exampleModalToggleLabel1"
  tabindex="-1"
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel1">Modal 1</h5>
        <button
          type="button"
          class="btn-close"
          data-mdb-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        Show a second modal and hide this one with the button below.
      </div>
      <div class="modal-footer">
        <button
          class="btn btn-primary"
          data-mdb-target="#exampleModalToggle22"
          data-mdb-toggle="modal"
          data-mdb-dismiss="modal"
        >
          Open second modal
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Second modal dialog -->
<div
  class="modal fade"
  id="exampleModalToggle22"
  aria-hidden="true"
  aria-labelledby="exampleModalToggleLabel22"
  tabindex="-1"
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel22">Modal 2</h5>
        <button
          type="button"
          class="btn-close"
          data-mdb-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button
          class="btn btn-primary"
          data-mdb-target="#exampleModalToggle1"
          data-mdb-toggle="modal"
          data-mdb-dismiss="modal"
        >
          Back to first
        </button>
      </div>
    </div>
  </div>
</div>